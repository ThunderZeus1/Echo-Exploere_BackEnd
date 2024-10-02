<?php

// Booking.php (Model)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'tour_name', 'date', 'status', 'amount'];
}
