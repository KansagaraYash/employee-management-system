<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'website',
        'logo',
        'address',
        'is_active',
    ];

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user', 'company_id', 'user_id');
    }
}
