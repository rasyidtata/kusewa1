<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerjanjianSewa extends Model
{
    protected $table = 'perjanjian_sewa'; 
    protected $primaryKey = 'id_perjanjian';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jangka_waktu',
        'masa_awal_perjanjian',
        'masa_akhir_perjanjian',
        'masa_awal_manfaat',
        'masa_akhir_manfaat',
        'harga_sewa',
        'harga_sewa_admin',
        'harga_sewa_admin_com',
        'harga_pemanfaatan',
        'biaya_admin_ukur',
        'total_harga',
        'ppn_11_persen',
        'cost_of_money',
        'terbilang',
        'status',
        'status_persetujuan',
        'persetujuan_kai',
        'persetujuan_mitra',
        'tanggal_persetujuan',
        'catatan_penolakan',
        'id_aset',
        'id_admin',
        'id_mitra',
    ];

    protected $hidden = [];

    protected $casts = [
        'masa_awal_perjanjian' => 'date',
        'masa_akhir_perjanjian' => 'date',
        'masa_awal_manfaat' => 'date',
        'masa_akhir_manfaat' => 'date',

        'harga_sewa' => 'decimal:0',
        'harga_sewa_admin' => 'decimal:0',
        'harga_sewa_admin_com' => 'decimal:0',
        'harga_pemanfaatan' => 'decimal:0',
        'biaya_admin_ukur' => 'decimal:0',
        'total_harga' => 'decimal:0',
        'ppn_11_persen' => 'decimal:0',
        'cost_of_money' => 'decimal:0',

        'persetujuan_kai' => 'boolean',
        'persetujuan_mitra' => 'boolean',

        'tanggal_persetujuan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];


    // perjanjian_sewa.id_mitra → data_mitra.id_mitra
    public function dataMitra()
    {
        return $this->belongsTo(DataMitra::class, 'id_mitra', 'id_mitra');
    }

    // perjanjian_sewa.id_aset → data_aset.id_aset
    public function dataAset()
    {
        return $this->belongsTo(DataAset::class, 'id_aset', 'id_aset');
    }


    /* ACCESSORS */
    public function getJangkaWaktuTahunAttribute()
    {
        if (preg_match('/(\d+)\s*Tahun/i', $this->jangka_waktu, $m)) {
            return $m[1];
        }
        return '0';
    }

    public function getJangkaWaktuBulanAttribute()
    {
        if (preg_match('/(\d+)\s*Bulan/i', $this->jangka_waktu, $m)) {
            return $m[1];
        }
        return '0';
    }

    public function getJangkaWaktuHariAttribute()
    {
        if (preg_match('/(\d+)\s*Hari/i', $this->jangka_waktu, $m)) {
            return $m[1];
        }
        return '0';
    }

    // Format tanggal
    public function getMasaAwalPerjanjianFormattedAttribute()
    {
        return $this->masa_awal_perjanjian
            ? \Carbon\Carbon::parse($this->masa_awal_perjanjian)->format('Y-m-d')
            : null;
    }

    public function getMasaAkhirPerjanjianFormattedAttribute()
    {
        return $this->masa_akhir_perjanjian
            ? \Carbon\Carbon::parse($this->masa_akhir_perjanjian)->format('Y-m-d')
            : null;
    }

    public function getMasaAwalManfaatFormattedAttribute()
    {
        return $this->masa_awal_manfaat
            ? \Carbon\Carbon::parse($this->masa_awal_manfaat)->format('Y-m-d')
            : null;
    }

    public function getMasaAkhirManfaatFormattedAttribute()
    {
        return $this->masa_akhir_manfaat
            ? \Carbon\Carbon::parse($this->masa_akhir_manfaat)->format('Y-m-d')
            : null;
    }


    public static function generateKodePerjanjian()
    {
        $prefix = 'NO/PRJ/SEWA';
        $year = date('y'); // 2 digit tahun
        $month = date('m'); // 2 digit bulan
        
        // Cari record terakhir dengan tahun-bulan yang sama
        $lastRecord = self::where('kode_perjanjian', 'like', $prefix . '/' . $year . '/' . $month . '/%')
            ->orderBy('kode_perjanjian', 'desc')
            ->first();
        
        if ($lastRecord && $lastRecord->kode_perjanjian) {
            // Ambil sequence setelah slash terakhir
            $parts = explode('/', $lastRecord->kode_perjanjian);
            $lastSequence = end($parts);
            $nextSequence = str_pad((int)$lastSequence + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextSequence = '000001';
        }
        
        return $prefix . '/' . $year . '/' . $month . '/' . $nextSequence; 
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->kode_perjanjian)) {
                $model->kode_perjanjian = self::generateKodePerjanjian();
            }
        });
    }
}