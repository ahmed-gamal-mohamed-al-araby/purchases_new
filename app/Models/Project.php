<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded;
    public function item()
    {
        return $this->belongsTo("App\Models\Item","item_id");
    }
    public function businessNature()
    {
        return $this->belongsTo("App\Models\BusinessNature","business_nature_id");
    }
}
