<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Clientes
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Buscar Cliente" style="width: 230px" />
                            <a class="btn btn-secondary float-end" href="{{route('report.clients')}}">Reporte</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Nombre de la Empresa</th>
                                    <th>Rama de la Empresa</th>
                                    <th>Nombre del Contacto</th>
                                    <th>Apellido del Contacto</th>
                                    <th>Teléfono de Contacto</th>
                                    <th>Estado</th>
                                    <th>Ciudad</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($clients->count() > 0)
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{$client->company_name}}</td>
                                            <td>{{$client->branch}}</td>
                                            <td>{{$client->first_name_contact}}</td>
                                            <td>{{$client->last_name_contact}}</td>
                                            <td>{{$client->phone_contact}}</td>
                                            <td>{{$client->state->state}}</td>
                                            <td>{{$client->city->city}}</td>
                                            <td>{{$client->address}}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateClientModal" wire:click="editClient({{$client->id}})" class="btn btn-primary">Editar</button>
                                            </td>
                                            <td>
                                                @if ($client->removal_status == true)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteClientModal" wire:click="deleteClient({{$client->id}})" class="btn btn-danger">Eliminar</button>
                                                @else
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteClientModal" wire:click="deleteClient({{$client->id}})" class="btn btn-success">Restaurar</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-danger">No hay Clientes en inventario</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($search == '')  
                            {{ $clients->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Update Cliente Modal -->

    <div wire:ignore.self class="modal fade" id="updateClientModal" tabindex="-1" aria-labelledby="updateClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateClientModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateClient">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Nombre de la Empresa</label>
                                <input type="text" wire:model="company_name" class="form-control">
                                @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-6">
                                <label class="form-label">Rama de la Empresa</label>
                                <input type="text" wire:model="branch" class="form-control">
                                @error('branch') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-6">
                                <label class="form-label">Nombre del Contacto</label>
                                <input type="text" wire:model="first_name_contact" class="form-control">
                                @error('first_name_contact') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-6">
                                <label class="form-label">Apellido del Contacto</label>
                                <input type="text" wire:model="last_name_contact" class="form-control">
                                @error('last_name_contact') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-10">
                                <label class="form-label">Teléfono de Contacto</label>
                                <input type="text" wire:model="phone_contact" class="form-control">
                                @error('phone_contact') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-6">
                                <label class="form-label" >Estado</label>
                                <select class="form-select" wire:model="state_id" >
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->state}}</option>
                                    @endforeach
                                </select>
                                @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-6">
                                <label class="form-label" >Ciudad</label>
                                <select class="form-select" wire:model="city_id" >
                                    <option selected value="">Seleccione...</option>
                                    @foreach ($cities as $city)
                                        @if ($city->state_id == $state_id)                                  
                                            <option value="{{$city->id}}">{{$city->city}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="col-12">
                                <label class="form-label">Dirección</label>
                                <textarea class="form-control" wire:model="address" rows="5"></textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Delete Client Modal -->
    <div wire:ignore.self class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="destroyClient">
                    <div class="modal-body">
                        <h4 class="text-danger">¿Desea cambiar el estado de este cliente?</h4>
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
