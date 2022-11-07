<div>
    <div class="container">
        <div class="card">        
            @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif
            <div class="card-header">
                <h4>Diseños
                    <input type="search" wire:model="search" class="form-control float-end" placeholder="Buscar Diseño" style="width: 230px" />
                    @if (auth()->user()->role_id == 1)                       
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createDesignModal" class="btn btn-primary float-end mx-2">Agregar Diseño </button>
                    @endif
                    @if ($design_status == 1)
                        <button type="button" wire:click="designOrder()" class="btn btn-danger float-end">En Espera</button>
                    @else
                        <button type="button" wire:click="designOrder()" class="btn btn-success float-end">Aprobados</button>
                    @endif
                </h4>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @if ($designs->count() > 0)
                        @foreach ($designs as $design)
                            <div class="col">
                                <div class="card">
                                    <img src="{{asset($design->design)}}" width="300" height="200" class="card-img-top" alt="">
                                    <div class="card-body">
                                        @if ($design->status)
                                            <h6 class="text-success">Diseño aprobado</h6>
                                        @else
                                            <h6 class="text-danger">Diseño en espera</h6>
                                        @endif
                                        <h5 class="card-title">{{$design->design_title}}</h5>
                                        <p class="card-text"><strong>Creado por: </strong>{{$design->designer->first_name}} {{$design->designer->last_name}}</p>
                                        <p class="card-text"><strong>Para la empresa: </strong>{{$design->client->company_name}}</p>
                                    </div>
                                    @if (auth()->user()->role_id == 1)
                                        <div class="card-footer"> 
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateDesignModal" wire:click="editDesign({{$design->id}})" class="btn btn-primary">O</button>
                                            @if ($design->removal_status == true)
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDesignModal" wire:click="deleteDesign({{$design->id}})" class="btn btn-danger float-end">X</button>
                                            @else
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDesignModal" wire:click="deleteDesign({{$design->id}})" class="btn btn-success float-end">R</button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="text-danger">No se encontro nigún diseño</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{--Crear diseñador modal --}}
    <div wire:ignore.self class="modal fade" id="createDesignModal" tabindex="-1" aria-labelledby="createDesignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDesignModalLabel">Agregar Diseño</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="createDesign">
                    <div class="modal-body">
                        <div class="row row-cols-1 g-3">
                            <div class="col-6">
                                <label class="form-label">Diseño</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="file" wire:model="design" class="form-control">
                                        <div class="text-success" wire:loading wire:target="design">Cargando...</div>
                                    </div>
                                </div> 
                                @error('design') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">Titulo del diseño</label>
                                <input type="text" wire:model="design_title" class="form-control ">
                                @error('design_title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">Diseñador</label>
                                <select class="form-select" wire:model="designer_id">
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($designers as $designer)
                                        <option value="{{$designer->id}}">{{$designer->first_name}} {{$designer->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('designer_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label" >Cliente</label>
                                <select class="form-select" wire:model="client_id" >
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->company_name}}</option>
                                    @endforeach
                                </select>
                                @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Aprobacion del diseño</label>
                                    <input class="form-check-input" wire:model="status" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
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
    
    {{--Actualizar diseño modal --}}
    <div wire:ignore.self class="modal fade" id="updateDesignModal" tabindex="-1" aria-labelledby="updateDesignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDesignModalLabel">Actualizar Diseño</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateDesign">
                    <div class="modal-body">
                        <div class="row row-cols-1 g-3">
                            @if (auth()->user()->role_id == 1)
                                
                                <div class="col">
                                    <label class="form-label">Diseño</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="file" wire:model="design" class="form-control">
                                            <div class="text-success" wire:loading wire:target="design">Cargando...</div>
                                        </div>
                                    </div> 
                                    @error('design') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Diseñador</label>
                                    <select class="form-select" wire:model="designer_id">
                                        <option selected value="">Seleccione...</option>
                                        @foreach ($designers as $designer)
                                            <option value="{{$designer->id}}">{{$designer->first_name}} {{$designer->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('designer_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-6">
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
                            <div class="col-12 mt-4">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Aprobacion del diseño</label>
                                    <input class="form-check-input" wire:model="status" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
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
    
    {{-- Eliminar diseño modal --}}
    <div wire:ignore.self class="modal fade" id="deleteDesignModal" tabindex="-1" aria-labelledby="deleteDesignModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="destroyDesign">
                    <div class="modal-body">
                        <h4 class="text-danger">¿Desea eliminar este diseño?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>