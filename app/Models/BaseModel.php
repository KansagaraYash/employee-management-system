<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($record) {
            $record->created_by = auth()->user() ? auth()->user()->id : null;
        });

        // create a event to happen on updating
        static::updating(function ($record) {
            $record->updated_by = auth()->user() ? auth()->user()->id : null;
        });
    }
}
