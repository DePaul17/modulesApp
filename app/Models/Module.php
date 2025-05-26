<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'date_add',
        'starting'
    ];

    // Relation avec le modèle Detail
    public function detail()
    {
        return $this->hasOne(Detail::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
