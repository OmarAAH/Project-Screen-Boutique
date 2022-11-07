<?php

namespace App\Http\Livewire\Designs;

use App\Models\Client;
use App\Models\Design;
use App\Models\Designer;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;

class DesignsComponent extends Component
{
    use WithFileUploads;
    public $design, $design_title, $design_actual, $id_design, $designer_id, $client_id, $status;
    
    public $search = '',
        $design_status = 1;

    public $rules = [
        'designer_id' => 'required',
        'design_title' => 'required',
        'client_id' => 'required',
    ];

    public $validationAttributes =  [
        'client_id' => 'cliente',
        'designer_id' => 'diseñador',
        'design' => 'diseño',
        'design_title' => 'titulo del diseño'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function editDesign($id)
    {
        $design = Design::find($id);

        if($design){
            $this->id_design = $design->id;
            $this->design_actual = $design->design;
            $this->design_title = $design->design_title;
            $this->status = $design->status;
            $this->designer_id = $design->designer_id;
            $this->client_id = $design->client_id;

        }else{
            return redirect()->route('design.show');
        }
    }

    public function updateDesign()
    {        
        $this->validate();

        if(!$this->design){
            $this->design = $this->design_actual;
        } else {
            $this->design = $this->design->store('designs');
        }

        Design::where('id', $this->id_design)->update([
            'design' => $this->design,
            'design_title' => $this->design_title,
            'status' => $this->status,
            'designer_id' => $this->designer_id,
            'client_id' => $this->client_id,
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Diseño actualizado');
    }


    public function createDesign()
    {
        
        $this->validate(
        [
            'design' => 'required|image',
            'design_title' => 'required', 
            'designer_id' => 'required',
            'client_id' => 'required'
        ]);

        if(!$this->status){
            $this->status = 0;
        }
        Design::create([
            'design' => $this->design->store('designs'),
            'design_title' => $this->design_title,
            'status' => $this->status,
            'designer_id' => $this->designer_id,
            'client_id' => $this->client_id,
            'removal_status' => true
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Diseño registrado');
    }

    public function deleteDesign ($id) 
    {
        $this->id_design = $id;
    }

    public function destroyDesign() 
    {
        $table = Design::where('id', $this->id_design);
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
        $this->id_design = '';
        $this->design = '';
        $this->design_title = '';
        $this->status = '';
        $this->designer_id = '';
        $this->client_id = '';
        $this->design_actual = '';
    }

    public function designOrder()
    {
        if ($this->design_status == 1) {
            $this->design_status = 0;
        } else {
            $this->design_status = 1;
        }
    }

    public function render()
    {
        $clients = Client::all();
        $designers = Designer::all();

        if (auth()->user()->role_id == 3){

            if($this->search == '') {
                if ($this->design_status == 1) {
                    $designs = Design::orderBy('id', 'desc')->where('status', 1)->get();
                } else {
                    $designs = Design::orderBy('id', 'desc')->where('status', 0)->get();
                }
                
            }else{
                $designs = Design::orderBy('id', 'desc')
                    ->where('removal_status', 1)
                    ->Where('design_title', 'like', '%'.$this->search.'%')
                    ->orWhereHas('client', function (Builder $query){
                        $query->where('company_name', 'like', '%'.$this->search.'%');
                    })
                    ->orWhereHas('designer',function (Builder $query){
                        $query->where('first_name', 'like', '%'.$this->search.'%');
                        $query->orWhere('last_name', 'like', '%'.$this->search.'%');
                    })
                    ->get();
            }
        }
        
        if (auth()->user()->role_id == 1){

            if($this->search == '') {
                if ($this->design_status == 1) {
                    $designs = Design::orderBy('id', 'desc')->where('status', 1)->get();
                } else {
                    $designs = Design::orderBy('id', 'desc')->where('status', 0)->get();
                }

            }else{

                $designs = Design::orderBy('id', 'desc')
                    ->Where('design_title', 'like', '%'.$this->search.'%')
                    ->orWhereHas('client', function (Builder $query){
                        $query->where('company_name', 'like', '%'.$this->search.'%');
                    })
                    ->orWhereHas('designer',function (Builder $query){
                        $query->where('first_name', 'like', '%'.$this->search.'%');
                        $query->orWhere('last_name', 'like', '%'.$this->search.'%');
                    })
                    ->get();
            }
        }
        return view('livewire.designs.designs-component', compact('designs', 'designers', 'clients'));
    }
}
