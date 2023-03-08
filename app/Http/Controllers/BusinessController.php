<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index() {
        
        $businesses = Business::create([
            'name' => 'Jon snow',
            'email' => 'jon@snow.com',
            'address'=> 'Rua a quadra b'
        ]);

        dd($businesses);
    }
}
