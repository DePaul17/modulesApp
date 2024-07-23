<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id', 
        'module_state', 
        'duration_operation', 
        'number_data_sent', 
        'temperature', 
        'speed'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
