<?php

namespace App\Console\Commands;

use App\Contest\ContestRepositoryInterface;
use App\Mail\SendExcel as MailExcel;
use App\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Support\Facades\Storage;
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

        Mail::to('pioma93@hotmail.com')->send(new MailExcel($this->userRepository, $this->contestRepository));
    }
}
