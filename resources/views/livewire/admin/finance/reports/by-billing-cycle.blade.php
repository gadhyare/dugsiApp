<div class="container  fw-bold py-3 bg-white my-2 rounded-2 shadow-sm">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <select class=" form-select bg-white " wire:model.live.debounce.300="billingCycleId">
                <option> اختر الدورة المالية </option>
                @foreach ($billingCycles as $item)
                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                @endforeach
            </select>
            <br>
            <div class="float-end">
                <p class="mt-2 mx-3">
                    الرصيد الافتتاحي: {{ $initial_balance->initial_balance ?? 0 }}
                </p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="card rounded-0 shadow-md border-0">
                <div class="card-header rounded-0 bg-gray-dark text-white"> رسوم الطلبة </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>المطلوب:  </td> <td>   {{ $total_of_want }} $ </td>
                        </tr>
                        <tr>
                            <td>المدفوع:  </td> <td>  {{ $paid_amount }} $ </td>
                        </tr>
                        <tr>
                            <td> الخصم:  </td> <td>  {{ $total_of_discount }} $ </td>
                        </tr>
                        <tr>
                            <td>المتبقي:  </td> <td>  {{ $total_of_want - $paid_amount - $total_of_discount }} $
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="container py-2 px-0">
        <p>
            المتبقي في الرصيد: {{ ($initial_balance->initial_balance ?? 0) + ($paid_amount ?? 0) ?? 0 }}
        </p>
    </div>
</div>

{{-- <script>
    window.print();
</script> --}}