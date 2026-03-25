<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/liste-etudiant', function() {
    return view('liste');
}); 