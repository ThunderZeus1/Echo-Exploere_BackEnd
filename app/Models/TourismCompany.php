<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismCompany extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function packages()
    {
        return $this->hasMany(TourPackage::class);
    }
}
