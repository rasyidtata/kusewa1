<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerjanjianSewa extends Model
{
    protected $table = 'Perjanjian_sewa';
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function dataMitra()
    {
        return $this->belongsTo(DataMitra::class, 'id_mitra', 'id_mitra');
    }
    public function dataAset()
    {
        return $this->belongsTo(DataAset::class, 'id_aset', 'id_aset');
    }
    //public function admin()
   // {
     //   return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
   // }
    


    public function getJangkaWaktuTahunAttribute()
    {
        if (empty($this->jangka_waktu)) return '0';
        if (preg_match('/(\d+)\s*tahun/i', $this->jangka_waktu, $matches)) {
            return $matches[1];
        }
        return '0';
    }

    public function getJangkaWaktuBulanAttribute()
    {
        if (empty($this->jangka_waktu)) return '0';
        if (preg_match('/(\d+)\s*bulan/i', $this->jangka_waktu, $matches)) {
            return $matches[1];
        }
        return '0';
    }

    public function getJangkaWaktuHariAttribute()
    {
        if (empty($this->jangka_waktu)) return '0';
        if (preg_match('/(\d+)\s*hari/i', $this->jangka_waktu, $matches)) {
            return $matches[1];
        }
        return '0';
    }
}
