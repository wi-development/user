<?php
/**
 * Created by PhpStorm.
 * User: tonny
 * Date: 23-09-16
 * Time: 14:42
 */

namespace WI\User;

trait HasRoles
{
	/**
	 * A user may have multiple roles.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

	public function roleNames()
	{
		$this->roleNames = implode(",", $this->roles()->pluck('name')->all());
		return $this->roleNames;
	}
	/**
	 * Assign the given role to the user.
	 *
	 * @param  string $role
	 * @return mixed
	 */
	public function assignRole($role)
	{
		return $this->roles()->save(
			Role::whereName($role)->firstOrFail()
		);
	}
	/**
	 * Determine if the user has the given role.
	 *
	 * @param  mixed $role
	 * @return boolean
	 */
	public function hasRole($role)
	{

		//dc('HAS ROLE');
		//dc($this->roles);
		if (is_string($role)) {
			return $this->roles->contains('name', $role);
		}
		return !! $role->intersect($this->roles)->count();
	}
	/**
	 * Determine if the user may perform the given permission.
	 *
	 * @param  Permission $permission
	 * @return boolean
	 */
	public function hasPermission(Permission $permission)
	{
		return $this->hasRole($permission->roles);
	}
}
