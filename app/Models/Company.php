<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends BaseModel
{
    use HasFactory, SoftDeletes;

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
