@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('clients.create-client-component')
    </main> 
@endsection