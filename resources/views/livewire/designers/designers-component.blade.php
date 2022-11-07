<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Diseñadores
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Buscar Diseño" style="width: 230px" />
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createDesignerModal" class="btn btn-primary float-end mx-2">Agregar Diseñador</button>
                            <a class="btn btn-secondary float-end" href="{{route('report.designers')}}">Reporte</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($designers->count() > 0)
                                    @foreach ($designers as $designer)
                                        <tr>
                                            <td>{{$designer->first_name}}</td>
                                            <td>{{$designer->last_name}}</td>
                                            <td>{{$designer->phone}}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateDesignerModal" wire:click="editDesigner({{$designer->id}})" class="btn btn-primary">Actualizar</button>
                                            </td>
                                            <td>
                                                @if ($designer->removal_status == true)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDesignerModal" wire:click="deleteDesigner({{$designer->id}})" class="btn btn-danger">Eliminar</button>
                                                @else
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDesignerModal" wire:click="deleteDesigner({{$designer->id}})" class="btn btn-success">Restaurar</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-danger">No se encontro nigún diseñador</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($search == '')
                            {{ $designers->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--Crear diseñador modal --}}
<div wire:ignore.self class="modal fade" id="createDesignerModal" tabindex="-1" aria-labelledby="createDesignerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDesignerModalLabel">Agregar Diseñador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="createDesigner">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" wire:model="first_name" class="form-control ">
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label class="form-label">Apellido</label>
                                <input type="text" wire:model="last_name" class="form-control " >
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" wire:model="phone" class="form-control " >
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
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

{{--Actualizar diseñador modal --}}
    <div wire:ignore.self class="modal fade" id="updateDesignerModal" tabindex="-1" aria-labelledby="updateDesignerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDesignerModalLabel">Editar Diseñador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateDesigner">
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-6 mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" wire:model="first_name" class="form-control ">
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-6 mb-3">
                                <label class="form-label">Apellido</label>
                                    <input type="text" wire:model="last_name" class="form-control " >
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" wire:model="phone" class="form-control " >
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
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

{{-- Eliminar diseñador modal --}}
    <div wire:ignore.self class="modal fade" id="deleteDesignerModal" tabindex="-1" aria-labelledby="deleteDesignerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="destroyDesigner">
                    <div class="modal-body">
                        <h4 class="text-danger">¿Desea cambiar el estado de este diseñador?</h4>
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


