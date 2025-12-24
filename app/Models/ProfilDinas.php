<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDinas extends Model
{
    protected $table = 'profil_dinas';

    protected $fillable = [
        'nama_dinas',
        'sub_title',
        'alamat_kantor',
        'nomor_telepon',
        'email',
        'social_media_links',
        'logo_tanpa_text',
        'logo_dengan_text',
        'kepala_dinas_nama',
        'kepala_dinas_foto',
        'kepala_dinas_sambutan',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];
}
