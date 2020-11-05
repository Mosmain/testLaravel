<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserSearch extends Controller
{
   public function search(Request $request) {
      $q = $request->input('q');
      if ($q != ' ') {
         $user = User::where('name', 'LIKE', '%' . $q . '%')
                     ->orWhere('email', 'LIKE', '%' . $q . '%')
                     ->get();
         if ((count($user) > 0) || ($user != '@') || ($user != '.')) {
            return view ('welcome')->withDetails($user)->withQuery($q);
         } 
      }
      return view ('welcome')->withMessage("I can't found anyone");
   }
}
