<?php

namespace App\Console\Commands;

use App\Contest\ContestRepositoryInterface;
use App\Mail\WinnerChosen;
use App\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Mail;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;

class ChooseWinnerFromContest extends Command
{
    private $userRepository;

    private $contestRepository;

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
    public function __construct(UserRepositoryInterface $userRepository, ContestRepositoryInterface $contestRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $contests = $this->contestRepository->getAll();
        foreach ($contests as $contest) {
            if($contest->winner_id == null) {
                $now = Carbon::now();
                $end_date = Carbon::parse($contest->end_date);

                if ($now->gte($end_date)) {
                    $contestants = $contest->users()->get();

                    $winner_id = array_random(collect($contestants)->all())->id;

                    $user = $this->userRepository->getUser($winner_id);
                    $contest->winner_id = $winner_id;
                    $contest->save();

                    Mail::to($user->email)->send(new WinnerChosen($user, $contest));
                }
            }
        }
    }
}
