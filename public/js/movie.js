var updatePage = function(direction) {
    var page = $("#txt_page").val();
    if (isNaN(page)) page = 1;
    
    if (direction == "next") 
        page++;        
    else if (direction == "prev") 
        page--;    
    if (page == 0) page = 1;
    
    $("#txt_page").val(page);
    if (page > 1) {
        $("#li_prev").removeClass('disabled');
    }
    else if (page == 1) {
        if (!$("#li_prev").hasClass('disabled')) {
            $("#li_prev").addClass('disabled');
        }
    }
    
    //$("#btn_search").trigger("click");
    table.draw(); 
};

var applyPaging = function() {
    
    $("#link_next").on("click", function(e) {
        e.preventDefault();
        updatePage("next");
        
        return false;         
    });
    
    $("#link_prev").on("click", function(e) {
        e.preventDefault();
        updatePage("prev");
        
        return false;         
    });
    
    $("#txt_page").numeric();
    
    $("#txt_page").on("keyup", function (e) {
        var total_pages = $("#total_pages").val();
        if (isNaN(total_pages)) total_pages = 1;
        var page = $(this).val();
        if (isNaN(page)) page = 1;
        
        // set to total pages
        if (page > total_pages) {
            $(this).val(total_pages);
        }        
    }); 
};

var applySearchButton = function() {
    
    $("#btn_search").on("click", function() {
        resetPaging();
        table.draw();        
    });
    
};

var applyResetButton = function() {
    
    $("#btn_reset").on("click", function() {
        $(".datepicker").val('');
        resetPaging();
        table.draw();
    });
    
};

var resetPaging = function () {
    $("#txt_page").val('1');
    if (!$("#li_prev").hasClass('disabled')) {
        $("#li_prev").addClass('disabled');
    }    
}

var applyDatePicker = function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
};

var applyDatatable = function() {
    table = $('#list').DataTable({
        'processing': true,
        'serverSide': true,
        "paging": false,
        "lengthChange": false,
        "pageLength": 20,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        'ajax': {
            "url": "/movie/list",
            "data": function (d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.page = $('#txt_page').val();                
            }
        },
        'columns': [
            {data: 'poster', name: 'poster'},
            {data: 'judul', name: 'judul'},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'popularity', name: 'popularity', class: 'text-right'},
            {data: 'genre', name: 'genre'},
            {data: 'release_date', name: 'release_date'},
            {data: 'vote_count', name: 'vote_count', class: 'text-right'}
        ],        
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-2x"></i><span class="sr-only">Loading...</span>' // custom loading
        },
        "columnDefs": [
            { "orderable": false, "targets": 0 } // set particular column not sortable
        ],
        "order": [] // disable initial sorting
    })
    .on('processing.dt', function(e, settings, processing) {
        $('#processingIndicator').css('display', processing ? 'block' : 'none');        
    })
    .on('draw', function () {
        // get total pages from session
        $.getJSON("/movie/page-info", function(data) {
            $("#total_pages").val(data.total_pages);
            
            var page = $("#txt_page").val();            
            if (isNaN(page)) page = 1;
            
            if (data.total_pages <= page) {
                // disable next button
                if (!$("#li_next").hasClass('disabled')) {
                    $("#li_next").addClass('disabled');
                }
            }
            else {
                // enable next button
                $("#li_next").removeClass('disabled');
            }
        });
    });
}