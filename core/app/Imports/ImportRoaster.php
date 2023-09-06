<?php

namespace App\Imports;

use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Roaster;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportRoaster implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        
        $employee = Employee::where('id', $row['employee_id'])->first();
        
        if ($employee) {
            // dd($row['employee_id']);
            $roaster = array();
            $roaster['emp_id'] = $employee->id;
            $roaster['employee_id'] = $row['employee_id'];
            $roaster['date'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])->format('Y-m-d');
            $roaster['start_time'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['start_time'])->format('H:i:s');
            $roaster['end_time'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_time'])->format('H:i:s');

            $start = Carbon::parse($roaster['start_time']);
            $end = Carbon::parse($roaster['end_time']);
            $hours = $end->diffInHours($start);
            $minutes_check = $end->diffInMinutes($start);
            $one = $hours * 60;
            $minutes = $minutes_check - $one;
            $roaster['hours'] = sprintf("%02d", $hours) . ':' . sprintf("%02d", $minutes);

            $roaster['status'] = 1;
            $roaster['created_at'] = Carbon::now();
            $roaster['updated_at'] = Carbon::now();
            Roaster::insert($roaster);
        }
    }
}
