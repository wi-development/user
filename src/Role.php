<?php

#test123
namespace WI\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * A role may be given various permissions.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	protected $fillable = [
		'name', 'label', 'description'
	];


	public function permissions()
	{
		return $this->belongsToMany(Permission::class);
	}
	/**
	 * Grant the given permission to a role.
	 *
	 * @param  Permission $permission
	 * @return mixed
	 */
	public function givePermissionTo(Permission $permission)
	{
		return $this->permissions()->save($permission);
	}

	//Role hasMany Users
	public function users()
	{
		return $this->hasMany('App\User', 'role_id', 'id');
	}
}
