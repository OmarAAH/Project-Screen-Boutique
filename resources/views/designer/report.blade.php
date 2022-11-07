@extends('layouts.template-report')

@section('content')
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($designers as $designer)
                        <tr>
                            <td>{{$designer->first_name}}</td>
                            <td>{{$designer->last_name}}</td>
                            <td>{{$designer->phone}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </main> 
@endsection