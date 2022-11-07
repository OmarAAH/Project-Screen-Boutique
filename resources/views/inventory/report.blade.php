@extends('layouts.template-report')

@section('content')
    <main>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Precio</th>
                    <th>Cantidad Actual</th>
                    <th>Devuentos</th>
                    <th>Reciclados</th>
                    <th>Color</th>
                    <th>Tipo</th>
                    <th>Tamaño</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->code}}</td>
                        <td>{{$product->price}}$</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->returns}}</td>
                        <td>{{$product->recycling}}</td>
                        <td>{{$product->color->color}}</td>
                        <td>{{$product->type->type}}</td>
                        <td>{{$product->size->size}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main> 
@endsection