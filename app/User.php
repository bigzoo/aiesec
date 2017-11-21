<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
      $destinationPath = public_path('/images/profileImages' .'/' . $userId);
      // Save the image in the folder
      $image->move($destinationPath, $imageName);
      return $imageName;
    }
}
