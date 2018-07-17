<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\DailyReports;
use App\Repositories\DailyReportsRepository;


class HomeController extends Controller
{

    protected $reports;

    public function __construct(DailyReportsRepository $reports)
    {
      $this->middleware('auth:admin');
      $this->reports = $reports;
    }

    public function index()
    {
        return view('admin.home.index');
    }
}
