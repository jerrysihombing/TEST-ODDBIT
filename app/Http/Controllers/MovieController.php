<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use DataTables;
use Config;

class MovieController extends Controller
{
    private $movie = null;
    
    public function __construct() {
        $this->movie = new Movie;
    }
    
    public function index() {
        return view('movie.index');
    }    

    public function datatables(Request $req) {        
        $list = $this->movie->getMovieList($req);        
        $total_pages = $this->movie->total_pages;
        $total_results = $this->movie->total_results;
        
        // set to session
        session(['total_pages' => $total_pages, 'total_results' => $total_results]);
        
        $json = Datatables::of($list)
                    ->editColumn('judul', function($list) {
                        return '<a href="/movie/detail/' . $list->id . '">' . $list->judul . "</a>";
                    })
                    ->editColumn('poster', function($list) use ($total_pages) {
                        return '<img alt="Poster" width="100" height="100" src="' . Config::get('constants.img_path') . $list->poster . '">';
                    })->escapeColumns([])
                    ->toJson();
        
        return $json;
    }

    public function detail($id) {        
        $data['movieDetail'] = $this->movie->getMovieDetail($id);        

        return view('movie.detail', $data);
    }
    
    public function getPageInfo() {
        $total_pages = session('total_pages');
        $total_results = session('total_results');
        
        return json_encode(['total_pages' => $total_pages, 'total_results' => $total_results]);
    }
    
}
