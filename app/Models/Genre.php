<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Cache;
use Config;

class Genre extends Model
{
    public function getGenreList() {
        $genres = Cache::remember('genres', Config::get('constants.cache_minutes'), function () {            
            return $this->loadGenre();
        });

        return $genres;
    }

    private function loadGenre() {
        $client = new Client();         
        $res = $client->request('GET', Config::get('constants.api_host') . '/genre/movie/list?language=en-US&api_key=' . Config::get('constants.api_key'));
        
        try {
            if ($res->getStatusCode() != 200) {
                throw new \Exception('Failed to fetch genre data');
            }            
            $data = json_decode($res->getBody());
            
            return $data;
        }
        catch (\Exception $e) {            
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }         
    }

}
