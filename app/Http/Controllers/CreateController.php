<?php

namespace App\Http\Controllers;
use App\Models\Files;
use Illuminate\Http\Request;

class CreateController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $f = Files::get()->where('type', 2); //باستخدام المودل
        $f = Files::get()->where('type', 2); //باستخدام المودل
        return view('filemanager', [
            'f' => $f,

        ]);
    }

}
