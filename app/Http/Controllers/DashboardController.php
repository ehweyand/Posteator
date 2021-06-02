<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {

    // Definindo o uso de um middleware no construtor

    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {
        return view('dashboard');
    }
}
