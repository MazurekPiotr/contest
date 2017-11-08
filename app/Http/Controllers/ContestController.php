<?php

namespace App\Http\Controllers;

use App\Code;
use App\User\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User\UserRepositoryInterface;
use App\Contest\ContestRepositoryInterface;
use DB;

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

    public function compete() {
        $contests = $this->contestRepository->getAll();
        return view('contest.compete', compact(['contests']));
    }

    public function addCompete(Request $request, $contestId) {

        $this->validate($request, [
            'code' => 'required|min:10',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $contest = $this->contestRepository->getContest($contestId);


        if($this->userRepository->getUserByMail($request->email) == null) {

            if(Code::where('code', $request->code)->first()) {

                $user = new User();
                $user->firstName = $request->first_name;
                $user->lastName = $request->last_name;
                $user->email = $request->email;
                $user->role = 'user';
                $user->ipaddress = $request->ip();
                $user->save();

                $code = Code::where('code', $request->code)->first();
                if($code->used_by != null) {
                    return redirect()->back()->withInput()->withErrors(['code' => 'Code already used']);
                }
                else {
                    $code->used_by = $user->id;
                    $code->save();

                    DB::table('contest_user')->insert([
                        'user_id' => $user->id,
                        'contest_id' => $contestId,
                        'code_id' => $code->id
                    ]);

                    return view('contest.done', compact(['contest']));
                }
            }
            else{
                return redirect()->back()->withErrors(['code' => 'Invalid code'])->withInput();
            }
        }
        elseif ($this->userRepository->getUserByMail($request->email) != null) {

            if(Code::where('code', $request->code)->first()) {

                $user = $this->userRepository->getUserByMail($request->email);
                $user->firstName = $request->first_name;
                $user->lastName = $request->last_name;
                $user->ipaddress = $request->ip();
                $user->save();

                $code = Code::where('code', $request->code)->first();
                if($code->used_by != null) {
                    return redirect()->back()->withInput()->withErrors(['code' => 'Code already used']);
                }
                else {
                    $code->used_by = $user->id;
                    $code->save();

                    DB::table('contest_user')->insert([
                        'user_id' => $user->id,
                        'contest_id' => $contestId,
                        'code_id' => $code->id
                    ]);

                    return view('contest.done', compact(['contest']));
                }
            }
            else{
                return redirect()->back()->withErrors(['code' => 'Invalid code'])->withInput();
            }
        }

    }
}
