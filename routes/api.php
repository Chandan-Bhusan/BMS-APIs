<?php

use App\Http\Controllers\APIsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/test',function(){
//     return ["Name" => "APIs testing"];
// });

Route::get('/post_blog',[APIsController::class,'Viwe_all_blog']);
Route::post('/test_2',[APIsController::class,'postAPIs']);
Route::put('/update_blog/{id}',[APIsController::class,'Update_Blog']);
Route::delete('/delete_blog/{id}',[APIsController::class,'delete_Blog']);