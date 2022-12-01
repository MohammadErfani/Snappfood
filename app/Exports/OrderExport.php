<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\restaurant\Restaurant;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class OrderExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithDrawings
{
    use Exportable;

    public function query()
    {
        return Order::with(['restaurant', 'foods', 'comment', 'address'])->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->orderBy('created_at');
    }

    public function map($order): array
    {
        $foodWithCount = [];
        foreach ($order->foods as $food) {
            $foodWithCount[] = $food->name . '->' . $order->foodCounts()[$food->id];
        }
        return [
            $order->user->name,
            implode(' ,', $foodWithCount),
            $order->total_price,
            $order->comment ? $order->comment->content : "Don't have comment",
            $order->comment ? $order->comment->answer : " ",
            $order->comment ? $order->comment->score : " ",
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

    public function drawings()
    {
        $picture = Restaurant::where('salesman_id',Auth::guard('salesman')->user()->id)->first()->picture;
        $picture = $picture != null ?$picture:'/storage/images/restaurant-category-icon.png';
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path($picture));
        $drawing->setHeight(90);
        $drawing->setCoordinates('H1');
        return $drawing;
    }
}
