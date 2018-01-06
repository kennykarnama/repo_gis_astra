<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PenugasanArho extends Model
{
    //
    protected $table = 'penugasan_arho';

    protected $primaryKey = 'id_penugasan_arho';

	public $timestamps = false;

    protected $fillable = [
        'id_arho',
        'id_kelurahan',
        'tgl_input',
        'is_aktif'
    ];

    protected $guarded = [];
}
