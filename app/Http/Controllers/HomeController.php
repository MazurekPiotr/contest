<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Contest;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = Contest::all();
        $runningContests = $contests->where('end_date', '>', Carbon::now());
        $endedContests = $contests->where('winner_id', '!=', null);
        return view('home', compact(['runningContests', 'endedContests']));
    }

}
