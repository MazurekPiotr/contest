<?php

namespace App\Console\Commands;

use App\Mail\WinnerChosen;
use Illuminate\Console\Command;
use App\Contest\Contest;
use App\Contest\ContestRepositoryInterface;
use Mail;
use Carbon\Carbon;
use App\User\User;
use DB;

class ContestPicker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contestpicker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Choose contest';

    private $contestRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContestRepositoryInterface $contestRepository)
    {
        parent::__construct();
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
            $now = Carbon::now();
            $start_date = Carbon::parse($contest->start_date);
            $end_date = Carbon::parse($contest->end_date);

            if($now->greaterThan($start_date) && $now->lessThan($end_date))
            {
                $contest->active = true;
            }
        }
    }
}
