<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAset extends Model
{
    protected $table = 'data_aset';
    protected $primaryKey = 'id_aset';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'lokasi',
        'luas_tanah',
        'luas_bangunan',
        'penggunaan_objek',
    ];
    protected $hidden = [];
    protected $casts = [
        'luas_tanah' => 'integer',
        'luas_bangunan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function dataMitra()
    {
        return $this->belongsTo(DataMitra::class, 'id_mitra', 'id_mitra');
    }
    public function perjanjianSewa()
    {
        return $this->hasMany(PerjanjianSewa::class, 'id_aset', 'id_aset');
    }
}
