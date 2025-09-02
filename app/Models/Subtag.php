<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Tag;
use App\Models\Digestcontent;

class Subtag extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name', 
    ];


    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function content()
    {
        return $this->hasMany(Digestcontent::class);
    }
}
