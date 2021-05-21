<?php $__env->startSection('title','Analysis - Job Placement |'); ?>
<?php $__env->startSection('content'); ?>

	<br>
	<div class="container-fluid">
    <div class="loader" style="display: none"><img style="position: relative; top: 50%; left: 45%; transform: translateY(-50%); opacity: 1" src="<?php echo e(URL::asset('images/ajaxLoading.svg')); ?>"></div>
    
    <div class="row">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?>
          <div class="col-md-4">
            <div class="form-group">
               <label>Branch</label>
                  <select name="branch" id="branch" class="form-control">
                    <option value="">All</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php echo e(csrf_field()); ?> 
            </div>
           
          </div>
          <?php endif; ?>
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
       <a href="<?php echo e(Route('reports-me/job/placements')); ?>" >
        <div class="color-palette-set">
          <div class="bg-success disabled color-palette"><span> &nbsp; Job Placements</span></div>
          <div class="bg-success color-palette">&nbsp; &nbsp;<span id="jobs"> </span></div>
        </div>
        </a>
      </div>
       <div class="col-sm-4 col-md-2">
        <a href="<?php echo e(Route('reports-me/job/placements')); ?>" >
        <div class="color-palette-set">
          <div class="bg-warning disabled color-palette"><span> &nbsp; Employers</span></div>
          <div class="bg-warning color-palette">&nbsp; &nbsp;<span id="emp"> </span></div>
        </div>
        </a>
      </div>

       <div class="col-sm-4 col-md-2">
       <a href="<?php echo e(url('reports-me/job/assesment')); ?>">
        <div class="color-palette-set">
          <div class="bg-danger disabled color-palette"><span> &nbsp; Workplace Asessment</span></div>
          <div class="bg-danger color-palette">&nbsp; &nbsp;<span id="ass"> </span></div>
        </div>
       </a>
      </div>
       <div class="col-sm-4 col-md-2">
       <a href="<?php echo e(url('reports-me/job/awareness')); ?>">
        <div class="color-palette-set">
          <div class="bg-primary disabled color-palette"><span> &nbsp; Awaraness of WP Condition</span></div>
          <div class="bg-primary color-palette">&nbsp; &nbsp;<span id="awa"> </span></div>
        </div>
      </a>
      </div>
      <div class="col-sm-4 col-md-4">
       
      </div>

      
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-4 col-md-10">
       
       <span>Date From : </span> <span id="date1" class="text-primary"></span> <span> to : </span> <span id="date2" class="text-primary"></span> 
      </div>
      <div class="col-sm-4 col-md-2">
       <span style="float: right" class="text-right"><a href="<?php echo e(URL::to('youth-placed-in-jobs')); ?>"><button type="button" class="btn btn-success btn-flat"><i class="fas fa-file-invoice"> View Full Report</i></button></a></span>
       
      </div>
    </div>
    <br>
	    <div class="row">
	        <div class="col-md-4">
	            <div class="card card-primary">
  					<div class="card-header">
    					Gender wise Job Placement
  					</div>
  					<div class="card-body">
    					<div id="piechart" style=" height: 500px;"></div>
  					</div>
				</div>
	        </div>
	        <div class="col-md-8">
	            <div class="card card-primary">
  					<div class="card-header">
    					Industry wise Job Placement
  					</div>
  					<div class="card-body">
    					<div id="barchart_material5" style=" height: 500px;"></div>
  					</div>
				</div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Employers where Youth Placed <span class="badge badge-info text-right"> </span>
             </div>
             <div class="card-body">
               <div id="table_div"></div>
             </div>
           </div>
	        </div>
          <div class="col-md-8">
           <div class="card card-primary">
             <div class="card-header">
               Salary Range in Job Placement
             </div>
             <div class="card-body">
               <div id="curve_chart1" style=" height: 320px"></div>
             </div>
           </div>
          </div>
	    </div>

      <div class="row">
          <div class="col-md-4">
           <div class="card card-primary">
             <div class="card-header">
               Company type wise Job Placement <span class="badge badge-info text-right"> </span>
             </div>
             <div class="card-body">
               <div id="piechart4" style=" height: 500px;"></div>
             </div>
           </div>
          </div>
          <div class="col-md-8">
           <div class="card card-primary">
             <div class="card-header">
               DS Division wise Job Placement
             </div>
             <div class="card-body">
               <div id="barchart_material" style=" height: 500px;"></div>
             </div>
           </div>
          </div>
      </div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
var _token = $('input[name="_token"]').val();
fetch_data();

 function fetch_data(branch='', dateStart='', dateEnd=''/* ,course='',institute=''*/)
 {
  $.ajax({
   url:"<?php echo e(url('/analysis-job-fetch')); ?>",
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
    
    var male = data.male;
    var female = data.female;

    var jobs = male+female;
    $('#jobs').text(jobs);
    $('#ass').text(data.assesments);
    $('#awa').text(data.awaraness);


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
          ['Male',     male],
          ['Female',      female]
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

      //chart3

     google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
      var data2 = google.visualization.arrayToDataTable([
        ["Element", "Count", { role: "style" } ],
        ["0-4999", data.salary1, "blue"],
        ["5000-9999", data.salary2, "orange"],
        ["10000-14999", data.salary3, "green"],
        ["15000-19999", data.salary4, "purple"],
        ["20000-24999", data.salary5, "brown"],
        ["Above 25000", data.salary6, "red"],
      ]);

      var view2 = new google.visualization.DataView(data2);
      view2.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options2 = {
        title: "",
        height: 300,
        curveType: 'function',
          chartArea:{
          left:70,
          top: 20,
          bottom:20,
          },
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart2 = new google.visualization.ColumnChart(document.getElementById("curve_chart1"));
      chart2.draw(view2, options2);
      
      window.addEventListener('resize', drawChart2, false);
  }

  //table

  google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data3 = new google.visualization.DataTable();

        var emp_array = data.employers;
        $('#emp').text(emp_array.length);

        var dataRows2 = [['',  null]];
        for (var i = 0; i < emp_array.length; i++) {
          dataRows2.push([emp_array[i].name,  emp_array[i].total]);
        }
        data3.addColumn('string', 'Employer');
        data3.addColumn('number', 'Total Youths');
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

      //compmny type
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {
        var type_array = data.types;
        //alert(type_array.length);
        var  types = [['Company Type', 'No of Youth']];
        for (var i = 0; i < type_array.length; i++) {
          types.push([type_array[i].company_type,  type_array[i].total]);
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

      //chart 2
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart5);

      function drawChart5() {

      var array_indusrty = data.industries;

      var industry = [['Industry', 'No of Youths']];
      for (var i = 0; i < array_indusrty.length; i++) {
        industry.push([array_indusrty[i].industry, parseFloat(array_indusrty[i].total)]);
      }
        var dataa5 = google.visualization.arrayToDataTable(industry);

        var options5 = {
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

        var chart5 = new google.charts.Bar(document.getElementById('barchart_material5'));

        chart5.draw(dataa5, google.charts.Bar.convertOptions(options5));
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>