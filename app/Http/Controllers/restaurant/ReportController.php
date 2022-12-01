<?php

namespace App\Http\Controllers\restaurant;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index($year)
    {
        $orders = Order::where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
        ->whereYear('created_at',$year)->get();


        $counts = Order::select([DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('count', 'month_name');
        $countLabel = $counts->keys();
        $countData = $counts->values();
        $price = Order::select([DB::raw("Sum(total_price) as sale"), DB::raw("MONTHNAME(created_at) as month_name")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('sale', 'month_name');
        $priceLabel = $price->keys();
        $priceData = $price->values();
        return view('restaurant.order.report', compact('orders', 'countData', 'countLabel', 'priceData', 'priceLabel', 'year'));
    }

    public function export()
    {
        return Excel::download(new OrderExport(), 'report.xlsx');
    }

    public function filterYear(Request $request)
    {
        return redirect()->route('restaurant.report.index', $request->year);
    }

}
