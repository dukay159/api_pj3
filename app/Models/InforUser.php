<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforUser extends Model
{
    protected $table = 'info_users';
    protected $fillable = ['id','hoten','gioitinh','ngaysinh','sdt','diachi'];
    use HasFactory;
}
