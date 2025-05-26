<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'action',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        // Relation avec le modèle User
        return $this->belongsTo(User::class);
    }
}
