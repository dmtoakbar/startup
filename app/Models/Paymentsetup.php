<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Paymentsetup extends Model
{
    use HasFactory;

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
    'copoun' => 'array',
    ];
    protected $fillable = ['coupon'];
}
