<?php

namespace App\Mail;

use App\Code;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use Carbon\Carbon;
use App\User\UserRepositoryInterface;
use App\Contest\ContestRepositoryInterface;
use Excel;
use Storage;

class SendExcel extends Mailable
{
    use Queueable, SerializesModels;

    private $userRepository;

    private $contestRepository;

    public function __construct(UserRepositoryInterface $userRepository, ContestRepositoryInterface $contestRepository)
    {
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = DB::table('contest_user')->whereDate('created_at', Carbon::today()->toDateString())->get();
        $excelData = [];
        foreach ($data as $record) {
            $user = $this->userRepository->getUser($record->user_id);
            $contest = $this->contestRepository->getContest($record->contest_id);
            $code = Code::where('id', $record->code_id)->first();
            $excelData[] = ['contestant' => $user->firstName. ' '. $user->lastName, 'contest name' => $contest->name, 'code' => $code->code ];
        }
        $sheet = Excel::create(Carbon::now()->toDateString() . '_entries', function($excel) use ($excelData) {
            $excel->sheet('mySheet', function($sheet) use ($excelData)
            {
                $sheet->fromArray($excelData);
            });
        });

        return $this->markdown('emails.sendexcel')->attach($sheet->store("xls",false,true)['full'], ['excel.xls']);
    }
}
