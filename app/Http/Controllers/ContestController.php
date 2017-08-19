<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use Carbon\Carbon;
use DB;
use Auth;

class ContestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function compete($contestId) {
        $contests = Contest::all();
        $contest = $contests->where('id', $contestId)->first();
        return view('contest.compete', compact(['contest']));
    }

    public function addCompete(Request $request, $contestId) {

        $contests = Contest::all();
        $contest = $contests->where('id', $contestId)->first();

        if(DB::table('contest_user')->where([['user_id', Auth::user()->id],['contest_id', $contestId]])->first()){
            return view('contest.already_done', compact(['contest']));
        }
        else {

            $this->validate($request, [
                'answer' => 'required|min:4'
            ]);

            DB::table('contest_user')->insert([
                'user_id' => Auth::user()->id,
                'contest_id' => $contestId,
                'answer' => strtolower($request->answer)
            ]);

            return view('contest.done', compact(['contest']));
        }
    }
}
