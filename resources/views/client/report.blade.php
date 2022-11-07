@extends('layouts.template-report')

@section('content')
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nombre de la Empresa</th>
                    <th>Rama de la Empresa</th>
                    <th>Nombre del Contacto</th>
                    <th>Apellido del Contacto</th>
                    <th>Teléfono de Contacto</th>
                    <th>Estado</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->company_name}}</td>
                            <td>{{$client->branch}}</td>
                            <td>{{$client->first_name_contact}}</td>
                            <td>{{$client->last_name_contact}}</td>
                            <td>{{$client->phone_contact}}</td>
                            <td>{{$client->state->state}}</td>
                            <td>{{$client->city->city}}</td>
                            <td>{{$client->address}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </main> 
@endsection