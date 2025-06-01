<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaService extends Model
{
    use HasFactory;

    protected $fillable = [
        'spa_id',
        'name',
        'description',
        'duration',
        'price',
        'is_active'
    ];

    public function spa()
    {
        return $this->belongsTo(Spa::class, 'spa_id', 'id_spa');
    }
}