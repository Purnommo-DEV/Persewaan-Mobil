<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjaman";
    protected $guarded = ['id'];

    public function peminjam_relasi(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function mobil_relasi(){
        return $this->belongsTo(Mobil::class, 'mobil_id', 'id');
    }
}
