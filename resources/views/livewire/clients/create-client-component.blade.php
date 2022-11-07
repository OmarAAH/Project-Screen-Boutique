<div>
    <div class="container">
        @if(session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif 
        <div class="card">
            <div class="card-header">
                <h4>Registro de Cliente</h4>
            </div>
            <form wire:submit.prevent="saveClient" >
                <div class="card-body">
                    <div class="row g-3">

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

                        <div class="col-4">
                            <label class="form-label">Nombre del Contacto</label>
                            <input type="text" wire:model="first_name_contact" class="form-control">
                            @error('first_name_contact') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Apellido del Contacto</label>
                            <input type="text" wire:model="last_name_contact" class="form-control">
                            @error('last_name_contact') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-4">
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

                        @if($state_id > 0)
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
                        @endif

                        @if($city_id > 0)
                            <div class="col-12">
                                <label class="form-label">Dirección</label>
                                <textarea class="form-control" wire:model="address" rows="5"></textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-footer mt-4">
                        <div class="d-grid col-3 mx-auto my-3">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Agregar</button>
                        </div>
                    </div>
                    
                </div>
            </form> 
        </div>
    </div>
</div>
