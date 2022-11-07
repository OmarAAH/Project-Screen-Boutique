@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('sales.sales-component')
    </main> 
@endsection