<?php

namespace App\Traits;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ReportTrait
{

    public function getAllByYear( $year)
    {
        return Order::where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereYear('created_at',$year)
            ->get();
    }

    public function countChartByYear( $year)
    {
        return Order::select([DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('count', 'month_name');
    }

    public function saleChartByYear( $year)
    {

        return Order::select([DB::raw("Sum(total_price) as sale"), DB::raw("MONTHNAME(created_at) as month_name")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('sale', 'month_name');
    }

    public function getAllBetween($start,$end)
    {
        return Order::where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereBetween('created_at',[$start,$end])
            ->get();
    }

    public function countChartBetween($start,$end)
    {
        return Order::select([DB::raw("COUNT(*) as count"), DB::raw("Date(created_at) as date")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereBetween('created_at',[$start,$end])
            ->groupBy(DB::raw("Date(created_at)"))
            ->pluck('count', 'date');
    }

    public function saleChartBetween($start,$end)
    {
        return Order::select([DB::raw("Sum(total_price) as sale"), DB::raw("Date(created_at) as date")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id)
            ->whereBetween('created_at',[$start,$end])
            ->groupBy(DB::raw("Date(created_at)"))
            ->pluck('sale', 'date');
    }
}
