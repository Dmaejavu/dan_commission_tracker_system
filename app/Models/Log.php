<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'logID';
    
    protected $fillable = [
        'userID',
        'action',
        'model',
        'model_id',
        'description',
        'old_values',
        'new_values',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}