<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Facades\File; 


class ImportController extends Controller
{
    public function import (Request $request) {
    	$this->validate($request, [
    		'fichier' => 'bail|required|file|mimes:ics'
    	]);

    	// 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
    	$fichier = $request->fichier->move(public_path(), $request->fichier->hashName());
        $courses = Session::importICS($fichier);
        File::delete($fichier);
        return view('import');

    }

    public function importIndex () {
        return view('import');
    }

}
