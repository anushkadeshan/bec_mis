@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Goal Completion Report</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-warning card-outline">
                    <div class="card-header">
                      <h3 class="card-title">Filters</h3>
                    </div>
                    <div class="card-body">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #5E6971; color: white;">
                        
                      @cannot('branch')
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Branch &nbsp;&nbsp;</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">All</option>
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}">{{$branch->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li>
                      @endcan                 
                      </ul>
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <input type="checkbox" name="cg" class="form-control cg" id="cg" data-id="">
                                <label for="cg" > &nbsp; Career Guidance</label>
                            </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <input type="checkbox" name="soft_skills" class="form-control cg" id="soft_skills" data-id="">
                              <label for="soft_skills"> &nbsp; Soft Skills</label>
                            </div>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <input type="checkbox" name="vt" class="form-control cg" id="vt" data-id="">
                                <label for="vt"> &nbsp; Vocational Training</label>
                            </div> 
                        </a>
                      </li>  
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <input type="checkbox" name="prof" class="form-control cg" id="prof" data-id="">
                                <label for="prof"> &nbsp; Professional Training</label>  
                            </div> 
                        </a>
                      </li>  
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <input type="checkbox" name="jobs" class="form-control cg" id="jobs" data-id="">
                                <label for="jobs"> &nbsp; On the Job</label>  
                            </div> 
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <input type="checkbox" name="bss" class="form-control cg" id="bss" data-id="">
                                <label for="bss"> &nbsp; BSS </label>  
                            </div> 
                        </a>
                      </li> 
               
                      </ul>
                      
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Youth Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table row-border table-hover table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>DSD</th>
                        <th>GN</th>
                        <th>Branch</th>
                        <th>Branch ID</th>
                        <th>CG</th>
                        <th>Soft</th>
                        <th>VT</th>
                        <th>Prof</th>
                        <th>JOb</th>
                        <th>BSS</th>
                    </tr>
                </thead> 
                <tbody>
                  <?php $count=1?>
                  @foreach($youths->chunk(100) as $chunk)
                    @foreach($chunk as $youth)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$youth->youth_name}}</td>
                        <td>{{$youth->gender}}</td>
                        <td>{{$youth->phone}}</td>
                        <td>{{$youth->email}}</td>
                        <td>{{$youth->DSD_Name}}</td>
                        <td>{{$youth->GN_Office}}</td>
                        <td>{{$youth->name}}</th>
                        <td>{{$youth->branch_id}}</th>
                        <td>{{$youth->cg}}</th>
                        <td>{{$youth->soft_skills}}</th>
                        <td>{{$youth->vt}}</th>
                        <td>{{$youth->prof}}</th>
                        <td>{{$youth->jobs}}</th>
                        <td>{{$youth->bss}}</th>
                    </tr>
                    @endforeach
                  @endforeach
                </tbody>
            </table>      
                </div>
            </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

  
  $(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });

  
});

$(document).ready(function() {

var dataTable = $("#example").DataTable({
  "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
            },

             {
                "targets": [ 8 ],
                "visible": false,
            },

            {
                "targets": [ 9 ],
                "visible": false
            },

            {
                "targets": [ 10 ],
                "visible": false
            },

            {
                "targets": [ 11 ],
                "visible": false,
            },

            {
                "targets": [ 12 ],
                "visible": false
            },

            {
                "targets": [ 13 ],
                "visible": false
            },

            {
                "targets": [ 14 ],
                "visible": false
            }
        ],
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    });
  
$(window).on('load', function() {
  dataTable.columns(9).search( 0 ).draw();
  dataTable.columns(10).search( 0 ).draw();
  dataTable.columns(11).search( 0 ).draw();
  dataTable.columns(12).search( 0 ).draw();
  dataTable.columns(13).search( 0 ).draw();
  dataTable.columns(14).search( 0 ).draw();
  var info = $('#example').DataTable().page.info();
  $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
 
});
  $('#branch_id').on('change', function () {
 // alert(this.value);
          dataTable.columns(8).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

  $('#cg').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(9).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );

  $('#soft_skills').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(10).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );

  $('#vt').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(11).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );

  $('#prof').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(12).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );

  $('#jobs').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(13).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );

  $('#bss').on('ifClicked', function () {
    if(this.checked) {
        value = 0;
    }
    else{
      value = 1;
    }
    dataTable.columns(14).search(value).draw();
    var info = $('#example').DataTable().page.info();
    $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
  } );
 
});


</script>

<style type="text/css" media="screen">
  #autocomplete, #autocomplete1, #autocomplete2 {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    margin-top: 2px;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
#autocomplete, #autocomplete1, #autocomplete2 > li {
  padding: 3px 20px;
}
#autocomplete, #autocomplete1, #autocomplete2 > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}

 th { font-size: 15px; }
  td { font-size: 14px; }
</style>
@endsection
