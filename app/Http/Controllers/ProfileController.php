<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SendInvite;
use App\User;
use Auth;
use Mail;
use Session;
use DB;

class ProfileController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'edit']]);
    }

    /**
     * Show the profile home page.
     *
     */
    public function index(){
        return view('profile.index');
    }

    /**
     * Show the profile edit form.
     *
     */
    public function edit(){
        return view('profile.edit');
    }

    /**
     * Patch updates a user profile.
     *
     */
    public function update(Request $request){
      // Get the current logged in user
        $id = Auth::user()->id;
        // Get the image
        $image = $request->file('image');
        $imageName = User::image($image, $id);
        User::find($id)->update([
          'name' => request('name'),
          'email' => request('email'),
          'company' => request('company'),
          'title' => request('title'),
          'year-start' => request('year-start'),
          'year-end' => request('year-end'),
          'image' => $imageName
        ]);

        return redirect('profile');

    }


  public function invite(){
    $users = request('people');
    foreach ($users as $user) {
      Mail::to($user)->send(new SendInvite);
    }
    Session::flash('message', 'All emails sent succesfully.');
    return redirect('/');
  }

}
