<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Questionpaperfront extends Model
{
    use HasFactory;

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['payment_id'];
}
