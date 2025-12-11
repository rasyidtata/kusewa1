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
        'kode_aset',
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




    public static function generateKodeAset()
    {
        $prefix = 'KAIASET';
        
        // Cari record terakhir
        $lastRecord = self::orderBy('id_aset', 'desc')->first();
        
        if ($lastRecord && $lastRecord->id_aset) {
            $nextSequence = str_pad($lastRecord->id_aset + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextSequence = '000001';
        }
        
        return $prefix . $nextSequence; // Contoh: KAIASET000001
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->kode_aset)) {
                $model->kode_aset = self::generateKodeAset();
            }
        });
    }
}
