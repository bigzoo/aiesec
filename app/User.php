<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.company' => 10,
            'users.title' => 10,
            'users.year-start' => 10,
            'users.year-end' => 10,
        ]
    ];


    protected $fillable = [
        'name', 'email', 'password', 'company', 'title', 'year-start', 'year-end', 'image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $image
     * @param $userId
     * @return mixed
     */
    public static function image($image, $userId){
      // Name the image
      $imageName = $userId;
      // Set the destination path of the image
      $destinationPath = public_path('/images/profileImages');
      // Save the image in the folder
      $image->move($destinationPath, $imageName);
      return $imageName;
    }

    /**
     * [advancedSearch] Queries all fields of the user
     * @param  Request $request [description]
     * @return [type]          [description]
     */
    public static function advancedSearch(Request $request){
      $name = $request->get('name') ?? "" ?: null;
      $company = $request->get('company') ?? "" ?: null;
      $title = $request->get('title') ?? "" ?: null;
      $yearStart = $request->get('year-start') ?? "" ?: null;
      $yearEnd = $request->get('year-end') ?? "" ?: null;
      return User
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
          });
    }
}
