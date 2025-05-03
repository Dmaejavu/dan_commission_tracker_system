<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards'; // Specify the table name
    protected $primaryKey = 'cardID'; // Specify the primary key
    public $incrementing = false; // Since cardID is not auto-incrementing
    protected $keyType = 'int'; // Specify the type of the primary key

    protected $fillable = ['cardID', 'banktype', 'cardtype'];
}