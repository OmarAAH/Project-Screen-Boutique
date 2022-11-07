<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Registro de Ventas
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Buscar Venta" style="width: 230px" />
                            @if (auth()->user()->role_id == 3)                               
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createSalesModal" class="btn btn-primary float-end">Registrar Venta</button>
                            @endif
                            @if (auth()->user()->role_id == 1)
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createDeliveryModal" class="btn btn-success float-end mx-2">Empresas de envios</button>
                                <a class="btn btn-secondary float-end" href="{{route('report.sales')}}">Reporte</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd table-striped text-center">
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
                                @if ($sales->count() > 0)
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
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#dateDeliveryModal" wire:click="dateDelivery({{$sale->id}})" class="btn btn-outline-danger">Registrar</button>
                                                @else
                                                    {{$sale->date_delivery}}
                                                @endif
                                            </td>
                                            <td>{{$sale->delivery->company}}</td>                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-danger">No se encontro nigún venta</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($search == '')
                            {{ $sales->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REGISTRAR VENTA --}}
    <div wire:ignore.self class="modal fade" id="createSalesModal" tabindex="-1" aria-labelledby="createSalesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSalesModalLabel">Registrar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="createSales">
                    <div class="modal-body">
                        <div class="row g-3">
                            @if (session()->has('error'))
                                <span class="text-danger">{{ session('error') }}</span>
                            @endif

                            <div class="col-12">
                                <label class="form-label">Vendedor</label>
                                <input value="{{auth()->user()->employee->first_name}} {{auth()->user()->employee->last_name}}" type="text" class="form-control " disabled>
                            </div> 
                            
                            <div class="col-6">
                                <label class="form-label">Cantidad</label>
                                <input type="number" min="0" wire:model="sold" class="form-control ">
                                @error('sold') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                            

                            <div class="col-6">
                                <label class="form-label" >Producto</label>
                                <select class="form-select" wire:model="product_id" >
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->code}}</option>
                                    @endforeach
                                </select>
                                @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            @if ($product_id)
                                <div class="col-6 mb-3">
                                    <label class="form-label" >Cliente</label>
                                    <select class="form-select" wire:model="client_id" >
                                        <option selected value="">Seleccione...</option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}">{{$client->company_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif
                            @if ($client_id)                            
                                <div class="col-6 mb-3">
                                    <label class="form-label" >Diseño</label>
                                    <select class="form-select" wire:model="design_id" >
                                        <option selected value="">Seleccione...</option>
                                        @foreach ($designs as $design)
                                            @if ($design->client_id == $client_id && $design->status==1)                                           
                                                <option value="{{$design->id}}">{{$design->design_title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('design_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            @if ($design_id)
                                <div class="col-12">
                                    <label class="form-label" >Empresa de Envio</label>
                                    <select class="form-select" wire:model="delivery_id" >
                                        <option selected value="">Seleccione...</option>
                                        @foreach ($deliveries as $delivery)
                                            <option value="{{$delivery->id}}">{{$delivery->company}}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REGISTRAR FECHA DE ENVIO --}}
    <div wire:ignore.self class="modal fade" id="dateDeliveryModal" tabindex="-1" aria-labelledby="dateDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateDeliveryModalLabel">Registrar fecha de envio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="createDateDelivery">
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label">Vendedor</label>
                                <input wire:model="date_delivery" type="date" class="form-control ">
                            </div> 
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REGISTRAR EMPRESA DE ENVIOS --}}
    <div wire:ignore.self class="modal fade" id="createDeliveryModal" tabindex="-1" aria-labelledby="createcreateDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createcreateDeliveryModalLabel">Empresa de Envios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                    <div class="row mb-3 ">
                        <label class="form-label">Registro de empresa</label>
                        <div class="col-9">
                            <input type="text" wire:model="create_delivery" class="form-control">
                        </div>
                        @error('create_delivery') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="col-2">
                            <button wire:click="createDelivery" type="button" class="btn btn-success">Crear</button>
                        </div>
                    </div>
                    

                    <div class="row mb-3 ">
                        <label class="form-label">Eliminar empresa</label>
                        <div class="col-9">
                            <select class="form-select" wire:model="delete_delivery">
                                <option selected value="">Seleccione...</option>
                                @foreach ($deliveries as $delivery)
                                    @if ($delivery->removal_status)  
                                        <option class="text-success" value="{{$delivery->id}}">{{$delivery->company}}</option>
                                    @else
                                        <option class="text-danger" value="{{$delivery->id}}">{{$delivery->company}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger">si elimina uno de estas empresas, eliminaras todos las ventas que hayan usado esta empresa de envios</span>
                        </div>
                        @error('delete_delivery') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="col-2">
                            <button wire:click="deleteDelivery" type="button" class="btn btn-danger">Eliminar</button>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>