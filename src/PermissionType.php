<?php

namespace WI\User;

use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    protected $table = 'permissiontypes';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'label',
        'description'
    ];



    //many to many
    public function components(){
        //return $this->belongsToMany('App\Component')->withPivot('order_by_number')->orderBy('order_by_number','ASC');

        return $this->belongsToMany('WI\Core\Entities\Component\Component','component_referencetype','referencetype_id','component_id')->withPivot('order_by_number')->orderBy('order_by_number','ASC');
    }

    //relations
    public function references(){
        return $this->hasMany('App\Reference','referencetype_id');
    }




}
