<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Inventario
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Buscar Código" style="width: 230px" />
                            @if(auth()->user()->role_id == 1)
                                <a class="btn btn-secondary float-end" href="{{route('report.inventory')}}">Reporte</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd table-striped text-center">
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
                                @if ($products->count() > 0)
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
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                                <td>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateProductModal" wire:click="editProduct({{$product->id}})" class="btn btn-primary">Editar</button>
                                                </td>
                                                <td>
                                                    @if ($product->removal_status == true)
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" wire:click="deleteProduct({{$product->id}})" class="btn btn-danger">Eliminar</button>
                                                    @else
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" wire:click="deleteProduct({{$product->id}})" class="btn btn-success">Restaurar</button>
                                                    @endif
                                                </td>
                                            @endif                                     
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-danger">No hay productos en inventario</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($search == '')  
                            {{ $products->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Update Product Modal -->

    <div wire:ignore.self class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateProduct">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">Código</label>
                                <input type="text" wire:model="code" class="form-control" disabled>
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">Precio</label>
                                    <input id="price" type="text" wire:model="price" class="form-control ">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Cantidad Actual</label>
                                <input id="actual_quantity" type="text" wire:model="actual_quantity" class="form-control " disabled>
                                @error('actual_quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label" >Reabastecimiento</label>
                                <input type="number" min="0" wire:model="resupply" class="form-control">
                                @error('resupply') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label" >Devoluciones</label>
                                <input type="number" min="0" wire:model="returns" class="form-control">
                                @error('returns') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label" >Reciclaje</label>
                                <input type="number" min="0" wire:model="recycling" class="form-control">
                                @error('recycling') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>       
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Product Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-body">
                        <h4 class="text-danger">¿Desea cambiar el estado de este producto?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

