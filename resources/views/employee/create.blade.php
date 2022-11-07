@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('employees.create-employee-component')
    </main> 
@endsection