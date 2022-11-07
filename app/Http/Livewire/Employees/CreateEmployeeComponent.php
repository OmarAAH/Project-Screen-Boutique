<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEmployeeComponent extends Component
{   
    use WithFileUploads;
    public $ci_employee, $ci, $first_name, $last_name, $phone, $profile, 
        $user, $password, $password_confirmation, $role;

    public $rules = [
            'ci' => 'required|numeric|unique:employees',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'phone' => 'required|max:11',
    ];
     
    public $validationAttributes = [
            'ci' => 'cédula',
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'phone' => 'teléfono',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveEmployee()
    {
        $this->validate();

        if(!$this->profile){
            $profile = 'images/profile-default.png';
        } else {
            $profile = $this->profile->store('profiles');
        }

        Employee::create([
            'ci' => $this->ci,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'photo' => $profile,
            'removal_status' => true
        ]); 

        $this->resetInput();
        session()->flash('message','Empleado agragado');
    }

    public function saveUser()
    {
        $this->validate(
            [
                'user' => 'required|unique:users',
                'password' => 'required|confirmed|size:8',
                'password_confirmation' => 'required|size:8',
                'role' => 'required'
            ],
            [
                'confirmed' => 'El campo de confirmación de contraseña no coincide'
            ],
            [
                'user' => 'usuario',
                'password' => 'contraseña',
                'password_confirmation' => 'confirmación de contraseña',
                'role' => 'rol'
            ]
        );

        $id = Employee::where('ci', $this->ci_employee)->value('id');
        if ($id) {
            User::create([
                'user' => $this->user,
                'password' => bcrypt($this->password),
                'role_id' => $this->role,
                'employee_id' => $id,
                'removal_status' => true
            ]);

            $this->closeModal();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','Usuario agragado');

        } else {
            session()->flash('error','Primero tiene que agregar un empleado');
        }
    }

    public function closeModal()
    {
        $this->resetInputUser();
    }

    public function resetInputUser()
    {
        $this->user = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
    }

    public function resetInput()
    {
        $this->ci_employee = $this->ci;
        $this->ci = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->phone = '';
        $this->profile = '';
    }

    public function render()
    {
        return view('livewire.employees.create-employee-component');
    }
}
