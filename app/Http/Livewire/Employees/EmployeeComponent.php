<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeComponent extends Component
{
    use WithFileUploads;

    public $id_employee, $ci, $first_name, $last_name, $photo_actual, $phone, $photo,
        $user_id, $user_old, $user, $password, $password_confirmation, $role;
    
    public $search = '';

    public $rules = [
        'ci' => 'required|numeric',
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'phone' => 'required|max:11',
    ];

    public $validationAttributes =  [
        'ci' => 'cédula',
        'first_name' => 'nombre',
        'last_name' => 'apellido',
        'phone' => 'teléfono',
        'photo' => 'fotografía',
    ];


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

// MODAL EDITAR EMPLEADO

    public function editEmployee($id)
    {
        $employee = Employee::find($id);

        if($employee){
            $this->id_employee = $employee->id;
            $this->ci = $employee->ci;
            $this->last_name = $employee->last_name;
            $this->first_name = $employee->first_name;
            $this->phone = $employee->phone;
            $this->photo_actual = $employee->photo;

        }else{
            return redirect()->route('employee.show');
        }
    }

    public function updateEmployee ()
    {
        
        $this->validate();

        if(!$this->photo){
            $photo = $this->photo_actual;
        } else {
            $photo = $this->photo->store('profiles');
        }

        Employee::where('id', $this->id_employee)->update([
            'ci' => $this->ci,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'photo' => $photo
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Empleado actualizado');
    }

    public function deleteEmployee ($id) 
    {
        $this->id_employee = $id;
    }

    public function destroyEmployee() 
    {
        $table = Employee::where('id', $this->id_employee);
        $user = User::where('employee_id', $this->id_employee);

        $status = $table->value('removal_status');

        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }

        $table->update([
            'removal_status' => $removal_status
        ]);

        $user->update([
            'removal_status' => $removal_status
        ]);

        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

// MODAL USEUARIO

    public function userEmployee($id)
    {
        $user = User::where('employee_id', $id)->first();
        if($user){
            $this->user_id = $user->id; 
            $this->user = $user->user;
            $this->user_old = $user->user;
            $this->role = $user->role_id;
        } else {
            $this->user_old = null;
            session()->flash('error','Este empleado no posee un usuario');
        }
        $this->id_employee = $id;
    }

    public function saveUser()
    {
        $this->validate(
            [
                'user' => 'required',
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
        
        $repeated = User::where('user', '=', $this->user )->exists();

        if($repeated && $this->user != $this->user_old) {
            session()->flash('error','El usuario agragado es invalido');
        } else {
            User::updateOrInsert(
                [
                    'id'=>$this->user_id
                ],
                [
                    'user' => $this->user,
                    'password' => bcrypt($this->password),
                    'role_id' => $this->role,
                    'employee_id' => $this->id_employee,
                ]);
            $this->closeModal();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','Usuario actualizado');
        }
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->ci = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->phone = '';
        $this->photo = '';
        $this->user = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
    }
    
    public function render()
    {   
        if($this->search == '') {
            $employees = Employee::orderBy('id', 'desc')->paginate(10);
        }else{
            $employees = Employee::orderBy('id', 'desc')
                ->where('ci', 'like', '%'.$this->search.'%')
                ->orwhere('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%')
                ->get();
        }
        return view('livewire.employees.employee-component', compact('employees'));
    }
}
