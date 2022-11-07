@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('designs.designs-component')
    </main> 
@endsection