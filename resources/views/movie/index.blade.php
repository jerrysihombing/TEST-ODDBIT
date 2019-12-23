@extends('layouts.app')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">    
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
                  <i class="fas fa-database"></i>
                  Movie DB
                  </h3>                                                        
              </div>
              
              <div class="card-body">
                
                <div class="row">
                    
                    <div class="col-sm-3">                      
                        <label>Primary release date start:</label>	
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right datepicker" id="start_date">
                        </div>
                        <!-- /.input group -->                        
                    </div>
                        
                    <div class="col-sm-3">                      
                        <label>Primary release date end:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right datepicker" id="end_date">
                        </div>
                        <!-- /.input group -->                        
                    </div>
                    
                    <div class="col-sm-3">
                        <label>&nbsp;</label>
                        <div class="input-group">                            
                            <button type="button" id="btn_search" class="btn btn-outline-warning">Search</button>
                            <button type="button" id="btn_reset" class="btn btn-outline-secondary" style="margin-left: 6px"> Reset </button>
                        </div>
                    </div>
                                                
                    <div class="col-sm-3"">
                        <label>Page:</label>
                        <div class="input-group">
                            <ul class="pagination pagination-sm float-right">
                              <li id="li_prev" class="page-item disabled"><a class="page-link" href="#" id="link_prev">&laquo; Prev</a></li>
                              <li class="page-item"><a class="page-link" href="#"><input id="txt_page" type="text" pattern="[0-9]+" value="1" style="width: 40px; height: 20px; padding-left: 4px"></a></li>                              
                              <li id="li_next" class="page-item"><a class="page-link" href="#" id="link_next">Next &raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                                          
                </div>
                <!-- /.row -->                                     
                  
                <table id="list" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Popularity</th>
                    <th>Genre</th>
                    <th>Release Date</th>
                    <th>Vote Count</th>
                  </tr>
                  </thead>
                  <tbody>
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
    
    <input type="hidden" id="total_pages">
    
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- numeric -->
    <script src="{{ asset('bower_components/jquery-numeric/jquery.numeric.js') }}"></script>    
    <!-- movie -->
    <script src="{{ asset('js/movie.js') }}"></script>
@endsection

@section('init')
    <!-- page script -->
    <script type="text/javascript">

      var table;

      $(document).ready(function() {

        applyDatatable();    
        applyDatePicker();
        applySearchButton();
        applyResetButton();
        applyPaging();
          
      });
    
    </script>
@endsection