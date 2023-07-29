<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        // filtro para verificar se user esta autenticado para trazer apenas o like do user
        // fazer o relacionamento
        return $this->hasMany(Like::class)
                        ->where(function ($query) {
                            if (auth()->check()) {
                                $query->where('user_id', auth()->user()->id);
                            }
                        });
    }

}
