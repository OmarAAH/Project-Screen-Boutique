@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('clients.clients-component')
    </main> 
@endsection