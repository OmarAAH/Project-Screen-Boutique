@extends('layouts.template')

@section('content')
    @include('layouts.nav')  
    <main>
        @livewire('products.inventory-component')
    </main>
@endsection