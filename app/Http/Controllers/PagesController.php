<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class PagesController extends Controller{
    public function home(Request $request){
      // TODO: Move this search to the User model.

      // Simle query
      $q = $request->get('q');
      if ($q) {
          $users = User::search($q)->paginate(5);
          return view('index', compact('users', 'q'));
      }
      // Try and advanced search or else return all users (paginated)
      $users = User::advancedSearch($request)->paginate(5);
      return view('index', compact('users', 'name', 'company', 'title', 'yearStart', 'yearEnd'));
    }
}
