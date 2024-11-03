<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galleries extends Model
{
    use HasFactory;
    protected $fillable = [
        "file_name",
        "file_path",
        "file_type",
        "file_size",
        "uid",
        "expired_date"
    ];
    protected $primaryKey = "id";
    protected $table = "galleries";
    public $timestamps = false;
}
