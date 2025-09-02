<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Jobtag;

class Jobcontent extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'important_links' => 'array',
        ];
    protected $fillable = ['important_links'];

    public function jobtag()
    {
        return $this->belongsTo(Jobtag::class);
    }
}
