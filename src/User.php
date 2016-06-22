<?php

namespace WI\User;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'username', 'email', 'password', 'role_id', 'locale_id', 'settings'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];


  /**
   * The list of attributes to cast.
   *
   * @var array
   */
  /*
   *
   */
  protected $casts = [
      'settings' => 'json'
  ];


  //user settings as json for view config etc.
  public function settings(){
    //dc($this->settings);
    //dc($this->email);
      return new Settings((array) $this->settings, $this);
  }

  //returns json object
  //string to json object
  public function getxSettingsAttribute($settings){
    dc($settings);
    //return $this->attributes['settings'] = ($settings);
    return $this->attributes['settings'] = json_decode($settings);
  }

  //sets array to string
  public function setXSettingsAttribute($settings){
    $this->attributes['settings'] = json_encode($settings);
  }

  //relations
  public function locale(){
    return $this->belongsTo('WI\Locale\Locale');			//foreign key belongsTo
  }

  public function role()
  {
    return $this->belongsTo('WI\User\Role','role_id');	//foreign key belongsTo
  }

  //user roles used in middleware

  public function hasRole($roles)
  {
    $this->have_role = $this->getUserRole();
    // Check if the user is a root account
    if($this->have_role->name == 'Root') {
      return true;
    }
    if(is_array($roles)){
      foreach($roles as $need_role){
        if($this->checkIfUserHasRole($need_role)) {
          return true;
        }
      }
    } else{
      return $this->checkIfUserHasRole($roles);
    }
    return false;
  }

  private function getUserRole()
  {
    return $this->role()->getResults();
  }

  private function checkIfUserHasRole($need_role)
  {
    return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
  }

  //user permissions used in policy

  public function allowedToEditAllUsers($allowedRoles){
    if (in_array($this->getRoleName(), $allowedRoles)) {
      return true;
    }
    return false;
  }

  public function editsOwnProfile($related){
    return $this->id == $related->id;
  }

  public function getRoleName(){
    return $this->role->name;
  }



}