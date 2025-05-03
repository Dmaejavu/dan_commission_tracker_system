<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $primaryKey = 'agentID'; // Define the custom primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['agentname', 'comrate', 'area'];

    /**
     * Define the relationship to the Commission model.
     */
    public function commissions()
    {
        return $this->hasMany(Commission::class, 'agentID', 'agentID');
    }
}