<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $table = 'stories';
    protected $fillable = ['name'];

    /**
     * Get the board that owns the story.
     */
    public function board()
    {
        return $this->belongsTo(Boards::class, 'id');
    }

    /**
     * Get the user that owns the story.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
