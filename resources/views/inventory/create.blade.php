@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('products.product-component')
    </main> 
@endsection