<?php

namespace WI\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	protected $fillable = [
		'name', 'label', 'description','permissiontype_id'
	];



	/**
	 * A permission can be applied to roles.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

	public function permissiontype(){
		return $this->belongsTo('WI\User\PermissionType');
	}

	public function companxxxxy(){
		return $this->belongsTo('WI\Core\Entities\Company\Company');			//foreign key belongsTo
	}

	public function getPermissionxxTypeListAttribute(){
		//dc($this->components);
		return $this->permissionType->lists('id')->all();
	}
}
