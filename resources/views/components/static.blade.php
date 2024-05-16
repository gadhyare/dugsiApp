@props( ['info' =>  [] , 'title' => ''  ])
<div class="col-xs-12 col-sm-12 col-md-4">
    <div class="card ">
        <div class="card-header bg-white" > {{$title}} </div>
        <div class="card-body p-0"> 
            @php $i =  1 @endphp
            <ul class="list-group ">
                @foreach ($info as $item)
                    <li class="list-group-item border-0 py-2">   
                        {{$slot}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
