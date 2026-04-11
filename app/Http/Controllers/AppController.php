<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function listeEtudiant(){

        $liste = ["koffi yao","fatima DIA","kouakou BBL"];
        
        return view('liste',compact('liste'));
    }

}
