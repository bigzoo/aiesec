<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller{
    public function home(Request $request){
      // TODO: Move this search to the User model.
        $q = $request->get('q');
        if ($q) {
            $users = User::search($q)->paginate(5);
            return view('index', compact('users', 'q'));
        }
        $name = $request->get('name') ?? "" ?: null;
        $company = $request->get('company') ?? "" ?: null;
        $title = $request->get('title') ?? "" ?: null;
        $yearStart = $request->get('year-start') ?? "" ?: null;
        $yearEnd = $request->get('year-end') ?? "" ?: null;
        $users = User
            ::select(DB::raw("*"))
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($company, function ($query) use ($company) {
                return $query->where('company', 'LIKE', '%' . $company . '%');
            })
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'LIKE', '%' . $title . '%');
            })
            ->when($yearStart, function ($query) use ($yearStart) {
                return $query->where('year-start', '=', $yearStart);
            })
            ->when($yearEnd, function ($query) use ($yearEnd) {
                return $query->where('year-end', '=', $yearEnd);
            })->paginate(5);
      return view('index', compact('users', 'name', 'company', 'title', 'yearStart', 'yearEnd'));
    }
}
