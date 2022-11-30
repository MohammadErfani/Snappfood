<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public function query()
    {
        return Order::with(['restaurant','foods','comment','address'])->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id);
    }

    public function map($order): array
    {
        $foodWithCount = [];
        foreach($order->foods as $food){
            $foodWithCount[] = $food->name.'->'.$order->foodCounts()[$food->id];
        }
        return [
            $order->user->name,
            implode(' ,',$foodWithCount),
            $order->total_price,
            $order->comment?$order->comment->content:"Don't have comment",
            $order->comment?$order->comment->answer:" ",
            $order->comment?$order->comment->score:" ",
            $order->created_at
        ];
    }

    public function headings(): array
    {

        return [
            'user',
            'food with counts',
            'Total Price',
            'comment',
            'answer',
            'score',
            'created at',
        ];
    }
}
