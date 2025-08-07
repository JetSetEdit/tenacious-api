<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Display API documentation.
     */
    public function index()
    {
        return view('documentation.index');
    }
}
