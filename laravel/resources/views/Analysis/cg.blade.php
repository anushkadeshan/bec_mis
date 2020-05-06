@extends('layouts.reports')
@section('title','Analysis - Career Guidance |')
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
       <a href="{{url('/reports-me/cg/cg')}}" >
        <div class="color-palette-set">
          <div class="bg-success disabled color-palette"><span> &nbsp; Career Guidance <span id="count-cg" style="float: right"> &nbsp;</span></span></div>
          <div class="bg-success color-palette">&nbsp; Male : <span id="cg-m"></span> , Female : <span id="cg-f"></span></div>
        </div>
        </a>
      </div>
       <div class="col-sm-4 col-md-2">
        <a href="{{url('/reports-me/cg/stake-holder-meeting')}}" >
        <div class="color-palette-set">
          <div class="bg-warning disabled color-palette"><span> &nbsp; Stake Holder Meetings<span id="count-st" style="float: right"></span></div>
          <div class="bg-warning color-palette">&nbsp; Male : <span id="st-m"></span> , Female : <span id="st-f"></span></div>
        </div>
        </a>
      </div>

       <div class="col-sm-4 col-md-2">
       <a href="{{Route('reports-me/cg/kick-off-meeting')}}">
        <div class="color-palette-set">
          <div class="bg-danger disabled color-palette"><span> &nbsp; Kikk Offs <span id="count-kk" style="float: right"> &nbsp;</span></span></div>
          <div class="bg-danger color-palette">&nbsp; Male : <span id="kk-m"></span> , Female : <span id="kk-f"></span></div>
        </div>
       </a>
      </div>
       <div class="col-sm-4 col-md-2">
       <a href="{{Route('reports-me/cg/kick-off-meeting')}}">
        <div class="color-palette-set">
          <div class="bg-info disabled color-palette"><span> &nbsp; HHS<span id="count-hh" style="float: right"> &nbsp;</span></span></div>
          <div class="bg-info color-palette">&nbsp; Male : <span id="hh-m"></span> , Female : <span id="hh-f"></span></div>
        </div>
      </a>
      </div>
      <div class="col-sm-4 col-md-2">
       <a href="{{url('/reports-me/cg/tot')}}">
        <div class="color-palette-set">
          <div class="bg-gray disabled color-palette"><span> &nbsp; TOT on CG<span id="count-tot" style="float: right"> &nbsp;</span></span></div>
          <div class="bg-gray color-palette">&nbsp; Male : <span id="tot-m"></span> , Female : <span id="tot-f"></span></div>
        </div>
      </a>
      </div>
       </div> 
       <br> 
       <div class="row">
        
      <div class="col-sm-4 col-md-3">
       <a href="{{url('/reports-me/cg/cg-training')}}">
        <div class="color-palette-set">
          <div class="bg-info disabled color-palette"><span> &nbsp; Training on GND level Officers<span id="count-gnd" style="float: right"> &nbsp;</span></span></div>
          <div class="bg-info color-palette">&nbsp; Male : <span id="gnd-m"></span> , Female : <span id="gnd-f"></span></div>
        </div>
      </a>
      </div>

      </div> 
   
    <hr>
    <div class="row">
      <div class="col-sm-4 col-md-10">
       
       <span>Date From : </span> <span id="date1" class="text-primary"></span> <span> to : </span> <span id="date2" class="text-primary"></span> 
      </div>
      <div class="col-sm-4 col-md-2">
       <span style="float: right" class="text-right"><a href="{{ URL::to('reports-me/cg/cg') }}"><button type="button" class="btn btn-success btn-flat"><i class="fas fa-file-invoice"> View Full Report</i></button></a></span>
       
      </div>
    </div>
    <br>
      <div class="row">
          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Gender wise Career Guidacne Participants 
            </div>
            <div class="card-body">
              <div id="piechart" style=" height: 300px;"></div>
            </div>
        </div>
          </div>
          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Marital Status wise Career Guidacne Participants
            </div>
            <div class="card-body">
              <div id="piechart2" style=" height: 300px;"></div>
            </div>
        </div>
          </div>

          <div class="col-md-4">
              <div class="card card-primary">
            <div class="card-header">
              Race wise Career Guidacne Participants
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
               Identified Requirements of CG participants
             </div>
             <div class="card-body">
               <div id="table_div"></div>
             </div>
           </div>
          </div>
          <div class="col-md-8">
              <div class="card card-primary">
            <div class="card-header">
              Career Feild Selected by youth
            </div>
            <div class="card-body">
              <div id="columnchart_material" style=" height: 373px;"></div>
            </div>
        </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Family type of CG Participants <span class="badge badge-info text-right"> {{--count($employers)--}}</span>
             </div>
             <div class="card-body">
               <div id="piechart4" style=" height: 500px;"></div>
             </div>
           </div>
          </div>
          <div class="col-md-8">
           <div class="card card-primary">
             <div class="card-header">
               DS Division wise Career Guidance Participants
             </div>
             <div class="card-body">
               <div id="barchart_material" style=" height: 750px;"></div>
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
   url:"{{ url('/analysis-cg-fetch') }}",
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
       
    $('#cg-m').text(data.cg_male);
    $('#cg-f').text(data.cg_female);
    $('#count-cg').text(data.cg_count+'\xa0\xa0');

    $('#st-m').text(data.stake.total_male);
    $('#st-f').text(data.stake.total_female);
    $('#count-st').text(data.stake.count+'\xa0\xa0');

    $('#kk-m').text(data.kickoffs.total_male);
    $('#kk-f').text(data.kickoffs.total_female);
    $('#count-kk').text(data.kickoffs.count+'\xa0\xa0');

    $('#hh-m').text(data.households.total_male);
    $('#hh-f').text(data.households.total_female);
    $('#count-hh').text(data.households.count+'\xa0\xa0');

    $('#tot-m').text(data.tot_cg.total_male);
    $('#tot-f').text(data.tot_cg.total_female);
    $('#count-tot').text(data.count_tot+'\xa0\xa0');

    $('#gnd-m').text(data.cg_trainings.total_male);
    $('#gnd-f').text(data.cg_trainings.total_female);
    $('#count-gnd').text(data.cg_trainings.count+'\xa0\xa0');


    if(data.date1 === null){
      $('#date1').text("2018-06-01");
      $('#date2').text(new Date().toJSON().slice(0,10));

    }
    else{
      $('#date1').text(data.date1);
      $('#date2').text(data.date2);
      //console.log(data.date1);
    }
    
    var cg_male = parseInt(data.cg_male);
    var cg_female = parseInt(data.cg_female);
    
    console.log(data.career_field);
    //alert(cg_male);
    //alert(cg_female);
      //chart 1
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var dataa = google.visualization.arrayToDataTable([
          ['Gender', 'No of Youth'],
          ['Male',   cg_male],
          ['Female',  cg_female]
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

      

  //table

  google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data3 = new google.visualization.DataTable();

        var emp_array = data.requirement;
        
        var dataRows2 = [['',  null, null]];
        for (var i = 0; i < emp_array.length; i++) {
         // alert(emp_array[i].total_male);
          dataRows2.push([emp_array[i].requirement,  emp_array[i].total_male,  emp_array[i].total_female]);
        }
        data3.addColumn('string', 'Requirements');
        data3.addColumn('string', 'Total Male');
        data3.addColumn('string', 'Total Female');
        data3.addRows(dataRows2);
    

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data3, {
          showRowNumber: false, 
          width: '100%', 
          height: '100%',
        });
      }

      //chart 2
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

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var array_r = data.career_field;

        var dataRows1 = [['Career Field', 'Youths']];
        for (var i = 0; i < array_r.length; i++) {
          dataRows1.push([array_r[i].career_field1, parseFloat(array_r[i].total)]);
        }
        var data2 = google.visualization.arrayToDataTable(dataRows1);

        var options2 = {
          chart: {
           
          },
          bars: 'horizontal',
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart2.draw(data2, google.charts.Bar.convertOptions(options2));
      }


      //family type
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {
        var type_array = data.family_type;
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

      //marital
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
