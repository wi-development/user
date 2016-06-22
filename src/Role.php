<?php

#test123
namespace WI\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //protected $table = 'roles';
	
	//public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];
	
	//Role hasMany Users
    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
