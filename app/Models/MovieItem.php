<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieItem extends Model
{
    protected $appends = ['id', 'poster', 'judul', 'deskripsi', 'popularity', 'genre', 'release_date', 'vote_count'];

    public function getIdAttribute()
    {        
        return $this->attributes['id'];
    }
    
    public function getPosterAttribute()
    {        
        return $this->attributes['poster'];
    }

    public function getJudulAttribute()
    {
        return $this->attributes['judul'];
    }

    public function getDeskripsiAttribute()
    {
        return $this->attributes['deskripsi'];
    }

    public function getPopularityAttribute()
    {
        return $this->attributes['popularity'];
    }

    public function getGenreAttribute()
    {
        return $this->attributes['genre'];
    }
    
    public function getReleaseDateAttribute()
    {
        return $this->attributes['release_date'];
    }
    
    public function getVoteCountAttribute()
    {
        return $this->attributes['vote_count'];
    }
}
