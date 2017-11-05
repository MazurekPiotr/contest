<?php

namespace App\Console\Commands;

use App\Mail\WinnerChosen;
use Illuminate\Console\Command;
use App\Contest\Contest;
use Mail;
use Carbon\Carbon;
use App\User\User;
use DB;

class ChooseWinnerFromContest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'choosewinner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Choose winner from contest';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $runninContests = Contest::all()->where('winner_id', NULL);

        foreach ($runninContests as $contest) {
            $now = Carbon::now();
            $end_date = Carbon::parse($contest->end_date);

            if ($now->gte($end_date)) {
                $contestants = Contest::find($contest->id)->users()->get();
                $winners = [];
                foreach ($contestants as $contestant) {
                    $winner = DB::table('contest_user')->where([['user_id', $contestant->id],['contest_id', $contest->id]])->where('answer', $contest->answer)->first();
                    array_push($winners, $winner);
                }
                $winner = array_random($winners)->user_id;

                $user = User::find($winner);
                $contest->winner_id = $winner;
                $contest->save();

                Mail::to($user->email)->send(new WinnerChosen($user, $contest));
            }
        }
    }
}
