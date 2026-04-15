<?php
 use App\Http\Controllers\User\HomeController;
 use Illuminate\Support\Facades\Route;

 Route:: middleware(['auth', ])
 -> group(function (){
    Route:: get('/home', [HomeController::class, 'index']);
 });