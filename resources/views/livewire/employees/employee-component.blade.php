<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Empleados
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Buscar Empleado" style="width: 230px" />
                            <a class="btn btn-secondary float-end" href="{{route('report.employees')}}">Reporte</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Fotografía</th>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($employees->count() > 0)
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td><img src="{{asset($employee->photo)}}" alt="" width="40" height="40" class="img-radius"></td>
                                            <td>{{$employee->ci}}</td>
                                            <td>{{$employee->first_name}}</td>
                                            <td>{{$employee->last_name}}</td>
                                            <td>{{$employee->phone}}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateUserModal" wire:click="userEmployee({{$employee->id}})" class="btn btn-outline-primary">Modificar Usuario</button>
                                            </td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal" wire:click="editEmployee({{$employee->id}})" class="btn btn-primary">Actualizar</button>
                                            </td>
                                            <td>
                                                @if ($employee->removal_status == true)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" wire:click="deleteEmployee({{$employee->id}})" class="btn btn-danger">Eliminar</button>
                                                @else
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" wire:click="deleteEmployee({{$employee->id}})" class="btn btn-success">Restaurar</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-danger">No se encontro nigún empleado</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($search == '')
                            {{ $employees->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{{-- usuario modal --}}

    <div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveUser">

                    <div class="modal-body">
                        @if (session()->has('error'))
                            <span class="text-danger">{{ session('error') }}</span>
                        @endif
                        <div class="col-12 mb-3">
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" wire:model="user" class="form-control">
                            @error('user') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="password" wire:model="password" class="form-control">
                                <button onclick="seePassword('password')" type="button" class="btn btn-outline-secondary">O</button>
                            </div>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-12 mb-3">
                            <label class="form-label">Confirmacion de la contraseña</label>
                            <div class="input-group">
                                <input type="password" id="confirmation" wire:model="password_confirmation" class="form-control">
                                <button onclick="seePassword('confirmation')" type="button" class="btn btn-outline-secondary">O</button>
                            </div>
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-12 mb-3">
            
                            <h6>Rol</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  wire:model="role" name="role" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Administrador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  wire:model="role" name="role" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Inventario</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  wire:model="role" name="role" id="inlineRadio3" value="3" >
                                <label class="form-check-label" for="inlineRadio3">Vendedor</label>
                            </div>
                            <div >
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizr</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Employee Modal -->

    <div wire:ignore.self class="modal fade" id="updateEmployeeModal" tabindex="-1" aria-labelledby="updateEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEmployeeModalLabel">Editar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateEmployee">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Cédula</label>
                                <input type="text" wire:model="ci" class="form-control" >
                                @error('ci') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">Fotografía</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="file" wire:model="photo" class="form-control">
                                        <div class="text-success" wire:loading wire:target="photo">Cargando...</div>
                                    </div>
                                    @if ($photo)
                                    <div class="col">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="" width="40" height="40" class="img-radius">
                                    </div>
                                    @endif
                                </div> 
                                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

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
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Teléfono</label>
                                <input type="text" wire:model="phone" class="form-control " >
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
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
    
    <!-- Delete Employee Modal -->
    <div wire:ignore.self class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="destroyEmployee">
                    <div class="modal-body">
                        <h4 class="text-danger">¿Desea cambiar el estado de este empleado?</h4>
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
