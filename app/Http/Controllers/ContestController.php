<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User\UserRepositoryInterface;
use App\Contest\ContestRepositoryInterface;

class ContestController extends Controller
{

    private $userRepository;

    private $contestRepository;

    function __construct(UserRepositoryInterface $userRepository, ContestRepositoryInterface $contestRepository)
    {
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function compete($contestId) {
        $contests = $this->contestRepository->getContest($contestId);
        return view('contest.compete', compact(['contest']));
    }

    public function addCompete(Request $request, $contestId) {

        $contests = $this->contestRepository->getContest($contestId);

        if(DB::table('contest_user')->where([['user_id', Auth::user()->id],['contest_id', $contestId]])->first()){
            return view('contest.already_done', compact(['contest']));
        }
        else {

            $this->validate($request, [
                'code' => 'required|min:13'
            ]);

            DB::table('contest_user')->insert([
                'user_id' => Auth::user()->id,
                'contest_id' => $contestId,
                'code' => strtolower($request->code)
            ]);

            return view('contest.done', compact(['contest']));
        }
    }
}
