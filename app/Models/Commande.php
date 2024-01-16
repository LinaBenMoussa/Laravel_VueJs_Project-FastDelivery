<?php

// TableReservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commande';
    protected $fillable = ['email', 'phone', 'address','food_id','qty','etat','panier'];
}
?>