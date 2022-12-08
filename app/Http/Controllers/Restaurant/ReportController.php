<?php

namespace App\Http\Controllers\Restaurant;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Traits\ReportTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    use ReportTrait;

    /**
     * @param $year
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($year)
    {
        $orders = $this->getAllByYear($year);
        $counts = $this->countChartByYear($year);
        $countLabel = $counts->keys();
        $countData = $counts->values();
        $price = $this->saleChartByYear($year);
        $priceLabel = $price->keys();
        $priceData = $price->values();
        return view('restaurant.order.report', compact('orders', 'countData', 'countLabel', 'priceData', 'priceLabel', 'year'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new OrderExport(), 'report.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function filterYear(Request $request)
    {
        return redirect()->route('restaurant.report.index', $request->year);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function filterBetween(Request $request)
    {
        if ($request->input('start') && $request->input('end')) {

            $start = Carbon::parse($request->input('start'));
            $end = Carbon::parse($request->input('end'));
            if ($end > $start) {
                $orders = $this->getAllBetween($start, $end);
                $counts = $this->countChartBetween($start, $end);
                $price = $this->saleChartBetween($start, $end);
                $countLabel = $counts->keys();
                $countData = $counts->values();
                $priceLabel = $price->keys();
                $priceData = $price->values();
                $start = $request->start;
                $end = $request->end;
                return view('restaurant.order.report', compact('orders', 'countData', 'countLabel', 'priceData', 'priceLabel', 'start', 'end'));
            }else{
                return redirect()->route('restaurant.report.index', now()->year)->withErrors(['time'=>"Your filter isn't correct"]);

            }
        }
        return redirect()->route('restaurant.report.index', now()->year);


    }

}
