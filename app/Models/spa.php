<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spa extends Model
{
    use HasFactory;

    protected $table = 'spas';
    protected $primaryKey = 'id_spa';
    protected $fillable = [
        'nama',
        'harga',
        'alamat',
        'noHP',
        'waktuBuka',
        'maps',
        'image'
    ];

    protected $casts = [
        'waktuBuka' => 'array',
    ];

    public function services()
    {
        return $this->hasMany(SpaService::class, 'spa_id', 'id_spa');
    }
}