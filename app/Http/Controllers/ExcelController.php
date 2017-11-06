<?php

namespace App\Http\Controllers;

use App\Contest\ContestRepositoryInterface;
use App\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Excel;
use DB;

class ExcelController extends Controller
{
    private $userRepository;

    private $contestRepository;

    public function __construct(UserRepositoryInterface $userRepository, ContestRepositoryInterface $contestRepository)
    {
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
    }

    public function importExport()
    {
        return view('admin.importExport');
    }
    public function downloadExcel($type)
    {
        $data = DB::table('contest_user')->get();
        foreach ($data as $record) {
            $user = $this->userRepository->getUser($record->user_id);
            $contest = $this->contestRepository->getContest($record->contest_id);
            $excelData[] = ['contestant' => $user->firstName. ' '. $user->lastName, 'contest name' => $contest->name,  ];
        }
        return Excel::create('all_entries', function($excel) use ($excelData) {
            $excel->sheet('mySheet', function($sheet) use ($excelData)
            {
                $sheet->fromArray($excelData);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        if($request->import_file != null){
            $file = $request->import_file;
            $contest = $request->contest;
            $data = Excel::load($file, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['code' => $value->table_1, 'contest_id' => 1,'used' => 0];
                }
                if(!empty($insert)){
                    DB::table('codes')->insert($insert);
                }
            }
        }
        return back();
    }
}
