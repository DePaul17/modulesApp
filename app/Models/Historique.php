<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id', 
        'detail_id'
    ];

    // Relation avec le modèle Module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Relation avec le modèle Detail
    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }
}
