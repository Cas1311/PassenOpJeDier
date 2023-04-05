<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pet;


// All pets
Route::get('/', function () {
    return view('pets', [
        'heading' => 'Aangeboden Dieren',
        'pets' => Pet::all()
    ]);
});

// Single pet
Route::get('/pets/{id}', function ($id) {
    return view('pet', [
        'pet' => Pet::find($id)
    ]);
});

Route::get('/layout', function () {
    return view('components.layout');
});
