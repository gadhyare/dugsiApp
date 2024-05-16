<div class="container px-0">
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="card rounded-0   ">
                <div class="card-header title text-white rounded-0">
                    <i class="fa-solid fa-calendar"></i>
                    <span>
                        البحث بين تارخين
                    </span>
                </div>
                <div class="card-body">

                        <div class="form-group">
                            <label for="from">
                                من تاريخ
                            </label>
                            <span class="float-start">
                                @error('from')
                                    <div class="bg-danger text-white px-2">
                                        مطلوب
                                    </div>
                                @enderror
                            </span>
                            <input type="date" id="from" wire:model.lazy="from" class="form-control rounded-0 alert alert-info py-2 my-2">
                        </div>

                        <div class="form-group">
                            <label for="to">
                                حتى تاريخ
                            </label>
                            <span class="float-start">
                                @error('to')
                                    <div class="bg-danger text-white px-2">
                                        مطلوب
                                    </div>
                                @enderror
                            </span>
                            <input type="date" id="to" wire:model.lazy="to"  class="form-control rounded-0 alert alert-info py-2 my-2">
                        </div>


                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9" >

            <div class="container fw-bold  " wire:loading>
                    <img src="{{asset('/images/loading-loading-forever.gif')}}" alt="loading" style="width:15px; height:15px">
            </div>
            <br>
            <br>
            <div class="text-danger">

                        اجمالي المبلغ المدفوع بين التاريخين:  {{$totalPaidBetweenTwoDate}}$
                        @if( $to  )
                            <a class="float-start text-pink-500" href="{{route('print.fee.report.beteen.two.date' , ['from' =>  $from, 'to' => $to])}}">
                                    <i class="fa fa-print" style=""></i>
                            </a>
                        @endif
                </div>
            @php $i = 1 ; @endphp
            <table class="table table-bordered" >

                <thead>
                    <th class="py-3">#</th>
                    <th class="py-3"> اسم الطالب </th>
                    <th class="py-3"> رقم الرصيد </th>
                    <th class="py-3"> التاريخ </th>
                    <th class="py-3"> جهة الدفع </th>
                    <th class="py-3"> الخصم </th>
                    <th class="py-3"> المدفوع </th>
                </thead>
            <tbody>
                @foreach ($feetrans as $feetran)
                    <tr>
                        <td> {{$i++}}</td>
                        <td> {{ SystemInfo::get_full_student_name($feetran->invoices->studentInfo->id) }}   </td>
                        <td> {{$feetran->invoices->id}} </td>
                        <td> {{$feetran->paid_date}} </td>
                        <td> {{$feetran->invoices->feestypes->name}} </td>
                        <td> {{$feetran->descount}} </td>
                        <td> {{$feetran->amount}} </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        </div>
    </div>
</div>
