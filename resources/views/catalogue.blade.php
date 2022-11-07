@extends('layouts.template')

@section('content')
<div>
    <div class="container pt-5 pb-5">
        <div class="row row-cols-1 row-cols-md-4 g-5">
            @if ($designs->count() > 0)
                @foreach ($designs as $design)
                    <div class="col">
                        <div class="card">
                            <img src="{{url($design->design)}}" width="300" height="200" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{$design->design_title}}</h5>
                                <p class="card-text"><strong>Creado por: </strong>{{$design->designer->first_name}} {{$design->designer->last_name}}</p>
                                <p class="card-text"><strong>Para la empresa: </strong>{{$design->client->company_name}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <span class="text-danger text-center">No se encontro nigún diseño</span>
            @endif
        </div>
    </div>

</div>
@endsection