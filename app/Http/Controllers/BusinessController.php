<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index() {
        $businesses =  Business::find(1);
        // $businesses->delete();
        dd($businesses->toArray());
    }
}
