@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('designers.designers-component')
    </main> 
@endsection