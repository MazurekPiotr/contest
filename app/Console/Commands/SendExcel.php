<?php

namespace App\Console\Commands;

use App\Contest\ContestRepositoryInterface;
use App\Mail\WinnerChosen;
use App\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SendExcel extends Command
{
    private $userRepository;

    private $contestRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendexcel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send excel to admin daily';

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
        $contestToday = DB::table('contest_user')->where('created_at', Carbon::today());

        $contestantsArray[] = ['id', 'firstName','lastName', 'email','created_at'];

        $data = DB::table('contest_user')->where('created_at', '<', Carbon::today())->get();
        foreach ($data as $record) {
            $user = $this->userRepository->getUser($record->user_id);
            $contest = $this->contestRepository->getContest($record->contest_id);
            $excelData[] = ['contestant' => $user->firstName. ' '. $user->lastName, 'contest name' => $contest->name ];
        }
        $sheet =  Excel::create('all_entries', function($excel) use ($excelData) {
            $excel->sheet('mySheet', function($sheet) use ($excelData)
            {
                $sheet->fromArray($excelData);
            });
        });

        Mail::send(winn);
    }
}
