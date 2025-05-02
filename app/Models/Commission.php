<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['userID', 'agentID', 'totalcom', 'clientname', 'status'];

    protected $primaryKey = 'comID'; // Define the custom primary key

    public $incrementing = true; // Ensure the primary key is auto-incrementing
    protected $keyType = 'int'; // Define the primary key type

    /**
     * Define the relationship to the Agent model.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agentID', 'agentID');
    }

    /**
     * Define the relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}