<?php

namespace Modules\Patient\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_family_member extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','family_name','family_nik','gender','date_of_birth','place_of_birth'];
    protected $dates = ['deleted_at'];
}
