<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    use HasFactory;
    protected $table = 'boards';
    protected $fillable = ['name','description'];


    /**
     * Get the user that owns the board.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}