@extends('layouts.template')

@section('content')
    @include('layouts.nav') 
    <main>
        @livewire('employees.employee-component')
    </main> 
@endsection