<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrlShort extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'code', 'link', 'expired_at',
    ];

    protected $guarded = ['id'];

}
