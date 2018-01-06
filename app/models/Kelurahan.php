<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    //
    protected $table = 'kelurahan';

    protected $primaryKey = 'id_kelurahan';

	public $timestamps = false;

    protected $fillable = [
        'nama_kelurahan',
        'lng',
        'lat',
        'is_aktif'
    ];

    protected $guarded = [];
}
