<?php

namespace App\Http\Livewire\Products;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class InventoryComponent extends Component
{
    public $id_product, $code, $quantity, $actual_quantity, 
        $resupply, $price, $returns, $recycling;

    public $search = '';

    public $rules = [
        'price' => 'required|numeric',
        'returns' => 'numeric|min:0',
        'resupply' => 'numeric|min:0',
        'recycling' => 'numeric|min:0',
    ];

    public $validationAttributes =  [
        'price' => 'precio',
        'resupply' => 'de reabastecimiento',
        'returns' => 'devoluciones',
        'recycling' => 'reciclaje',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        if ($product) {

            $this->id_product = $product->id;
            $this->code = $product->code;
            $this->quantity = $product->quantity;
            $this->actual_quantity = $product->quantity;
            $this->price = $product->price;
            $this->value_returns = $product->returns;
            $this->value_recycling = $product->recycling;

        } else {
            return redirect()->route('inventory.show');
        }
    }

    public function valueNull()
    {
        if ($this->resupply == '') {$this->resupply = 0;}
        if ($this->resupply == '') {$this->resupply = 0;}
        if ($this->resupply == '') {$this->resupply = 0;}
       
        $this->recycling = ((int)$this->recycling + (int)$this->value_recycling);
        $this->returns = ((int)$this->returns + (int)$this->value_returns);
    }

    public function updateProduct()
    {
        $this->valueNull();
        $this->validate();

        $product = Product::find($this->id_product);

        $product->quantity = $this->actual_quantity;
        $product->price = $this->price;
        $product->returns = $this->returns;
        $product->recycling = $this->recycling;

        $product->save();

        session()->flash('message', 'Producto actualizado');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteProduct($id)
    {
        $this->id_product = $id;
    }

    public function destroyProduct()
    {
        $table = Product::where('id', $this->id_product);

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
        $this->id_produc = '';
        $this->code = '';
        $this->quantity = '';
        $this->actual_quantity = '';
        $this->resupply = '';
        $this->price = '';
        $this->returns = '';
        $this->recycling = '';
    }

    public function actualQuantity()
    {
        $this->actual_quantity = ((int)$this->quantity + (int)$this->resupply) - ((int)$this->returns + (int)$this->recycling);
    }

    public function render()
    {
        $this->actualQuantity();

        if (auth()->user()->role_id == 3) {

            if ($this->search == '') {
                $products = Product::orderBy('id', 'desc')
                ->where('removal_status', 1)
                ->WhereHas('color',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('type',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('size',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->paginate(10);

            } else {
                $products = Product::orderBy('id', 'desc')
                ->where('removal_status', 1)
                ->WhereHas('color',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('type',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('size',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->where('code', 'like', '%' . $this->search . '%')
                ->get();
            }

        } else {

            if ($this->search == '') {
                $products = Product::orderBy('id', 'desc')
                ->WhereHas('color',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('type',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('size',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->paginate(10);

            } else {
                $products = Product::orderBy('id', 'desc')
                ->WhereHas('color',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('type',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->WhereHas('size',function (Builder $query){
                    $query->where('removal_status', 1);
                })
                ->where('code', 'like', '%' . $this->search . '%')
                ->get();
            }
        }
        return view('livewire.products.inventory-component', compact('products'));
    }
}
