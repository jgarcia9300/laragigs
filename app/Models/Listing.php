<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'company',
    //     'location',
    //     'website',
    //     'email',
    //     'tags',
    //     'description'
    // ];

    //scopeFilter es un metodo que se encarga de filtrar los listados por tag y search. para llamar la funcion no es necesario poner scope, solo  se llama como un metodo normal Listing::filter()
    public function scopeFilter($query , array $filters) {
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%' );
        }

        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%' )
                ->orWhere('description', 'like', '%' . request('search') . '%' )
                ->orWhere('tags', 'like', '%' . request('search') . '%' )
                ->orWhere('location', 'like', '%' . request('search') . '%' );
        }
    }

    //Relationship to user

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); //un listado pertenece a un usuario.
    }
}
