<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f = Files::all(); //باستخدام المودل
        return view(
            'create',
            ['f' => $f]

        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent_id_name = $request->get('parent_id_name');
        $fname = $request->get('name');

        if ($request->get('type') == 1) {
            $fsize = $request->file('file_path')->getSize();
        } else {
            $fsize = NULL;
        }
        if($request->hasFile('file_path')){
           $files= $request->file_path;
        if ($files->isValid()) {
            $ffpath = $files->store('/' ,[

                 'disk' =>'upload',
            ]);
        }
    }
        $f = new Files();
        $f->name = $request->get('name');
        $f->type = $request->get('type');
        $f->parent_id = $request->get('parent_id');
        $f->file_path =  $ffpath;
        $f->file_size = $fsize;
        $f->save();

        if ($request->get('type') == 2) {
            $path = public_path('upload/' . $f->name);
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
        } else {
            $request->validate([
                'file_path' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
            ]);
            $ffpath = public_path('upload/' . $parent_id_name);
            // Validation
            if ($request->file('file_path')) {
                $file = $request->file('file_path');
                $filename = $fname . '_' . $file->getClientOriginalName();
                // Upload file
                $file->move($ffpath, $filename);
            }
        }

        return redirect('/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $f = Files::get()->where('type', 1)->where('parent_id', $id); //باستخدام المودل
        return view('show', [
            'f' => $f,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Files::destroy($id);
        return redirect()
            ->route('create')
            ->with('success', ' deleted!');
    }
}
