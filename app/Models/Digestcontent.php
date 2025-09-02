<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Subtag;
use App\Models\Tag;

class Digestcontent extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function subtag()
    {
        return $this->belongsTo(Subtag::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
