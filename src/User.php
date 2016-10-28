<?php

namespace WI\User;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{


	use HasRoles;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'username', 'email', 'password', 'role_id', 'locale_id','company_id', 'usertype_id', 'settings'
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
      return new Settings((array) $this->settings, $this);
  }


  /*

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
  */



	public function isBackEndUser()
	{

		if (count($this->usertype) == 0){
			dd('Gebruiker \''.$this->name.'\' heeft geen user type ('.count($this->usertype).')');
		}
		//dc(count($this->usertype));
		//dc($this->usertype);
		//dc($this->usertype->name);
			return ($this->usertype->name == 'back-end');
	}

	public function isFrontEndUser()
	{
		//dc($this->usertype->name);
		return ($this->usertype->name == 'front-end');
	}


	public function isAdmin()
	{

		if ($this->hasRole('developer')){
			return true;
		}
		return false;
/*		foreach ($this->roles()->get() as $role)
		{
			if ($role->name == 'Admin')
			{
				return true;
			}
		}

		return false;*/
	}

  //relations
  public function locale(){
  	return $this->belongsTo('WI\Locale\Locale');			//foreign key belongsTo
  }

	public function company(){
		return $this->belongsTo('WI\Core\Entities\Company\Company');			//foreign key belongsTo
	}

	public function usertype(){
		return $this->belongsTo('WI\User\Usertype');			//foreign key belongsTo
	}

	/*
	 * NEW ROLES PERMISSIONS put in trait HasRoles
	 *

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}


	public function assignRole($role){
		//save can sync
		return $this->roles()->save(
			Role::whereName($role)->firstOrFail()
	  );
	}



	  public function hasPermission($permission)
	  {
		  if (is_string($permission)){
			  //dc('hasPermission');
			  return true;
			  //return $this->roles->contains('name',$permission);
		  }
	  }
	//hasPermission($permission)




	  public function hasPermission($permission)
	  {
		  if (is_string($permission)){
			  dc($permission);
			  //return true;
			  return $this->roles->contains('name',$permission);
		  }
	  }

  */




  /*
   * ORG ROLES
   * */
  public function role()
  {
    return $this->belongsTo('WI\User\Role','role_id');	//foreign key belongsTo
  }

  //user roles used in middleware

  public function hasRoleX($roles)
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

  private function getUserRoleX()
  {
    return $this->role()->getResults();
  }

  private function checkIfUserHasRoleX($need_role)
  {
    return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
  }

  //user permissions used in policy

  public function allowedToEditAllUsersX($allowedRoles){
    if (in_array($this->getRoleName(), $allowedRoles)) {
      return true;
    }
    return false;
  }

  public function editsOwnProfileX($related){
    return $this->id == $related->id;
  }

  public function getRoleNameX(){
    return $this->role->name;
  }



}