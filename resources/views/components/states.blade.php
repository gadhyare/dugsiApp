@props(['title'=> 'title' , 'icon' => 'cart-plus', 'number'=> '0' , 'description'=> 'description' , 'bg' => 'blue'])
<div class="col-md-4 col-xl-3 fw-bold">
    <div class="card bg-{{$bg}} order-card">
        <div class="card-block">
            <h6 class="m-b-20">{{$title}}</h6>
            <h2 class="text-right"><i class="fa{{$icon}} f-left"></i><span>{{$number}}</span></h2>
            <p class="m-b-0">{{$description}}  </p>
        </div>
    </div>
</div>
