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
        'kode_mitra',
        'Jenis',
        'status',
        'no_identitas',
        'nama',
        'email',
        'tgl_perjanjian',
        'penyewa_berdasarkan',
        'masa_berlaku_identitas',
        'alamat',
        'no_tlpn',
        'foto_identitas',
        'kategori',
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
        'alasan_penolakan'
    ];

    protected $hidden = [];

    protected $casts = [
        'tgl_perjanjian' => 'date',
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




    public function getTglPerjanjianFormattedAttribute()
    {
        return $this->tgl_perjanjian 
            ? \Carbon\Carbon::parse($this->tgl_perjanjian)->format('Y-m-d'): null;
    }

    public function getTglAnggaranDasarFormattedAttribute()
    {
        return $this->tgl_anggaran_dasar
            ? \Carbon\Carbon::parse($this->tgl_anggaran_dasar)->format('Y-m-d'): null;
    }
    public function getTglPersetujuanKenmenhumDanHamFormattedAttribute()
    {
        return $this->tgl_persetujuan_kenmenhum_dan_ham
            ? \Carbon\Carbon::parse($this->tgl_persetujuan_kenmenhum_dan_ham)->format('Y-m-d'): null;
    }
    public function getTglPenetapanPengadilanFormattedAttribute()
    {
        return $this->tgl_penetapan_pengadilan
            ? \Carbon\Carbon::parse($this->tgl_penetapan_pengadilan)->format('Y-m-d'): null;
    }
    public function getTglIzinUsahaFormattedAttribute()
    {
        return $this->tgl_izin_usaha
            ? \Carbon\Carbon::parse($this->tgl_izin_usaha)->format('Y-m-d'): null;
    }
    public function getTglSkDirjenPajakFormattedAttribute()
    {
        return $this->tgl_sk_dirjen_pajak
            ? \Carbon\Carbon::parse($this->tgl_sk_dirjen_pajak)->format('Y-m-d'): null;
    }
    public function getTglSuratPengukuhanKenaPajakFormattedAttribute()
    {
        return $this->tgl_surat_pengukuhan_kena_pajak
            ? \Carbon\Carbon::parse($this->tgl_surat_pengukuhan_kena_pajak)->format('Y-m-d'): null;
    }




    
    
    public static function generateKodeMitra()
    {
        $prefix = 'NPA';
        $year = date('y'); // 2 digit tahun, contoh: 25
        $month = date('m'); // 2 digit bulan, contoh: 12
        
        // Cari record terakhir dengan prefix yang sama tahun-bulan
        $lastRecord = self::where('kode_mitra', 'like', $prefix . $year . $month . '%')
            ->orderBy('kode_mitra', 'desc')
            ->first();
        
        if ($lastRecord && $lastRecord->kode_mitra) {
            // Ambil 6 digit terakhir
            $lastSequence = substr($lastRecord->kode_mitra, -6);
            $nextSequence = str_pad((int)$lastSequence + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextSequence = '000001';
        }
        
        return $prefix . $year . $month . $nextSequence; // Contoh: NPA2512000001
    }
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->kode_mitra)) {
                $model->kode_mitra = self::generateKodeMitra();
            }
        });
    }


}
