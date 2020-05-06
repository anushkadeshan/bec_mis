@extends('layouts.reports')
@section('title','Analysis - Financial Assistance |')
@section('content')

  <br>
  <div class="container-fluid">
    <div class="loader" style="display: none"><img style="position: relative; top: 50%; left: 45%; transform: translateY(-50%); opacity: 1" src="{{ URL::asset('images/ajaxLoading.svg')}}"></div>
    
    <div class="row">
      @cannot('branch')
          <div class="col-md-4">
            <div class="form-group">
               <label>Branch</label>
                  <select name="branch" id="branch" class="form-control">
                    <option value="">All</option>
                    @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach
                  </select>
                  {{ csrf_field() }} 
            </div>
           
          </div>
          @endcan
          <div class="col-md-3">
            <div class="form-group">
               <label>Date From</label>
               <input type="date" class="form-control" id="dateStart" data-date-end-date="0d" placeholder="From">
            </div>
           
          </div>
          <div class="col-md-3">
            <div class="form-group">
               <label>Date To</label>
               <input type="date" class="form-control" id="dateEnd" data-date-end-date="0d" placeholder="From">   
            </div>
           
          </div>
          <div class="col-md-2">
            <div class="form-group">
               <label>&nbsp;</label> <br>
               <button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i class="fas fa-filter"></i> Filter</button>   
            </div>
           
          </div>
    </div>
    <hr>
    
    <div class="row">
      
      <div class="col-sm-4 col-md-2">
        <div class="color-palette-set">
          <div class="bg-success disabled color-palette"><span> &nbsp; No of Youths Assisted</div>
          <div class="bg-success color-palette">&nbsp; <span id="count-youths"></span></div>
        </div>
      </div>
       <div class="col-sm-4 col-md-2">
        <div class="color-palette-set">
          <div class="bg-warning disabled color-palette"><span> &nbsp; No of Assisted Courses</div>
          <div class="bg-warning color-palette">&nbsp; <span id="count-courses"></span></div>
        </div>
      </div><div class="col-sm-4 col-md-2">
        <div class="color-palette-set">
          <div class="bg-primary disabled color-palette"><span> &nbsp; No of Assisted Institutes</div>
          <div class="bg-primary color-palette">&nbsp; <span id="count-institutes"></span></div>
        </div>
      </div>

      </div> 
   
    <hr>
    <div class="row">
      <div class="col-sm-4 col-md-10">
       
       <span>Date From : </span> <span id="date1" class="text-primary"></span> <span> to : </span> <span id="date2" class="text-primary"></span> 
      </div>
      <div class="col-sm-4 col-md-2">
       <span style="float: right" class="text-right"><a href="{{ URL::to('reports-me/skill/financial') }}"><button type="button" class="btn btn-success btn-flat"><i class="fas fa-file-invoice"> View Full Report</i></button></a></span>
       
      </div>
    </div>
    <br>
      <div class="row">
          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Gender wise Finacially Supported
            </div>
            <div class="card-body">
              <div id="piechart" style=" height: 300px;"></div>
            </div>
        </div>
          </div>
          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Marital Status wise Finacially Supported
            </div>
            <div class="card-body">
              <div id="piechart2" style=" height: 300px;"></div>
            </div>
        </div>
          </div>

          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Race wise Finacially Supported
            </div>
            <div class="card-body">
              <div id="piechart3" style=" height: 300px;"></div>
            </div>
        </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Supported Courses <span style="float: right" class="badge badge-success text-right courses"></span>
             </div>
             <div class="card-body">
               <div id="table_div" style="max-height: 500px; "></div>
             </div>
           </div>
          </div>
          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
               Directed Institutes <span style="float: right" class="badge badge-success text-right institutes"></span>
             </div>
             <div class="card-body">
               <div id="table_div1" style="max-height: 500px;"></div>
             </div>
        </div>
          </div>

          <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Course Types
             </div>
             <div class="card-body">
               <div id="course_type" style="height: 400px"></div>
             </div>
           </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Family type of Finacially Supported <span class="badge badge-info text-right"> {{--count($employers)--}}</span>
             </div>
             <div class="card-body">
               <div id="piechart4" style=" height: 400px;"></div>
             </div>
           </div>
          </div>
          <div class="col-md-8">
           <div class="card card-primary">
             <div class="card-header">
               DS Division wise Finacially Supported
             </div>
             <div class="card-body">
               <div id="barchart_material" style=" max-height: 750px; min-height: 600px"></div>
             </div>
           </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
var _token = $('input[name="_token"]').val();
fetch_data();

 function fetch_data(branch='', dateStart='', dateEnd=''/* ,course='',institute=''*/)
 {
  $.ajax({
   url:"{{ url('/analysis-financial-fetch') }}",
   method:"POST",
   data:{_token:_token,branch:branch,dateStart:dateStart,dateEnd:dateEnd /*,course:course,institute:institute*/},
   dataType:"json",
   beforeSend: function(){
     $(".loader").css("display", "block");
   },
   complete: function(){
     $(".loader").css("display", "none");
    
   },
   success:function(data)
   {
       
    var male = parseInt(data.gender.male);
    var female = parseInt(data.gender.female);

    $('#count-youths').text(male+female);

    if(data.date1 === null){
      $('#date1').text("2018-06-01");
      $('#date2').text(new Date().toJSON().slice(0,10));

    }
    else{
      $('#date1').text(data.date1);
      $('#date2').text(data.date2);
      //console.log(data.date1);
    }
       
    
      //chart 1
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var dataa = google.visualization.arrayToDataTable([
          ['Gender', 'No of Youth'],
          ['Male',   male],
          ['Female',  female]
        ]);

        var options = {
          title: '',
          chartArea:{
          left:10,
          top: 5,
          bottom:25,
          right : 10,
          },
          legend: { position: 'bottom', alignment: 'center' },
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(dataa, options);
      }

       //marital
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart5);

      function drawChart5() {
        var m_array = data.marital;
        //alert(type_array.length);
        var  types5 = [['Marital Status', 'No of Youth']];
        for (var i = 0; i < m_array.length; i++) {
          types5.push([m_array[i].maritial_status,  m_array[i].total]);
        }
        var data5 = google.visualization.arrayToDataTable(types5);

        var options5 = {
          title: '',
          chartArea:{
          left:10,
          top: 5,
          bottom:25,
          right : 10,
          },
          legend: { position: 'bottom', alignment: 'center', maxLines:2 }
          
        };

        var chart5 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart5.draw(data5, options5);
      }
      


      //race
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart6);

      function drawChart6() {
        var r_array = data.race;
        //alert(type_array.length);
        var  types6 = [['Race', 'No of Youth']];
        for (var i = 0; i < r_array.length; i++) {
          types6.push([r_array[i].nationality,  r_array[i].total]);
        }
        var data6 = google.visualization.arrayToDataTable(types6);

        var options6 = {
          title: '',
          chartArea:{
          left:10,
          top: 5,
          bottom:25,
          right : 10,
          },
          legend: { position: 'bottom', alignment: 'center', maxLines:2 }
          
        };

        var chart6 = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart6.draw(data6, options6);
      }

      //table1

  google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data3 = new google.visualization.DataTable();

        var emp_array = data.courses;
        
        $('.courses').text(emp_array.length);
        $('#count-courses').text(emp_array.length);
        var dataRows2 = [['',  null, null]];
        for (var i = 0; i < emp_array.length; i++) {
         // alert(emp_array[i].total_male);
          dataRows2.push([emp_array[i].course_name,  emp_array[i].male,  emp_array[i].female]);
        }
        data3.addColumn('string', 'Course');
        data3.addColumn('number', 'Total Male');
        data3.addColumn('number', 'Total Female');
        data3.addRows(dataRows2);
    

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data3, {
          showRowNumber: false, 
          width: '100%', 
          height: '100%',
          page: 'enable',
          pageSize: 10,
          pagingSymbols: {
            prev: 'prev',
            next: 'next'
          },
        });
      }

     

     //table 

  google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable2);

      function drawTable2() {
        var data4 = new google.visualization.DataTable();

        var emp_array2 = data.institutes;
        
        $('.institutes').text(emp_array2.length);
        $('#count-institutes').text(emp_array2.length);
        var dataRows3 = [['',  null, null]];
        for (var i = 0; i < emp_array2.length; i++) {
         // alert(emp_array[i].total_male);
          dataRows3.push([emp_array2[i].institute_name,  emp_array2[i].male,  emp_array2[i].female]);
        }
        data4.addColumn('string', 'Institute');
        data4.addColumn('number', 'Total Male');
        data4.addColumn('number', 'Total Female');
        data4.addRows(dataRows3);
    

        var table2 = new google.visualization.Table(document.getElementById('table_div1'));

        table2.draw(data4, {
          showRowNumber: false, 
          width: '100%', 
          height: '100%',
          page: 'enable',
          pageSize: 8,
          pagingSymbols: {
            prev: 'prev',
            next: 'next'
          },
        });
      }

      //race
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart10);

      function drawChart10() {
        var c_array = data.course_types;
        //alert(type_array.length);
        var  types10 = [['Race', 'No of Youth']];
        for (var i = 0; i < c_array.length; i++) {
          types10.push([c_array[i].course_type,  c_array[i].total]);
        }
        var data10 = google.visualization.arrayToDataTable(types10);

        var options10 = {
          title: '',
          chartArea:{
          left:10,
          top: 5,
          bottom:25,
          right : 10,
          },
          legend: { position: 'bottom', alignment: 'center', maxLines:2 }
          
        };

        var chart10 = new google.visualization.PieChart(document.getElementById('course_type'));

        chart10.draw(data10, options10);
      }

      //family type
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {
        var type_array = data.family_types;
        //alert(type_array.length);
        var  types = [['Family Type', 'No of Youth']];
        for (var i = 0; i < type_array.length; i++) {
          types.push([type_array[i].family_type,  type_array[i].total]);
        }
        var data4 = google.visualization.arrayToDataTable(types);

        var options4 = {
          title: '',
          chartArea:{
          left:10,
          top: 5,
          bottom:25,
          right : 10,
          },
          legend: { position: 'bottom', alignment: 'center', maxLines:2 }
          
        };

        var chart4 = new google.visualization.PieChart(document.getElementById('piechart4'));

        chart4.draw(data4, options4);
      }


      //DSD Divistions
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {

      var array_s = data.locations;

      var dataRows = [['DS Division', 'No of Youths']];
      for (var i = 0; i < array_s.length; i++) {
        dataRows.push([array_s[i].DSD_Name, parseFloat(array_s[i].total)]);
      }
        var dataa1 = google.visualization.arrayToDataTable(dataRows);

        var options1 = {
          chart: {
            
          },
          animation:
           {
               "startup": true,
               duration: 10000,
               easing: 'out'
           },
          bars: 'horizontal', // Required for Material Bar Charts.

          legend: { position: 'none'},
        };

        var chart1 = new google.charts.Bar(document.getElementById('barchart_material'));

        chart1.draw(dataa1, google.charts.Bar.convertOptions(options1));
      }


   }
  });

 $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var branch = $('#branch').val();
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(branch,dateStart, dateEnd);
  }
  else
  {
    toastr.error('Error !', 'Both Date is required');
  }
 });

 }

      
</script>

<style>
  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: black;
    opacity: 0.4;
    
}
</style>
@endsection
