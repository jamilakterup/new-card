<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    // protected $fillable = ['image'];
    protected $fillable = [
        'card_title',
        'front_image',
        'back_image',
        'front_pdf',
        'back_pdf'
    ];
}
