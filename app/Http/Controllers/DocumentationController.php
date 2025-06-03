<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('documentation.index'); // Akan merujuk ke resources/views/documentation/index.blade.php
    }
}