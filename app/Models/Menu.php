<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'nama_menu',
        'jenis_menu',
        'url_menu',
        'target_menu',
        'urutan_menu',
        'parent_menu',
        'status_menu'
    ];

    // Relasi submenu
    public function submenu()
    {
        return $this->hasMany(Menu::class, 'parent_menu', 'id_menu')->whereNull('deleted_at');
    }

    // Relasi parent menu
    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_menu', 'id_menu');
    }

    // Accessor untuk submenu yang diformat
    public function getFormattedSubmenuAttribute()
    {
        return $this->submenu()->orderBy('urutan_menu', 'asc')->get();
    }
}
