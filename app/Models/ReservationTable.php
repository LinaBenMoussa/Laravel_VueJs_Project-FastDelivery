<?php

// TableReservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    protected $fillable = ['date', 'time', 'table_id','restaurant_id','email','numpersonnes','secretCode'];
}
?>