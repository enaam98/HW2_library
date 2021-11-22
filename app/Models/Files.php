<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'type',
        'parent_id',
        'file_path',
        'extention',
        'file_size'
    ];
    protected $casts=['file_path'=>'json'];
}
