<div>
    <div class="container">
        @if(session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif 
        <div class="card">
            <div class="card-header">
                <h4>Registro de Empleado</h4>
            </div>
            <form wire:submit.prevent="saveEmployee" >
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Cédula</label>
                            <input maxlength="9" type="text" wire:model="ci" class="form-control">
                            @error('ci') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-6">
                            <label class="form-label">Fotografía</label>
                            <div class="row">
                                <div class="col">
                                    <input type="file" wire:model="profile" class="form-control">
                                    <div class="text-success" wire:loading wire:target="profile">Cargando...</div>
                                </div>
                                @if ($profile)
                                <div class="col">
                                    <img src="{{ $profile->temporaryUrl() }}" alt="" width="40" height="40" class="img-radius">
                                </div>
                                @endif
                            </div> 
                            @error('profile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


            
                        <div class="col-6 ">
                            <label class="form-label">Nombre</label>
                            <input type="text" wire:model="first_name" class="form-control">
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-6 ">
                            <label class="form-label">Apellido</label>
                            <input type="text" wire:model="last_name" class="form-control">
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-5">
                            <label class="form-label">Teléfono</label>
                            <input type="text" wire:model="phone" class="form-control">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
 
                    </div>
                    
                    <div class="card-footer">

                        <div class="d-grid col-3 mx-auto my-3">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Agregar</button>
                        </div>
                    </div>

                </div>
            </form> 
        </div>
    </div>

    {{-- modal de usuario --}}
    <div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveUser">
                    <div class="modal-body">
                        @if(session()->has('error'))
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
                            <label class="form-label">Confirmación de la contraseña</label>
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
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>