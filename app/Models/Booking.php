<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'company_id', 'package_id', 'customer_name', 'tour_name', 'date', 'status', 'amount'
    ];
}
