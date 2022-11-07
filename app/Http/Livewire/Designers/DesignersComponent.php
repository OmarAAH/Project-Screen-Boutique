<?php

namespace App\Http\Livewire\Designers;

use App\Models\Designer;
use Livewire\Component;

class DesignersComponent extends Component
{
    public $id_designer, $first_name, $last_name, $phone;
    public $search = '';

    public $rules = [
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'phone' => 'required|max:11',
    ];

    public $validationAttributes =  [
        'first_name' => 'nombre',
        'last_name' => 'apellido',
        'phone' => 'teléfono',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    // MODAL EDITAR Diseñador

    public function editDesigner($id)
    {
        $designer = Designer::find($id);

        if($designer){
            $this->id_designer = $designer->id;
            $this->last_name = $designer->last_name;
            $this->first_name = $designer->first_name;
            $this->phone = $designer->phone;

        }else{
            return redirect()->route('designer.show');
        }
    }

    public function updateDesigner()
    {
        
        $this->validate();

        Designer::where('id', $this->id_designer)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Diseñador actualizado');
    }

    public function createDesigner()
    {
        
        $this->validate();

        Designer::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'removal_status' => true
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Diseñador creado');
    }

    public function deleteDesigner ($id) 
    {
        $this->id_designer = $id;
    }

    public function destroyDesigner() 
    {
        $table = Designer::where('id', $this->id_designer);
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
        $this->first_name = '';
        $this->last_name = '';
        $this->phone = '';
    }

    public function render()
    {
        if($this->search == '') {
            $designers = Designer::orderBy('id', 'desc')->paginate(10);
        }else{
            $designers = Designer::orderBy('id', 'desc')
                ->where('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%')
                ->get();
        }
        return view('livewire.designers.designers-component', compact('designers'));
    }
}
