<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataMitra extends Model
{
    protected $table = 'data_mitra';
    protected $primaryKey = 'id_mitra';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'Jenis',
        'status',
        'no_identitas',
        'nama',
        'email',
        'tgl_perjanjian',
        'masa_berlaku_identitas',
        'alamat',
        'no_tlpn',
        'foto_identitas',
        'keperluan',
        'nama_perwakilan',
        'penyewa_selaku',
        'kota_penyewa',
        'kode_pos',
        'fax_penyewa',
        'npwp',
        'no_penetapan_pengadilan',
        'tgl_penetapan_pengadilan',
        'no_izin_berusaha',
        'tgl_izin_usaha',
        'sk_dirjen_pajak',
        'tgl_sk_dirjen_pajak',
        'surat_pengukuhan_kena_pajak',
        'tgl_surat_pengukuhan_kena_pajak',
        'no_akta_pendirian',
        'tgl_akta_pendirian',
        'no_anggaran_dasar',
        'tgl_anggaran_dasar',
        'no_kenmenhum_dan_ham',
        'tgl_persetujuan_kenmenhum_dan_ham',
    ];

    protected $hidden = [];

    protected $casts = [
        'tgl_perjanjian' => 'date',
        'masa_berlaku_identitas' => 'date',
        'tgl_penetapan_pengadilan' => 'date',
        'tgl_izin_usaha' => 'date',
        'tgl_sk_dirjen_pajak' => 'date',
        'tgl_surat_pengukuhan_kena_pajak' => 'date',
        'tgl_akta_pendirian' => 'date',
        'tgl_anggaran_dasar' => 'date',
        'tgl_persetujuan_kenmenhum_dan_ham' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
    
    public function dataAset()
    {
        return $this->hasMany(DataAset::class, 'id_mitra', 'id_mitra');
    }

    public function perjanjianSewa()
    {
        return $this->hasMany(PerjanjianSewa::class, 'id_mitra', 'id_mitra');
    }

}
