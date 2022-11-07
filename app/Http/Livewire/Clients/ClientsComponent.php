<?php

namespace App\Http\Livewire\Clients;

use App\Models\City;
use App\Models\Client;
use App\Models\State;
use Livewire\Component;

class ClientsComponent extends Component
{
    public $id_client, $company_name, $branch, 
    $first_name_contact, $last_name_contact,
    $phone_contact, $address, $state_id, $city_id;

    public $search = '';

    public $rules = [
        'company_name' => 'required',
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

    public function editClient($id)
    {
        $client = Client::find($id);
        if ($client) {
            
            $this->id_client = $client->id;
            $this->company_name = $client->company_name;
            $this->branch = $client->branch;
            $this->first_name_contact = $client->first_name_contact;
            $this->last_name_contact = $client->last_name_contact;
            $this->phone_contact = $client->phone_contact;
            $this->state_id = $client->state_id;
            $this->city_id = $client->city_id;
            $this->address = $client->address;

        } else {
            return redirect()->route('client.show');
        }
    }

    public function updateClient()
    {
        $this->validate();

        Client::where('id', $this->id_client)->update([
            'company_name' => $this->company_name,
            'branch' => $this->branch,
            'first_name_contact' => $this->first_name_contact,
            'last_name_contact' => $this->last_name_contact,
            'phone_contact' => $this->phone_contact,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Cliente actualizado');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteClient($id)
    {
        $this->id_client = $id;
    }

    public function destroyClient()
    {
        $table = Client::where('id', $this->id_client);

        $status = $table->value('removal_status');

        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }

        $table->update([
            'removal_status' => $removal_status
        ]);

        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
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
        if ($this->search == '') {
            $clients = Client::orderBy('id', 'desc')->paginate(10);
        } else {
            $clients = Client::orderBy('id', 'desc')->where('company_name', 'like', '%' . $this->search . '%')->get();
        }
        return view('livewire.clients.clients-component', compact('clients', 'states', 'cities'));
    }
}
