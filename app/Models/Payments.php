<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'licence_id',
        'title',
        'obs'
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function fee(){
        return $this->hasOne('App\Models\FeeAnLicence', 'id', 'licence_id');
    }
  
}
