@extends('layouts.template-report')

@section('content')
    <main>
        <table class="table">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{$employee->ci}}</td>
                            <td>{{$employee->first_name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->phone}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </main> 
@endsection