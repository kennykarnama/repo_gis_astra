<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $table = 'roles';

    protected $primaryKey = 'id_role';

	public $timestamps = false;

    protected $fillable = [
        'nama_role'
    ];

    protected $guarded = [];
}
