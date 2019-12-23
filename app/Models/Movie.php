<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MovieItem;
use App\Models\MovieDetail;
use App\Models\Genre;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Config;

class Movie extends Model
{
    protected $appends = ['total_pages', 'total_results'];
    
    public function getTotalPagesAttribute()
    {        
        return $this->attributes['total_pages'];
    }
    
    public function getTotalResultsAttribute()
    {        
        return $this->attributes['total_results'];
    }
    
    /**
     * function isValidDate
     * check if variable is a valid date
     *     
     * @param string $date, date to check
     * @param optional string $format, default = 'Y-m-d'
     *
     * @return boolean
     */
    private function isValidDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        
        return $d && $d->format($format) === $date;
    }
    
    public function getMovieList($req) {
        $start_date = null;
        $end_date = null;
        $page = 1;
        
        if ($req->has('page') && is_numeric($req->get('page')))
            $page = $req->get('page');            
        if ($req->has('start_date') && $this->isValidDate($req->get('start_date')))
            $start_date = $req->get('start_date');
        if ($req->has('end_date') && $this->isValidDate($req->get('end_date')))
            $end_date = $req->get('end_date');                        
        
        $release_date = '';
        if ($start_date)
            $release_date .= '&primary_release_date.gte=' . $start_date;
        if ($end_date)
            $release_date .= '&primary_release_date.lte=' . $end_date;
        
        $client = new Client();                    
        $res = $client->request('GET', Config::get('constants.api_host') . '/discover/movie?page=' . $page . $release_date . '&include_video=false&include_adult=false&sort_by=popularity.desc&language=en-US&api_key=' . Config::get('constants.api_key'));
        
        try {
            if ($res->getStatusCode() != 200) {
                throw new \Exception('Failed to fetch movie data');
            }            
            $data = json_decode($res->getBody());
            $this->total_pages = $data->total_pages;
            $this->total_results = $data->total_results;
            
            $result = [];            
            foreach ($data->results as $item) {
                $movieItem = new MovieItem;
                $movieItem->id = $item->id;
                $movieItem->poster = $item->poster_path;
                $movieItem->judul = $item->title;
                $movieItem->deskripsi = $item->overview;
                $movieItem->popularity = $item->popularity;
                $movieItem->genre = $this->readGenre($item->genre_ids);
                $movieItem->release_date = $item->release_date;
                $movieItem->vote_count = $item->vote_count;

                $result[] = $movieItem;                
            }
                        
            return $result;
        }
        catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }        
    }            

    public function getMovieDetail($id) {
        $client = new Client();        
        
        try {
            $res = $client->request('GET', Config::get('constants.api_host') . '/movie/' . $id . '?language=en-US&api_key=' . Config::get('constants.api_key'));    
        }
        catch (GuzzleException $e) {            
            return json_encode(['status' => 'error', 'message' => 'Target endpoint not found']);
        }  
                
        try {            
            if ($res->getStatusCode() != 200) {
                throw new \Exception('Failed to fetch movie detail');
            }       
            
            $data = json_decode($res->getBody());
            
            $movieDetail = new MovieDetail;            
            $movieDetail->backdrop = $data->backdrop_path;            
            $movieDetail->poster = $data->poster_path;            
            $movieDetail->judul = $data->title;
            $movieDetail->deskripsi = $data->overview;
            $movieDetail->popularity = $data->popularity;
            $movieDetail->genres = $this->readInformationFromDetail($data->genres);
            $movieDetail->release_date = $data->release_date;
            $movieDetail->homepage = $data->homepage;
            $movieDetail->production_companies = $this->readInformationFromDetail($data->production_companies);
            $movieDetail->runtime = $this->convertToHourMinute($data->runtime);
            $movieDetail->revenue = '$' . number_format($data->revenue, 2);
            $movieDetail->vote_average = $data->vote_average;
            $movieDetail->vote_count = $data->vote_count;
            $movieDetail->spoken_languages = $this->readInformationFromDetail($data->spoken_languages);
            
            return $movieDetail;
        }
        catch (\Exception $e) {            
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }        
    }
    
    private function convertToHourMinute($minutes) {
        return floor($minutes / 60) . ' Hour ' . ($minutes - floor($minutes / 60) * 60) . ' Minute';                
    }    
    
    private function readInformationFromDetail($details = []) {        
        $result = '';
        foreach($details as $detail) {
            $result .= $detail->name . ', ';
        }
        $result = substr($result, 0, strlen($result) - 2);
        
        return $result ? $result : '';
    }
    
    private function readGenre($genreId = []) {        
        $result = '';
        foreach($genreId as $id) {
            $result .= $this->translateGenre($id) . ', ';
        }
        $result = substr($result, 0, strlen($result) - 2);
        
        return $result ? $result : '';
    }

    private function translateGenre($id) {
        $genre = new Genre;
        $genres = $genre->getGenreList();
        
        $result = '';
        foreach ($genres as $items) {
            foreach ($items as $item) {
                if ($id == $item->id) {
                    $result = $item->name;
                    break 2;
                }
            }            
        }

        return $result;
    }

}
