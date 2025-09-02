<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Subtag;
use App\Models\Digestcontent;

class Tag extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name', 
    ];

    public function subTag()
    {
        return $this->hasMany(Subtag::class);
    }

    public function content()
    {
        return $this->hasMany(Digestcontent::class);
    }
}
