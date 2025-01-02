<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'page'; // Sesuaikan dengan nama tabel pada migration (plural)

    // Primary key
    protected $primaryKey = 'id_page';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = ['judul_page', 'isi_page', 'status_page'];

    // Nonaktifkan timestamp otomatis jika tidak digunakan
    public $timestamps = true; // Jika Anda menggunakan kolom created_at dan updated_at
}
