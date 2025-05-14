<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards'; 
    protected $primaryKey = 'cardID'; 
    public $incrementing = false; 
    protected $keyType = 'int'; 

    protected $fillable = ['cardID', 'banktype', 'cardtype'];

    public $timestamps = false; 
}