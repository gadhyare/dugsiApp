<?php

namespace App\Exports;

use App\Models\StudentsSchoolInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsListExport implements FromCollection , WithMapping , WithHeadings, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */


    public $pro_id;

    public function __construct($pro_id )
    {
        $this->pro_id = $pro_id;
    }



    public function collection()
    {
        $students_info =  StudentsSchoolInfo::where('programs_id' , '=', $this->pro_id)
                        ->get();

                        return $students_info;
    }



    public function map($students_info):array
    {
        return [
                $students_info->studentInfo->name()  ,
                $students_info->studentInfo->id   ,

        ];
    }




    public function headings(): array
    {
        return [
            'اسم الطالب',
            'رقم الطالب',
            'أعمال السنة 1' ,
            'اختبار نصفي' ,
            'أعمال السنة 2' ,
            'اختبار نهائي' ,
            'المجموع'
        ];
    }



    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true); // this change
            },
        ];
    }

}
