<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Designer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Models\Audit;
use PDF;

class ReportController extends Controller
{
    public $date, $time;

    public function dateTime () {
        $now = Carbon::now('America/Caracas');
        $this->date = $now->format('d/m/Y');
        $this->time = $now->format('H:i:s');
    }
    public function employees()
    {
        $this->dateTime();
        $employees = Employee::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('employee.report', ['employees' => $employees, 'type' => 'Empleados', 'date' => $this->date, 'time' => $this->time]);
        return $pdf->stream();
    }

    public function clients()
    {
        $this->dateTime();
        $clients = Client::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('client.report', ['clients' => $clients, 'type' => 'Clientes', 'date' => $this->date, 'time' => $this->time]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function designers()
    {
        $this->dateTime();
        $designers = Designer::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('designer.report', ['designers' => $designers, 'type' => 'Diseñadores', 'date' => $this->date, 'time' => $this->time]);
        return $pdf->stream();
    }

    public function inventory()
    {
        $this->dateTime();
        $products = Product::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('inventory.report', ['products' => $products, 'type' => 'Productos', 'date' => $this->date, 'time' => $this->time]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function sales()
    {
        $this->dateTime();
        $sales = Sale::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('sales.report', ['sales' => $sales, 'type' => 'Ventas', 'date' => $this->date, 'time' => $this->time]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function audits()
    {
        $this->dateTime();
        $audits = Audit::orderBy('id', 'desc')->get();
        $users = User::all();

        $pdf = Pdf::loadView('audit.report', ['audits' => $audits, 'users' => $users, 'type' => 'Auditoria', 'date' => $this->date, 'time' => $this->time]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
