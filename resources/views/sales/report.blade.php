@extends('layouts.template-report')

@section('content')
    <main>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad Vendida</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Fecha del Envio</th>
                    <th>Empresa de Envio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{$sale->created_at}}</td>
                        <td>{{$sale->product->code}}</td>
                        <td>{{$sale->sold}}</td>
                        <td>{{$sale->total}}$</td>
                        <td>{{$sale->client->company_name}}</td>
                        <td>{{$sale->employee->first_name}} {{$sale->employee->last_name}}</td>
                        <td>
                            @if(!$sale->date_delivery)
                                sin envio
                            @else
                                {{$sale->date_delivery}}
                            @endif
                        </td>
                        <td>{{$sale->delivery->company}}</td>
                                                                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main> 
@endsection