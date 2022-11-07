<?php

namespace App\Http\Livewire\Products;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use Livewire\Component;

class ProductComponent extends Component
{
    public $id_product, $code, $quantity, $price, $color_id, $type_id, $size_id,
        $create_color, $delete_color,
        $create_type, $delete_type,
        $create_size, $delete_size;

    public $rules = [
        'code' => 'required|unique:products',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        'color_id' => 'required',
        'type_id' => 'required',
        'size_id' => 'required',
    ];

    public $messages = [
        'code.unique' => 'El codigo ya ha sido registrado',
        'lt' => 'El campo :attribute debe ser menor a la cantidad de bolasas',
    ];

    public $validationAttributes = [
        'code' => 'codigo',
        'quantity' => 'catidad',
        'price' => 'precio',
        'color_id' => 'color',
        'type_id' => 'tipo',
        'size_id' => 'tamaño',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveProduct()
    {
        $this->validate();

        Product::create([
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'color_id' => $this->color_id,
            'type_id' => $this->type_id,
            'size_id' => $this->size_id,
            'removal_status' => true
        ]);

        $this->resetInput();
        session()->flash('message','Producto agragado');
    }

    public function resetInput()
    {
        $this->code = '';
        $this->quantity = '';
        $this->price = '';
        $this->color_id = '';
        $this->type_id = '';
        $this->size_id = '';
    }

// CREAR Y ELIMINAR DE COLORES 
    public function resetInputColor()
    {
        $this->create_color = ''; 
        $this->delete_color = '';
    }
    public function createColor() 
    {

        $color = new Color();
        $color->color = $this->create_color;
        $color->removal_status = true;
        $color->save();

        $this->resetInputColor();
        session()->flash('message','Color Creado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteColor() 
    {
       
        $table = Color::where('id', $this->delete_color);

        $status = $table->value('removal_status');

        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }

        $table->update([
            'removal_status' => $removal_status
        ]);

        $this->resetInputType();
        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');


        $this->resetInputColor();
        session()->flash('message','Color Eliminado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');

    }

// CREAR Y ELIMINAR DE TIPO 
    public function resetInputType()
    {
        $this->create_type = ''; 
        $this->delete_type = '';
    }

    public function createType() 
    {

        $type = new Type();
        $type->type = $this->create_type;
        $type->removal_status = true;
        $type->save();

        $this->resetInputType();
        session()->flash('message','Tipo de bolsa Creado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteType() 
    {
        $table = Type::where('id', $this->delete_type);

        $status = $table->value('removal_status');

        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }

        $table->update([
            'removal_status' => $removal_status
        ]);

        $this->resetInputType();
        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }
    
    // CREAR Y ELIMINAR DE TAMAÑO
    public function resetInputSize()
    {
        $this->create_size = ''; 
        $this->delete_size = '';
    }
    public function createSize() 
    {

        $size = new Size();
        $size->size = $this->create_size;
        $size->removal_status = true;
        $size->save();

        $this->resetInputSize();
        session()->flash('message','Tamaño de bolsa Creado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteSize() 
    {
        $table = Size::where('id', $this->delete_size);

        $status = $table->value('removal_status');

        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }

        $table->update([
            'removal_status' => $removal_status
        ]);

        $this->resetInputSize();
        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function render()
    {
        $colors = Color::all();
        $types = Type::all();
        $sizes = Size::all();
        return view('livewire.products.product-component', compact('colors', 'types', 'sizes'));
    }
}
