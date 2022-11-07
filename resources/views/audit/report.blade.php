@extends('layouts.template-report')

@section('content')
    <main>
        <table>
            <thead>
                <tr>
                    <th>Dirección IP</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Tabla</th>
                    <th>Datos</th>
                    <th>Datos Actuales</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Modificación</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($audits as $audit)
                        <tr>
                            <td>{{$audit->ip_address}}</td>
                            @foreach($users as $user)
                                @if ($audit->user_id == $user->id)    
                                    <td>{{$user->user}}</td>
                                @endif
                            @endforeach

                            @switch($audit->event)
                                @case('created')
                                    <td>Registro</td>
                                    @break
                                @case('updated')
                                    <td>Modifico</td>
                                    @break
                                @case('deleted')
                                    <td>Elimino</td>
                                    @break       
                            @endswitch

                            @switch($audit->auditable_type)
                                @case('App\Models\Product')
                                    <td>Productos</td>
                                    @break
                                @case('App\Models\User')
                                    <td>Usuario</td>
                                    @break
                                @case('App\Models\Client')
                                    <td>Clientes</td>
                                    @break
                                @case('App\Models\Sale')
                                    <td>Ventas</td>
                                    @break
                                @case('App\Models\Delivery')
                                    <td>Empresa de Envios</td>
                                    @break 
                                @case('App\Models\Design')
                                    <td>Diseño</td>
                                    @break 
                                @case('App\Models\Designer')
                                    <td>Diseñadores</td>
                                    @break 
                                @case('App\Models\Employee')
                                    <td>Empleados</td>
                                    @break         
                            @endswitch

                            <td>
                                @foreach($audit->old_values as $key => $value)

                                    <p>{{$key}} : {{$value}}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach($audit->new_values as $key => $value)

                                <p>{{$key}} : {{$value}}</p>
                            @endforeach
                            </td>

                            <td>{{$audit->created_at}}</td>
                            <td>{{$audit->updated_at}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </main> 
@endsection