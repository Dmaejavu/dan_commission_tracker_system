<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['agentname', 'comrate', 'area'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'agentID'; // Define the custom primary key

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Define the relationship to the Commission model.
     */
    public function commissions()
    {
        return $this->hasMany(Commission::class, 'agentID', 'agentID');
    }
}