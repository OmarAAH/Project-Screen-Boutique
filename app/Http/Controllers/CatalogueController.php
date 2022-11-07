<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function catalogue() {

        $designs = Design::orderBy('id', 'desc')->where('status', 1)->get();
        return view('catalogue', compact('designs'));

    }
}
