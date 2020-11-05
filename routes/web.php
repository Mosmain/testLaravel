<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/search', function() {
   $q = Input::get('q');
   if ($q != ' ') {
      $user = User::where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('email', 'LIKE', '%' . $q . '%')
                    ->get();
      if ((count($user) > 0) || ($user != '@') || ($user != '.')) {
         return view ('welcome')->withDetails($user)->withQuery($q);
      } 
   }
   return view ('welcome')->withMessage("I can't found anyone");
});