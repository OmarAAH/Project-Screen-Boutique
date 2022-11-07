<?php

namespace App\Http\Livewire\Sales;

use App\Models\Client;
use App\Models\Delivery;
use App\Models\Design;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SalesComponent extends Component
{
    public $sold, $product_id, $delivery_id, $client_id, 
    $employee_id, $design_id, $total, $created_at,
    $id_sale, $date_delivery, $create_delivery, $delete_delivery; 
    
    public $search = '';

    public $rules = [
        'sold' => 'required|numeric',
        'product_id' => 'required',
        'delivery_id' => 'required',
        'client_id' => 'required',
        'design_id' => 'required',
    ];

    public $validationAttributes =  [
        'sold' => 'cantidad',
        'product_id' => 'producto',
        'delivery_id' => 'empresa de envio',
        'client_id' => 'cliente',
        'design_id' => 'diseño'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function logValues()
    {
        $product = Product::find($this->product_id);

        if ($product->quantity >= $this->sold) {
            
            $this->total = ((int)$this->sold * (float)$product->price);

            $product->quantity = ((int)$product->quantity - (int)$this->sold);            
            $product->save();
            return true;
            
        } else {                      
            return false;
        }        
    }

    public function createSales()
    {
        $this->validate();
        $next = $this->logValues();
        
        if ($next) {

            $this->employee_id = auth()->user()->employee->id;
            $this->created_at = now();
            
            Sale::create([
                'created_at' => $this->created_at,
                'sold' => $this->sold,
                'total' => $this->total,
                'employee_id' => $this->employee_id,
                'product_id' => $this->product_id,
                'delivery_id' => $this->delivery_id,
                'client_id' => $this->client_id,
                'design_id' => $this->design_id,
            ]);
            
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','Venta Registrada');
        } else {
            session()->flash('error','No hay suficientes productos en existencia');
        }
    }

    public function dateDelivery($id)
    {
        $this->id_sale = $id;
    }

    public function createDateDelivery()
    {
        $this->validate(['date_delivery' => 'required']);

        $sale = Sale::find($this->id_sale);
        $sale->date_delivery = $this->date_delivery;
        $sale->save();
        
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','Fecha de envio registrada');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->sold = '';
        $this->product_id = '';
        $this->delivery_id = '';
        $this->client_id = '';
        $this->design_id = '';
        $this->total = '';
        $this->created_at = '';
        $this->date_delivery = '';
        $this->id_sale = '';
    }

    // AGREGAR Y ELIMINAR DE EMPRESA DE ENVIOS
    public function resetInputDelivery()
    {
        $this->create_delivery = ''; 
        $this->delete_delivery = '';
    }
    public function createDelivery() 
    {

        $delivery = new Delivery();
        $delivery->company = $this->create_delivery;
        $delivery->save();

        $this->resetInputDelivery();
        session()->flash('message','Empresa de envio registrada');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteDelivery() 
    {
        
        $table = Delivery::where('id', $this->delete_delivery);

        $status = $table->value('removal_status');
        
        if ($status == true) {
            $removal_status = false;
        } else {
            $removal_status = true;
        }
        
        $table->update([
            'removal_status' => $removal_status
        ]);
        
        $this->resetInputDelivery();
        session()->flash('message', 'Estado Actualizado');
        $this->dispatchBrowserEvent('close-modal');

    }

    public function render()
    {
        if($this->search == '') {
            $sales = Sale::orderBy('id', 'desc')->paginate(10);
        }else{
            $sales = Sale::orderBy('id', 'desc')
                ->where('created_at', 'like', '%'.$this->search.'%')
                ->get();
        }
        
        $deliveries = Delivery::where('removal_status',1)->get();
        $designs = Design::where('removal_status',1)->get();
        $clients = Client::where('removal_status',1)->get();

        $products = Product::where('removal_status',1)                
        ->WhereHas('color',function (Builder $query){
            $query->where('removal_status', 1);
        })
        ->WhereHas('type',function (Builder $query){
            $query->where('removal_status', 1);
        })
        ->WhereHas('size',function (Builder $query){
            $query->where('removal_status', 1);
        })
        ->get();

        return view('livewire.sales.sales-component', compact('sales', 'products', 'designs', 'clients', 'deliveries'));
    }
}
