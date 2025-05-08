<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['userID', 'agentID', 'totalcom', 'clientname', 'status', 'cardID'];

    protected $primaryKey = 'comID'; 

    public $incrementing = true; 
    protected $keyType = 'int'; 
    public function card()
    {
        return $this->belongsTo(Card::class, 'cardID', 'cardID');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agentID', 'agentID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}