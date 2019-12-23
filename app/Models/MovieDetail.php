<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieDetail extends Model
{
    protected $appends = [
        'backdrop', 'poster', 'judul', 'deskripsi', 'popularity', 'genres', 'release_date',
        'homepage', 'production_companies', 'runtime', 'revenue', 'vote_average', 'vote_count', 'spoken_languages'
    ];

    public function getHomepageAttribute()
    {        
        return $this->attributes['homepage'];
    }

    public function getProductionCompaniesAttribute()
    {        
        return $this->attributes['production_companies'];
    }

    public function getRuntimeAttribute()
    {        
        return $this->attributes['runtime'];
    }

    public function getRevenueAttribute()
    {        
        return $this->attributes['revenue'];
    }

    public function getVoteAverageAttribute()
    {        
        return $this->attributes['vote_average'];
    }

    public function getVoteCountAttribute()
    {        
        return $this->attributes['vote_count'];
    }

    public function getSpokenLanguagesAttribute()
    {        
        return $this->attributes['spoken_languages'];
    }

    public function getBackdropAttribute()
    {        
        return $this->attributes['backdrop'];
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

    public function getGenresAttribute()
    {
        return $this->attributes['genres'];
    }
    
    public function getReleaseDateAttribute()
    {
        return $this->attributes['release_date'];
    }
}
