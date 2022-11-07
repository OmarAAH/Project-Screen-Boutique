<div>
    <div class="container">
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Registro de Producto</h4>
            </div>
            <form wire:submit.prevent="saveProduct" >
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Código</label>
                            <input type="text" wire:model="code" class="form-control">
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-6">
                            <label class="form-label">Cantidad de Entrada</label>
                            <input type="text" wire:model="quantity" class="form-control">
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-6 ">
                            <label class="form-label">Precio</label>
                            <div class="input-group">   
                                <span class="input-group-text">$</span>
                                <input type="text" wire:model="price" class="form-control">
                            </div>
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
    
                        <div class="col-4">
                            <label class="form-label">Color</label>
                            <div class="input-group"> 
                                <select class="form-select" wire:model="color_id" >
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($colors as $color)
                                        @if ($color->removal_status)
                                            <option value="{{$color->id}}">{{$color->color}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ColorModal">Modificar Color</button>
                            </div>
                            @error('color_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-4">
                            <label class="form-label">Tipo </label>
                            <div class="input-group">
                                <select class="form-select" wire:model="type_id">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($types as $type)
                                    @if ($type->removal_status)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#TypeModal">Modificar Tipo</button>
                            </div>
                            @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-4 mb-3">
                            <label class="form-label">Tamaño </label>
                            <div class="input-group">
                                <select class="form-select" wire:model="size_id">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($sizes as $size)
                                    @if ($size->removal_status)
                                        <option value="{{$size->id}}">{{$size->size}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#SizeModal">Modificar Tamaño</button>
                            </div>
                            @error('size_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>   
                    </div>
                    
                    <div class="card-footer">
                        <div class="d-grid col-3 mx-auto my-3">
                            <button type="submit" class="btn btn-primary"> Agregar</button>
                        </div>
                    </div>

                </div>
            </form> 
        </div>
    </div>

{{-- MODAL DEL COLOR --}}
    <div wire:ignore.self class="modal fade" id="ColorModal" tabindex="-1" aria-labelledby="createColorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Colores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                        <div class="row mb-3 ">
                            <label class="form-label">Crear Color</label>
                            <div class="col-9">
                                <input type="text" wire:model="create_color" class="form-control">
                            </div>
                            @error('create_color') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="createColor" type="button" class="btn btn-success">Crear</button>
                            </div>
                        </div>
                        

                        <div class="row mb-3 ">
                            <label class="form-label">Eliminar o Restarar Color </label>
                            <div class="col-9">
                                <select class="form-select" wire:model="delete_color">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($colors as $color)
                                        @if ($color->removal_status)  
                                            <option class="text-success" value="{{$color->id}}">{{$color->color}}</option>
                                        @else
                                            <option class="text-danger" value="{{$color->id}}">{{$color->color}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('delete_color') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="deleteColor" type="button" class="btn btn-danger">Cambiar</button>                            
                            </div>
                        </div>
                
                </div>
            </div>
        </div>
    </div>

{{-- MODAL DEL TIPO --}}
    <div wire:ignore.self class="modal fade" id="TypeModal" tabindex="-1" aria-labelledby="createTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tipos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                        <div class="row mb-3 ">
                            <label class="form-label">Crear Tipo</label>
                            <div class="col-9">
                                <input type="text" wire:model="create_type" class="form-control">
                            </div>
                            @error('create_type') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="createType" type="button" class="btn btn-success">Crear</button>
                            </div>
                        </div>
                        

                        <div class="row mb-3 ">
                            <label class="form-label">Eliminar o Restarar Tipo </label>
                            <div class="col-9">
                                <select class="form-select" wire:model="delete_type">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($types as $type)
                                        @if ($type->removal_status)  
                                            <option class="text-success" value="{{$type->id}}">{{$type->type}}</option>
                                        @else
                                            <option class="text-danger" value="{{$type->id}}">{{$type->type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('delete_type') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="deleteType" type="button" class="btn btn-danger">Cambiar</button>                            
                            </div>
                            
                        </div>
                
                </div>
            </div>
        </div>
    </div>

{{-- MODAL DEL TAMAÑO --}}
    <div wire:ignore.self class="modal fade" id="SizeModal" tabindex="-1" aria-labelledby="createSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tamaño</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                        <div class="row mb-3 ">
                            <label class="form-label">Crear Tamaño</label>
                            <div class="col-9">
                                <input type="text" wire:model="create_size" class="form-control">
                            </div>
                            @error('create_size') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="createSize" type="button" class="btn btn-success">Crear</button>
                            </div>
                        </div>
                        

                        <div class="row mb-3 ">
                            <label class="form-label">Eliminar o Restaurar Tamaño </label>
                            <div class="col-9">
                                <select class="form-select" wire:model="delete_size">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($sizes as $size)
                                        @if ($size->removal_status)  
                                            <option class="text-success" value="{{$size->id}}">{{$size->size}}</option>
                                        @else
                                            <option class="text-danger" value="{{$size->id}}">{{$size->size}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('delete_size') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="col-2">
                                <button wire:click="deleteSize" size="button" class="btn btn-danger">Cambiar</button>                            
                            </div>
                        </div>
                
                </div>
            </div>
        </div>
    </div>
    
</div>
