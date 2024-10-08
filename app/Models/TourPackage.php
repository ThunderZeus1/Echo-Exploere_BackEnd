<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'duration', 'tourism_company_id'];

    // Define the relationship to the tourism company
    public function company()
    {
        return $this->belongsTo(TourismCompany::class);
    }
}
