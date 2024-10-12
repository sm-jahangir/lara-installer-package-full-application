<?php

namespace Codersgift\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;



class InstallerController extends Controller
{
    public function index()
    {
      return "This is require to installation first";
    }
    public function store(Request $request)
    {
    }
}