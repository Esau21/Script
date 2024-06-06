<?php

namespace App\Http\Controllers;

use App\Imports\Filefix;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function fileupload(Request $request)
    {
        $file = $request->file('import_file');
        Excel::import(new Filefix, $file);
    }
}
