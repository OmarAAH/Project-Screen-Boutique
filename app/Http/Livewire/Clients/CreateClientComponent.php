<?php

namespace App\Http\Livewire\Clients;

use App\Models\City;
use App\Models\Client;
use App\Models\State;
use Livewire\Component;

class CreateClientComponent extends Component
{
    public $company_name, $branch, $first_name_contact, $last_name_contact,
        $phone_contact, $address, $state_id, $city_id;

    public $rules = [
        'company_name' => 'required|unique:clients',
        'branch' => 'required',
        'first_name_contact' => 'required',
        'last_name_contact' => 'required',
        'phone_contact' => 'required|size:11',
        'state_id' => 'required',
        'city_id' => 'required',
        'address' => 'required',
    ];

    public $validationAttributes = [
        'company_name' => 'nombre de la empresa',
        'branch' => 'rama',
        'first_name_contact' => 'nombre',
        'last_name_contact' => 'apellido',
        'phone_contact' => 'teléfono',
        'state_id' => 'estado',
        'city_id' => 'ciudad',
        'address' => 'dirección',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveClient()
    {
        $this->validate();

        Client::create([
            'company_name' => $this->company_name,
            'branch' => $this->branch,
            'first_name_contact' => $this->first_name_contact,
            'last_name_contact' => $this->last_name_contact,
            'phone_contact' => $this->phone_contact,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'removal_status' => true
        ]);

        $this->resetInput();
        session()->flash('message','Producto agragado');
    }

    public function resetInput()
    {
        $this->company_name = '';
        $this->branch = '';
        $this->first_name_contact = '';
        $this->last_name_contact = '';
        $this->phone_contact = '';
        $this->state_id = '';
        $this->city_id = '';
        $this->address = '';
    }

    public function render()
    {
        $states = State::all();
        $cities = City::all();
        return view('livewire.clients.create-client-component', compact('states', 'cities'));
    }
}
