<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        *{
            direction: rtl;
        }
    </style>
</head>
<body  >
    <table style=" width:75%;   ">
        <tr>
            <td style="padding:5px"> {{SystemInfo::setting('name')}} </td>
            <td style="padding:5px" rowspan="2">
                <img src="https://tcpdf.org/img/tcpdf_main_logo_150x30.png" alt="sss">
            </td>
        </tr>
        <tr>
            <td style="padding:5px"> {{SystemInfo::setting('description')}} </td>
        </tr>
        <tr>
            <td style="padding:5px"> {{SystemInfo::setting('address')}} </td>
        </tr>
        <tr>
            <td style="padding:5px"> {{SystemInfo::setting('phones')}} </td>
        </tr>
        <tr>
            <td style="padding:5px"> {{SystemInfo::setting('email')}} </td>
        </tr>
    </table>


    <br>
    <br>

    <h2 style="text-align: center"> استمارة  الطالب </h2>

    <div style="width:50%; display:inline-block; border: 1px solid #333;">
    <table   >

        <tr>
            <td style="padding:5px;text-align:right;"> الاسم: {{ $student->name}}{{ $student->father->name}} </td>
            <td style="padding:5px;text-align:right;"> الرقم الدراسي: {{ $student->id}}-{{ $student->father->number}} </td>
        </tr>
        <tr>
            <td style="padding:5px;text-align:right;"> المرحلة: {{ $exams_info->levels->name}}  </td>
            <td style="padding:5px;text-align:right;"> الصف: {{ $exams_info->classes->name}} </td>
        </tr>
    </table>
    </div>

    <br>
    <br>
    <br>

    <table style="border:1px solid #333; padding:5px">
        <thead>
            <tr>
                <th style="text-align:center;border:1px solid #333;"> م </th>
                <th style="text-align:center;border:1px solid #333;"> المادة </th>
                <th style="text-align:center;border:1px solid #333;"> الدرجة العظمى </th>
                <th style="text-align:center;border:1px solid #333;"> الدرجة الدنيا </th>
                <th style="text-align:center;border:1px solid #333;"> الدرجة بالأرقام </th>
                <th style="text-align:center;border:1px solid #333;"> الدرجة بالأحرف </th>
            </tr>
        </thead>
        @php $i = 1 @endphp
        <tbody>
         @foreach ($exams as $item)
            <tr>
                <td style="text-align:center;border:1px solid #333;"> {{$i++}}</td>
                <td style="text-align:center;border:1px solid #333;"> {{$item->subjects_distributions->subjects->name  }} </td>
                <td style="text-align:center;border:1px solid #333;"> {{  $item->subjects_distributions->max_mark}} </td>
                <td style="text-align:center;border:1px solid #333;"> {{$item->subjects_distributions->min_mark  }} </td>
                <td style="text-align:center;border:1px solid #333;"> {{($item->qu1 + $item->ex1 + $item->qu2 + $item->ex2 + $item->att)}}</td>
                <td style="text-align:center;border:1px solid #333;">

                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
</body>

</html>
