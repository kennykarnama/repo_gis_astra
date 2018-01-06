<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Arho extends Model
{
    //
    protected $table = 'arho';

    protected $primaryKey = 'id_arho';

	public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'avatar',
        'is_aktif'
    ];

    protected $guarded = [];
}
