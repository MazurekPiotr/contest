<?php

namespace App\Http\Controllers;

use App\Code;
use App\Contest\ContestRepositoryInterface;
use App\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Excel;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $contests = $this->contestRepository->getAll();
        return view('admin.importExport', compact(['contests']));
    }
    public function downloadExcel($type)
    {
        $data = DB::table('contest_user')->whereDate('created_at', Carbon::today()->toDateString())->get();
        $excelData = [];
        foreach ($data as $record) {
            $user = $this->userRepository->getUser($record->user_id);
            $contest = $this->contestRepository->getContest($record->contest_id);
            $code = Code::where('id', $record->code_id)->first();

            $excelData[] = ['contestant' => $user->firstName. ' '. $user->lastName, 'contest name' => $contest->name, 'code' => $code->code ];
        }
        $sheet = Excel::create('all_entries', function($excel) use ($excelData) {
            $excel->sheet('mySheet', function($sheet) use ($excelData)
            {
                $sheet->fromArray($excelData);
            });
        });

        $filePath = 'excel/' . Carbon::now()->toDateString() . '_entries.xls';

        Storage::put($filePath, $sheet);

        return $sheet->download($type);

    }

    public function downloadExcelForContest($type, $id)
    {
        $data = DB::table('contest_user')->whereDate('created_at', Carbon::today()->toDateString())->where('contest_id', $id)->get();
        $excelData = [];

        $contest = $this->contestRepository->getContest($id);
        foreach ($data as $record) {
            $user = $this->userRepository->getUser($record->user_id);
            $code = Code::where('id', $record->code_id)->first();

            $excelData[] = ['contestant' => $user->firstName. ' '. $user->lastName, 'contest name' => $contest->name, 'code' => $code->code ];
        }
        $sheet = Excel::create($contest->name.'_entries', function($excel) use ($excelData) {
            $excel->sheet('mySheet', function($sheet) use ($excelData)
            {
                $sheet->fromArray($excelData);
            });
        });

        $filePath = 'excel/' . Carbon::now()->toDateString() . '_entries.xls';

        Storage::put($filePath, $sheet);

        return $sheet->download($type);

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
                    $insert[] = ['code' => $value->table_1, 'contest_id' => $contest,'used_by' => null];
                }
                if(!empty($insert)){
                    DB::table('codes')->insert($insert);
                }
            }
        }
        return back()->with('added', 'Codes succesfully added');
    }
}
