@extends('layouts.app')

@section('css')
    
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- nothing here -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
                    
      <div class="container">
      
        <div class="row">
          
          <div class="col-md-12">
            
            <div class="card card-info">

              <div class="card-header">
                  <h3 class="card-title">
                  <i class="fas fa-tag"></i>
                  Detail Movie
                  </h3>
              </div>
              
              <div class="card-body">
                
                <div class="col-md-12 text-right" style="margin-bottom: 6px;">                    
                    <a href="javascript:history.back()" class="btn btn-outline-warning"><i class="fas fa-chevron-left"></i> Back</a>
                </div>
                    
                <table class="table">
                  <tbody>
                    
                    <tr>
                      <td style="width: 20%">
                        <img alt="Backdrop" width="200" height="200" src="{{ Config::get('constants.img_path') . $movieDetail->backdrop }}">
                      </td>                      
                      <td>
                        <img alt="Poster" width="200" height="200" src="{{ Config::get('constants.img_path') . $movieDetail->poster }}">
                      </td>
                    </tr>    
                    <tr>
                      <td>Judul:</td>                      
                      <td>{{ $movieDetail->judul }}</td>                      
                    </tr>
                    <tr>
                      <td>Deskripsi:</td>
                      <td>{{ $movieDetail->deskripsi }}</td>                      
                    </tr>
                    <tr>
                      <td>Popularity:</td>
                      <td>{{ $movieDetail->popularity }}</td>                      
                    </tr>
                    <tr>
                      <td>Genre:</td>
                      <td>{{ $movieDetail->genres }}</td>                     
                    </tr>
                    <tr>
                      <td>Release Date:</td>
                      <td>{{ $movieDetail->release_date }}</td>                     
                    </tr>
                    <tr>
                      <td>Homepage:</td>
                      <td>
                        @if ($movieDetail->homepage)
                            <a href="{{ $movieDetail->homepage }}" target="_blank">Visit Homepage</a>
                        @else
                            -   
                        @endif
                      </td>                      
                    </tr>
                    <tr>
                      <td>Production Companies:</td>
                      <td>{{ $movieDetail->production_companies }}</td>                      
                    </tr>
                    <tr>
                      <td>Runtime:</td>
                      <td>{{ $movieDetail->runtime }}</td>                      
                    </tr>
                    <tr>
                      <td>Revenue:</td>
                      <td>{{ $movieDetail->revenue }}</td>                      
                    </tr>
                    <tr>
                      <td>Vote Average:</td>
                      <td>{{ $movieDetail->vote_average }}</td>                      
                    </tr>
                    <tr>
                      <td>Vote Count:</td>
                      <td>{{ $movieDetail->vote_count }}</td>                      
                    </tr>
                    <tr>
                      <td>Spoken Languages:</td>
                      <td>{{ $movieDetail->spoken_languages }}</td>                      
                    </tr>
                    
                  </tbody>
                </table>
              
              </div>
              <!-- /."card-body --> 

            </div>
            <!-- /."card -->  
            
          </div>
          <!-- /.col-md-12 -->
          
        </div>
        <!-- /.row -->

      </div><!-- /.container -->
    
    </div>
    <!-- /.content -->

@endsection

@section('js')
    
@endsection

@section('init')
    
@endsection