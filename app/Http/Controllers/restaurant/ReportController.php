<?php

namespace App\Http\Controllers\restaurant;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    public function index()
    {
//        return Excel::download(new OrderExport(),'report.xlsx');
    }

    public function export()
    {
        return Excel::download(new OrderExport(),'report.xlsx');
    }
    //
}
