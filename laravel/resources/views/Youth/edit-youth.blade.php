@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<br>
    <section class="content">
	    	<div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Youth Details</h3>
                <ul class="nav nav-pills ml-auto p-2" id="tabs">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Personal Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Education</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_7" data-toggle="tab">Language Proficiency </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Courses</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Current Status</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_5">Finish</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1"> 
                  	<form id="youth" name="youth">
	                  	<div class="row">
	                  		<div class="col-md-4">
	                  			
	                  			<div class="form-group">
                   					<label for="name">1. Name with initials: &nbsp;&nbsp;</label>
                   					<input type="text" id="name" name="name" class="form-control" value="{{$youth->name}}">
                   				</div>
                   				<div class="form-group">
                   					<label for="nic">4. NIC: &nbsp;&nbsp;</label>
                   					<input type="text" id="nic" name="nic" class="form-control" value="{{$youth->nic}}" disabled>
                   				</div>
                           <div class="form-group">
                            <label for="nic">7. Phone Numbers: &nbsp;&nbsp; <small>(seperete with comma)</small></label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{$youth->phone}}">
                          </div>
                   				<div class="form-group">
                   					<label for="maritial_status">10. Marital Status &nbsp;&nbsp;</label>
                   					<select name="maritial_status" id="maritial_status" class="form-control">
                   						<option value="">Select Option</option>
                   						<option @if($youth->maritial_status=='Single') selected @endif>Single</option>
                   						<option @if($youth->maritial_status=='Married') selected @endif>Married</option>
                   						<option @if($youth->maritial_status=='Divorced') selected @endif>Divorced</option>
                   						<option @if($youth->maritial_status=='Seperated') selected @endif>Seperated</option>
                   						<option @if($youth->maritial_status=='Dependent') selected @endif>Dependent</option>
                   						<option @if($youth->maritial_status=='Widow') selected @endif>Widow</option>
                   					</select>
                   				</div>
                   				

                          <div class="form-group">
                            <label for="branch_id">13. Branch &nbsp;&nbsp;</label>
                            <select class="form-control" id="branch_id" name="branch_id" >
                                <option value="0">Select a Option </option>
                                @foreach ($branches as $branch) 
                                <option @if(Auth::user()->branch == $branch->id || $youth->branch_id==$branch->id) selected @endif  value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                          </div>
	                  		</div>
	                  		<div class="col-md-4">
	                  			<div class="form-group">
                   					<label for="full_name">2. Full Name: &nbsp; &nbsp;</label>
                   					<input type="text" name="full_name" id="full_name" class="form-control" value="{{$youth->full_name}}">
                   				</div>
                   				<div class="form-group">
                   					<label for="birth_date">5. Birth Date: &nbsp; &nbsp;</label>
                   					<input type="date" name="birth_date" id="birth_date" class="form-control" value="{{$youth->birth_date}}">
                   				</div>
                          <div class="form-group">
                            <label for="birth_date">8. Email Address: &nbsp; &nbsp;</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$youth->email}}">
                          </div>
                   				<div class="form-group">
                   					<label for="nationality">11. Nationility: &nbsp;&nbsp;</label>
                   					<select name="nationality" id="nationality" class="form-control">
                   						<option value="">Select Option</option>
                   						<option @if($youth->nationality=='Sinhala') selected @endif>Sinhala</option>
                   						<option @if($youth->nationality=='Tamil') selected @endif>Tamil</option>
                   						<option @if($youth->nationality=='Muslim') selected @endif>Muslim</option>
                   						<option @if($youth->nationality=='Burger') selected @endif>Burger</option>
                   						<option @if($youth->nationality=='Other') selected @endif>Other</option>
                   					</select>
                   				</div>
                          <div class="form-group">
                            <label for="disability">14. Are you differtnly abled? &nbsp;&nbsp;</label>
                            <select name="disability" id="disability" class="form-control">
                              <option value="">Select Option</option>
                              <option @if($youth->disability=='Yes') selected @endif>Yes</option>
                              <option @if($youth->disability=='No') selected @endif>No</option>
                            </select>
                          </div>
                   					
	                  		</div>
	                  		<div class="col-md-4">
                   				<div class="form-group">
                   					<label for="gender">3. Gender: &nbsp;&nbsp;</label>
                   					<select name="gender" id="gender" class="form-control">
                   						<option value="">Select Option</option>
                   						<option @if($youth->gender=='Male') selected @endif value="Male">Male</option>
                   						<option @if($youth->gender=='Female') selected @endif value="Female">Female</option>
                   						
                   					</select>
                   				</div>
                   				<div class="form-group">
                   					<label for="gender">6. Driving Licence &nbsp;&nbsp;</label>
                   					<select name="driving_licence" id="driving_licence" class="form-control">
                   						<option value="">Select Option</option>
                   						<option @if($youth->driving_licence=='No Licence') selected @endif>No Licence</option>
                   						<option @if($youth->driving_licence=='A1,A,D') selected @endif>A1,A,D</option>
                   						<option @if($youth->driving_licence=='B1,E,F') selected @endif>B1,E,F</option>
                   						<option @if($youth->driving_licence=='B,C,C1') selected @endif>B,C,C1</option>
                   						<option @if($youth->driving_licence=='C1,B1') selected @endif>C1,B1</option>
                   						<option @if($youth->driving_licence=='C,B') selected @endif>C,B</option>
                   						<option @if($youth->driving_licence=='CE,B') selected @endif>CE,B</option>
                   						<option @if($youth->driving_licence=='D1,A1') selected @endif>D1,A1</option>
                   						<option @if($youth->driving_licence=='D,A') selected @endif>D,A</option>
                   						<option @if($youth->driving_licence=='DE') selected @endif>DE</option>
                   						<option @if($youth->driving_licence=='G1') selected @endif>G1</option>
                   						<option @if($youth->driving_licence=='G') selected @endif>G</option>
                   						<option @if($youth->driving_licence=='J') selected @endif>J</option>
                   						
                   					</select>
                   				</div>
                   				<div class="form-group">
			          				<label for="highest_qualification">9. Highest Educational Qualification:</label>
			          				<select name="highest_qualification" id="highest_qualification" class="form-control">
			          					<option value="">Select Option</option>
			          					<option @if($youth->highest_qualification=='Ordinary Level') selected @endif>Ordinary Level</option>
			          					<option @if($youth->highest_qualification=='Advanced Level') selected @endif>Advanced Level</option>
			          					<option @if($youth->highest_qualification=='Certificate') selected @endif>Certificate</option>
			          					<option @if($youth->highest_qualification=='Certificate') selected @endif>Certificate</option>
			          					<option @if($youth->highest_qualification=='Higher Diploma') selected @endif>Higher Diploma</option>
			          					<option @if($youth->highest_qualification=='Degree') selected @endif>Degree</option>
			          					<option @if($youth->highest_qualification=='Masters') selected @endif>Masters</option>
			          					<option @if($youth->highest_qualification=='Doctorate') selected @endif>Doctorate</option>
			          					<option @if($youth->highest_qualification=='Skilled Apprentice') selected @endif>Skilled Apprentice</option>
			          				</select>
		          				</div>
		          				<div class="form-group">

									     <label for="family_id">12. Select Family</label>
										      
                        <div class="input-group">
                        
                        <input type="text" id="fam_id" name="fam_id" class="form-control" value="{{ $youth->family->head_of_household}}" placeholder="Enter Name of Household">
                        <div style="cursor: pointer" onclick="window.open('{{Route('youth/family/add')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add family to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="familyList"></div>
                          <input type="hidden" id="family_id" name="family_id" value="{{ $youth->family_id}}">
								      </div>
                      <div class="form-group">
                            <label for="reason">15. if Yes Explian</label>
                            <textarea class="form-control" id="reason" placeholder="optional" name="reason">{{$youth->reason}}</textarea>
                      </div>
	                  	</div>
	                  	</div>	
                    
                      <input type="hidden" id="youth_id" name="id" value="{{$youth->id}}">
                      {{csrf_field()}}
                   		<button type="button" id="personal_info" class="btn btn-success btn-flat">Update Changes</button>
                   	</form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <form action="" method="get" id="education" accept-charset="utf-8">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="card card-success">
                                <div class="card-header">
                                  <h3 class="card-title">O\L Information</h3>
                                </div>
                                
                              <div class="card-body">
                              <div class="form-group">
                                <label for="ol_year">O\L Year</label>
                                <input class="form-control" maxlength="4" type="number" name="ol_year" id="ol_year" value="@if(!is_null($results)){{$results->ol_year}}@endif">
                              </div> 
                              <div class="form-group">
                                <label for="ol_attempt">O\L Attempt</label>
                                <input class="form-control" maxlength="2" step="1" type="number" name="ol_attempt" id="ol_attempt" value="@if(!is_null($results)){{$results->ol_attempt}}@endif">
                              </div> 
                              <div class="form-group">
                                <label for="ol_pass_or_fail">O\L pass or fail ?</label>
                                  <select class="form-control" name="ol_pass_or_fail">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($results)) @if($results->ol_pass_or_fail=='Pass') selected @endif @endif>Pass</option>
                                    <option @if(!is_null($results)) @if($results->ol_pass_or_fail=='Fail') selected @endif @endif>Fail</option>
                                  </select>
                              </div>
                            </div>
                          </div>
                        </div>
                            <div class="col-md-4">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">A\L Information</h3>
                                </div>
                                
                              <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                <label for="al_year">A\L Year</label>
                                <input class="form-control" maxlength="4" type="number" name="al_year" id="al_year" value="@if(!is_null($results)){{ $results->al_year}}@endif">
                                </div> 
                                <div class="form-group">
                                  <label for="al_attempt">A\L Attempt</label>
                                  <input class="form-control" maxlength="2" step="1" type="number" name="al_attempt" id="al_attempt" value="@if(!is_null($results)){{$results->al_attempt}}@endif">
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for="al_pass_or_fail">A\L pass or fail ?</label>
                                        <select class="form-control" name="al_pass_or_fail" id="al_pass_or_fail">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($results)) @if($results->al_pass_or_fail=='Pass') selected @endif @endif>Pass</option>
                                          <option @if(!is_null($results)) @if($results->al_pass_or_fail=='Fail') selected @endif @endif>Fail</option>
                                        </select>
                                    </div>
                                   </div>
                                   <div class="col-sm-6">
                                     <div class="form-group">
                                      <label for="stream">Stream</label>
                                      <select class="form-control" name="stream" id="stream">
                                        <option value="">Select Option</option>
                                        <option @if(!is_null($results)) @if($results->stream=='Commerce') selected @endif  @endif>Commerce</option>
                                        <option @if(!is_null($results)) @if($results->stream=='Art') selected @endif  @endif>Art</option>
                                        <option @if(!is_null($results)) @if($results->stream=='Maths') selected @endif  @endif>Maths</option>
                                        <option @if(!is_null($results)) @if($results->stream=='Science') selected  @endif @endif>Science</option>
                                        <option @if(!is_null($results)) @if($results->stream=='Technology') selected @endif  @endif>Technology</option>
                                      </select>
                                  </div>
                                   </div>
                                 </div> 
                                
                              
                              </div>
                            </div>
                          </div>
                        </div>
                            <div class="col-md-4">
                              <div class="card card-warning">
                                <div class="card-header">
                                  <h3 class="card-title">University Information</h3>
                                </div>
                                
                              <div class="card-body">
                                <div class="form-group">
                                    <label for="degree">Degree Name</label>
                                    <input type="text" name="degree" id="degree" class="form-control" value="@if(!is_null($results)){{$results->degree}} @endif ">
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="pass_out_year">Pass out Year</label>
                                      <input type="number" name="pass_out_year" id="pass_out_year" class="form-control" value="@if(!is_null($results)){{$results->pass_out_year}}@endif">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                     
                                    <div class="form-group">
                                        <label for="medium">Medium</label>
                                        <input type="text" name="medium" id="medium" class="form-control" value="@if(!is_null($results)){{ $results->medium}} @endif ">
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" name="grade" id="grade" class="form-control" value="@if(!is_null($results)){{ $results->grade}} @endif ">
                                </div>
                                <div class="form-group">
                                    <label for="university">University</label>
                                    <input type="text"  name="university" id="university" class="form-control" value="@if(!is_null($results)){{ $results->university}} @endif ">
                                </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title">Other Professional Qualifications</h3>
                                </div>
                                
                              <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control" id="other_professional_qualifications" name="other_professional_qualifications">@if(!is_null($results)){{ $results->other_professional_qualifications}} @endif </textarea>
                                </div>
                                 
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      {{ csrf_field() }}
                      
                          <input type="hidden" id="result_id" name="id" value="@if(!is_null($results)){{$results->id}} @endif ">
                          <input type="hidden" id="youth_id" name="youth_id" value="{{$youth->id}}">
                      <div class="form-group">
                        <button type="button" id="update-education" class="btn btn-success btn-flat">Update Changes</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_7"> 
                    <form id="language">
                      <div class="row"> 
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Language</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  Tamil
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  Sinhala
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  English
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Reading</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="reading_tamil" @if(!is_null($language))@if($language->reading_tamil) checked @endif @endif>  

                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="reading_sinhala" @if(!is_null($language))@if($language->reading_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="reading_english" @if(!is_null($language))@if($language->reading_english) checked @endif @endif>  
                                  
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Speaking</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="speaking_tamil" @if(!is_null($language))@if($language->speaking_tamil) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="speaking_sinhala" @if(!is_null($language))@if($language->speaking_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="speaking_english" @if(!is_null($language))@if($language->speaking_english) checked @endif @endif>  
                                  
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Writing</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="writing_tamil" @if(!is_null($language))@if($language->writing_tamil) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="writing_sinhala" @if(!is_null($language))@if($language->writing_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="writing_english" @if(!is_null($language))@if($language->writing_english) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item text-right">
                                <br>  
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id" value="@if(!is_null($language)){{$language->id}}@endif">
                                  <button type="button" id="update-language" class="btn btn-success btn-flat text-right">Update</button>   
                               
                              </li>
                            </ul>
                          </div>
                      </div>
                      <input type="hidden" name="youth_id" id="language_youth_id" value="{{$youth->id}}">
                    </form>
                  </div>
                  <div class="tab-pane" id="tab_3">
                    
                        <div class="card card-success">
                              <div class="card-header">
                                <h3 class="card-title float-left">Followed Courses Detials </h3><span class="text-right float-right"><button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#add-course-model"><i class="fas fa-lg fa-plus"></i></button></span>
                              </div>
                                
                              <div class="card-body">
                                <table id="followed_courses" class="table"> 
                                  <thead>
                                    <tr>
                                      <?php $no=1 ?>
                                      <th>#</th>
                                      <th>Course Name</th>
                                      <th>Status</th>
                                      <th>supported By</th>
                                      <th>Completed At</th>
                                      <th>Edit</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                    @foreach($followed_courses as $fc)  
                                    <tr>
                                      <td>{{$no++}}</td>
                                      <td>{{$fc->name}}</td>
                                      <td>{{$fc->status}}</td>
                                      <td>@if($fc->provided_by_bec==1) {{"BEC"}} 
                                      @else
                                      {{"Other Institute"}}  
                                      @endif</td>
                                      <td>{{$fc->completed_at }} </td>
                                      <td><button type="button" data-id="{{$fc->ys_id}}" data-course_name="{{$fc->name}}" data-status="{{$fc->status}}" data-provided_by_bec="{{$fc->provided_by_bec}}" data-completed_at="{{$fc->completed_at}}" data-course_id="{{$fc->course_id}}"  class="btn btn-success btn-flat" id="edit-course"><i class="fas fa-edit"></i></button></td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- add new course -->
                <div class="modal fade" id="add-course-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Add a Followed Courses</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="add-courses">
                                <div  class="row">
                                <div  class="col-md-6">
                                  <div class="form-group">
                                    <label for="ol_year">Course</label>
                                      <div class="input-group">
                                      <input class="form-control" type="text" name="course_name" id="course_name3" placeholder="Search Course">
                                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                        <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                        </div>  
                                      </div>
                                  <div id="courseList3"></div>
                                  <input class="form-control" type="hidden" name="course_id" id="course_id3" value="">
                                  </div>                               
                              </div>
                              <input type="hidden" name="status" id="status" value="Followed">
                              <div  class="col-md-6 form-group">
                                <label>is supported by Berendina ?</label>

                                <select name="provided_by_bec" class="form-control" id="provided_by_bec1">
                                  <option value="">Select Option</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                  
                                </select>
                              </div>
                              <div  class="col-md-6">
                                <div class="form-group">
                                <label for="completed_at">Completed Date <small class="text-muted">(Approximate)</small></label>
                                <input type="date" name="completed_at" id="completed_at1" class="form-control">
                              </div>
                              </div>
                            
                        </div>
                        {{ csrf_field() }}
                          <input type="hidden" id="youth_course_id1"  name="youth_id" value="{{$youth->id}}">
                        </form>
                    </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="add-course" class="btn btn-primary">Add</button>
                      </div>
                  </div>
               </div>
            </div>
                <div class="modal fade" id="update-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Update Followed Courses</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="courses">
                                <div  class="row">
                                <div  class="col-md-6">
                                  <div class="form-group">
                                    <label for="ol_year">Course</label>
                                      <div class="input-group">
                                      <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Search Course">
                                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                        <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                        </div>  
                                      </div>
                                  <div id="courseList"></div>
                                  <input class="form-control" type="hidden" name="course_id" id="course_id" value="">
                                  </div>                               
                              </div>
                              <input type="hidden" name="status" id="status" value="Followed">
                              <div  class="col-md-6 form-group">
                                <label>is supported by Berendina ?</label>

                                <select name="provided_by_bec" class="form-control" id="provided_by_bec">
                                  <option value="">Select Option</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                  
                                </select>
                              </div>
                              <div  class="col-md-6">
                                <div class="form-group">
                                <label for="completed_at">Completed Date <small class="text-muted">(Approximate)</small></label>
                                <input type="date" name="completed_at" id="completed_at" class="form-control">
                              </div>
                              </div>
                            
                        </div>
                        {{ csrf_field() }}
                          <input type="hidden" id="youth_course_id" name="id" value="">
                        </form>
                    </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="update-course" class="btn btn-primary">Update changes</button>
                      </div>
                  </div>
               </div>
            </div>
                <div class="tab-pane" id="tab_4">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card card-success">
                          <div class="card-header">
                                <h3 class="card-title">Current Status</h3>
                          </div>   
                          <div class="card-body">
                            <form id="current_status_form">
                              <input type="hidden" name="id" id="youth_id_3" value="{{$youth->id}}">
                              <select name="current_status" id="current_status" class="form-control">
                                <option value="">Select Option</option>
                                <option @if($youth->current_status=='Permanent Job After Vocational/Prof Training') selected @endif>Permanent Job After Vocational/Prof Training</option>
                                <option @if($youth->current_status=='Permanent Job without Vocational/Prof Training') selected @endif>Permanent Job without Vocational/Prof Training</option>
                                <option @if($youth->current_status=='Temporary Job After Vocational/Prof Training') selected @endif>Temporary Job After Vocational/Prof Training</option>
                                <option @if($youth->current_status=='Temporary Job without Vocational/Prof Training') selected @endif>Temporary Job without Vocational/Prof Training</option>
                                <option @if($youth->current_status=='Following a course') selected @endif>Following a course</option>
                                <option @if($youth->current_status=='Self Employed') selected @endif>Self Employed</option>
                                <option @if($youth->current_status=='No Job') selected @endif>No Job</option>
                                
                              </select>
                              {{ csrf_field() }}
                            </form>
                          </div>
                      </div>

                    </div>
                  
                  <div class="col-md-8">
                      <div class="card card-primary">
                          <div class="card-header">
                                <h3 class="card-title">Additional Details</h3>
                          </div>
                                
                          <div class="card-body">
                            
                            <div id="job" @if($youth->current_status!=='Permanent Job After Vocational/Prof Training' && $youth->current_status!=='Permanent Job without Vocational/Prof Training') style="display: none" @endif >
                              <form id="jobs">
                                <div class="form-group">
                                  <label for="title">Job Title</label>
                                  <input type="text" name="title" id="title" class="form-control" value="@if(!is_null($jobs_details)) {{$jobs_details->title}} @endif">
                                </div>
                                <div class="form-group">
                                  <label for="employer_name">Employer Name</label>
                                  <input type="text" name="employer_name" id="employer_name" class="form-control" value="@if(!is_null($jobs_details)){{$jobs_details->employer_name}} @endif">
                                </div>
                                <div class="form-group">
                                        <label for="need_help">Do you have a proper career plan ?</label>
                                        <select name="career_plan" id="career_plan" class="form-control">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($jobs_details)) @if($jobs_details->career_plan==1) selected @endif @endif value="1">Yes</option>
                                          <option @if(!is_null($jobs_details)) @if($jobs_details->career_plan==0) selected @endif @endif value="0">No</option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                        <label for="need_help">Have you taken any step on it ?</label>
                                        <select name="step_forward" id="step_forward" class="form-control">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($jobs_details)) @if($jobs_details->step_forward==1) selected @endif @endif value="1">Yes</option>
                                          <option @if(!is_null($jobs_details)) @if($jobs_details->step_forward==0) selected @endif @endif value="0">No</option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                    <label>What are the steps you have taken ?</label>
                                    
                                    <textarea class="form-control" id="description" name="description" rows="3">@if(!is_null($jobs_details)) {{$jobs_details->description}} @endif</textarea>
                                  </div>
                                {{csrf_field()}}
                                <input type="hidden" name="youth_id" id="" value="{{$youth->id}}">
                                <input type="hidden" name="id" id="id" value="@if(!is_null($jobs_details)){{$jobs_details->id}} @endif">
                                <input type="hidden" name="nature_job" value="Permanat Job">
                                <button type="button" class="btn btn-primary btn-flat" id="update-jobs">Update Changes</button>
                              </form>
                            </div>
                            
                            
                            <div id="temp_job" @if($youth->current_status!=='Temporary Job After Vocational/Prof Training' && $youth->current_status!=='Temporary Job without Vocational/Prof Training') style="display: none" @endif>
                              <form id="temp_jobs">
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="industry">Preferable Industry</label>
                                      <?php 
                                        $industries = array('Agriculture & Food Processing','Automobiles','Banking & Financial Services','BPO or KPO ','Civil & Construction','Consumer Goods & Durables','Consulting','Education','Engineering','Ecommerce & Internet','Events & Entertainment','Export & Import','Government & Public Sector','Healthcare','Hotel, Travel & Leisure','Insurance','IT & Telecom','Logistics & Transportation','Manufacturing','Manpower & Security','News & Media','NGO & Non profit','Pharmaceutical','Real Estate','Wholesale & Retail','Others');
                                      ?>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        @foreach($industries as $industry)
                                          <option @if(!is_null($intresting_jobs)) @if(in_array($industry,$intresting_jobs->industry)) selected @endif @endif>{{$industry}}</option>
                                          
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="location">Preferable Location</label>
                                      <?php 
                                        $locations = array('Home District','Home Province','Other City','Colombo','Industrial Zone','Abroad');
                                      ?>
                                      <select name="location[]" id="location" multiple class="form-control">
                                        @foreach($locations as $location) 
                                        <option  @if(!is_null($intresting_jobs)) @if(in_array($location,$intresting_jobs->location)) selected @endif @endif>{{$location}}</option>
                                        @endforeach  
                                      </select>
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <label for="experience">Your Expierinces</label>
                                  <textarea class="form-control" name="experience" id="experience"> @if(!is_null($intresting_jobs)){{$intresting_jobs->experience}} @endif</textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="min_salary">Min. Salary Expectation</label>
                                      <input value="@if(!is_null($intresting_jobs)){{$intresting_jobs->min_salary}}@endif" type="number" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label for="intresting_courses">Preferable Courses (if You like to follow)</label>
                                      <select name="intresting_courses[]" id="intresting_courses"  class="form-control" multiple>
                                        <option value="">Select Option</option>
                                        @foreach($course_categories as $cc)
                                           <option @if(!is_null($intresting_jobs)) @if(in_array($cc->id,$intresting_jobs->intresting_courses)) selected @endif @endif value="{{$cc->id}}">{{$cc->course_category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" name="i_jobs_id" value="@if(!is_null($intresting_jobs)){{$intresting_jobs->id}}@endif">
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input value="@if(!is_null($intresting_business)) {{$intresting_business->intresting_business}} @endif" type="text" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help=="Yes") selected @endif @endif>Yes</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help=="No") selected @endif @endif>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Finacial") selected @endif @endif>Finacial</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Material") selected @endif @endif>Material</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Guidance") selected @endif @endif>Guidance</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Tempory Training") selected @endif @endif>Tempory Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Vocational Training") selected @endif @endif>Vocational Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help=="Other") selected @endif @endif>Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <input type="hidden" name="i_business_id" value="@if(!is_null($intresting_business)){{$intresting_business->id}} @endif">
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">1. Do you have an account created by a reputed bank ? </label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account=="Yes") selected @endif @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account=="No") selected @endif @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">2. Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone=="Yes") selected @endif @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone=="No")  selected @endif @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">3. Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training=="Yes") selected @endif @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training=="No") selected @endif @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">4. Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when=="Week Days") selected @endif @endif>Week Days</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when=="Weekends") selected @endif @endif>Weekends</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when=="Holiday") selected @endif @endif>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            
                                {{csrf_field()}}

                                <input type="hidden" name="common_details_id" id="common_details_id" value="@if(!is_null($youth_common_details)){{$youth_common_details->id}}@endif">
                                <input type="hidden" name="youth_id" id="" value="{{$youth->id}}">

                                <button type="button" class="btn btn-primary btn-flat" id="update-tempory">Update Changes</button>
                              </form>
                            </div>
                            {{--VT courses--}}
                           
                            <div id="vt_course"  @if($youth->current_status!=='Following a course') style="display: none" @endif>
                              <form id="vt_courses">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ol_year">Course</label>
                                      <div class="input-group">
                                      <input value="@if(!is_null($following_course)) {{ $following_course->name }} @endif" class="form-control" type="text" name="course_name2" id="course_name2" placeholder="Search Course">
                                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                        <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                        </div>  
                                      </div>
                                  <div id="courseList2"></div>
                                  <input class="form-control" type="hidden" value="@if(!is_null($following_course)){{$following_course->course_id}}@endif" name="course_id" id="course_id2">
                                  </div>
                                  <input type="hidden" name="status" id="status" value="Following">
                                  <div  class="col-md-6 form-group">
                                <label>is This course provied by Berendina ?</label>

                                <select name="provided_by_bec" class="form-control" id="provided_by_bec">
                                  <option value="">Select Option</option>
                                  <option @if(!is_null($following_course)) @if($following_course->provided_by_bec==1) selected @endif @endif value="1">Yes</option>
                                  <option @if(!is_null($following_course)) @if($following_course->provided_by_bec==0) selected @endif @endif value="0">No</option>
                                  
                                </select>
                              </div>
                                  <div  class="col-md-6">
                                    <div class="form-group">
                                    <label for="completed_at">Completed date</label>
                                    <input type="text" value="@if($following_course) {{ $following_course->completed_at}} @endif" name="completed_at" id="completed_at1" class="form-control">
                                  </div>
                                  </div>
                                <input type="hidden" name="youth_following_course_id" value="@if(!is_null($following_course)){{$following_course->ys_id}}@endif">
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                   Preferable Jobs Details
                                  </span>
                                </div>
                                <br>  
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="location">1. Preferable Location</label>
                                      <?php 
                                        $locations = array('Home District','Home Province','Other City','Colombo','Industrial Zone','Abroad');
                                      ?>
                                      <select name="location[]" id="location" multiple class="form-control">
                                        @foreach($locations as $location) 
                                        <option  @if(!is_null($intresting_jobs)) @if(in_array($location,$intresting_jobs->location)) selected @endif @endif>{{$location}}</option>
                                        @endforeach  
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="industry">2. Preferable Industry</label>
                                      <?php 
                                        $industries = array('Agriculture & Food Processing','Automobiles','Banking & Financial Services','BPO or KPO ','Civil & Construction','Consumer Goods & Durables','Consulting','Education','Engineering','Ecommerce & Internet','Events & Entertainment','Export & Import','Government & Public Sector','Healthcare','Hotel, Travel & Leisure','Insurance','IT & Telecom','Logistics & Transportation','Manufacturing','Manpower & Security','News & Media','NGO & Non profit','Pharmaceutical','Real Estate','Wholesale & Retail','Others');
                                      ?>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        
                                        @foreach($industries as $industry)
                                          <option @if(!is_null($intresting_jobs)) @if(in_array($industry,$intresting_jobs->industry)) selected @endif @endif>{{$industry}}</option>
                                          
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="profession_adequate">3. Is the course you are currently pursuing in such a profession adequate ?</label>
                                        <select name="profession_adequate" id="profession_adequate" class="form-control">
                                              <option value="">Select Option</option>
                                              <option @if(!is_null($intresting_jobs)) @if($intresting_jobs->profession_adequate =="Yes") selected @endif @endif )>Yes</option>
                                              <option @if(!is_null($intresting_jobs)) @if($intresting_jobs->profession_adequate =="No") selected @endif @endif>No</option>
                                              <option @if(!is_null($intresting_jobs)) @if($intresting_jobs->profession_adequate =="No Idea") selected @endif @endif>No Idea</option>
                                    </select>
                                  </div>
                                  </div>
                                   <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="plan_to_meet_qualifications">4. If No, Do you have any plan to meet the qualifications?</label>
                                        <select name="plan_to_meet_qualifications" id="plan_to_meet_qualifications" class="form-control">
                                              <option value="">Select Option</option>
                                              <option @if(!is_null($intresting_jobs)) @if($intresting_jobs->plan_to_meet_qualifications =="Yes") selected @endif @endif >Yes</option>
                                              <option  @if(!is_null($intresting_jobs)) @if($intresting_jobs->plan_to_meet_qualifications =="No") selected @endif @endif >No</option>
                                    </select>
                                  </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="details">5. If yes, Explain in detail</label>
                                  <textarea class="form-control" name="details" id="details">@if(!is_null($intresting_jobs)) {{$intresting_jobs->details}} @endif</textarea>
                                </div>

                                <div class="form-group">
                                  <label for="experience">6. Your Experiences</label>
                                  <textarea class="form-control" name="experience" id="experience">@if(!is_null($intresting_jobs)) {{$intresting_jobs->experience}} @endif</textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="min_salary">7. Min. Salary Expectation</label>
                                      <input type="number" value="@if(!is_null($intresting_jobs)){{$intresting_jobs->min_salary}}@endif" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    
                                  </div>
                                </div>
                                <input type="hidden" name="i_jobs_id" value="@if(!is_null($intresting_jobs)){{$intresting_jobs->id}}@endif">
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" value="@if(!is_null($intresting_business)) {{ $intresting_business->intresting_business }} @endif" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help =="Yes") selected @endif  @endif >Yes</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help =="No") selected @endif  @endif>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Finacial") selected @endif  @endif >Finacial</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Material") selected @endif  @endif >Material</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Guidance") selected @endif  @endif >Guidance</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Tempory Training") selected @endif  @endif >Tempory Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Vocational Training") selected @endif  @endif >Vocational Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Other") selected @endif  @endif >Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <input type="hidden" name="i_business_id" value="@if(!is_null($intresting_business)){{$intresting_business->id}}@endif">
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">1. Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">2. Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">3. Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">4. Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Week Days") selected @endif  @endif>Week Days</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Weekends") selected @endif  @endif>Weekends</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Holiday") selected @endif  @endif>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="common_details_id" value="@if(!is_null($youth_common_details)){{$youth_common_details->id}}@endif">
                                <input type="hidden" name="youth_id" id="" value="{{$youth->id}}">
                                
                                {{csrf_field()}}
                                <button type="button" class="btn btn-primary btn-flat" id="update-following-course">Update Changes</button>
                              </form>
                            </div>
                            
                            {{--No Job--}}
                           
                            <div id="no_job"  @if($youth->current_status!=='No Job') style="display: none" @endif>
                              <form id="no_jobs">
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                   Preferable Jobs Details
                                  </span>
                                </div>
                                <br>  
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="industry">1. Preferable Industry</label>
                                      <?php 
                                        $industries = array('Agriculture & Food Processing','Automobiles','Banking & Financial Services','BPO or KPO ','Civil & Construction','Consumer Goods & Durables','Consulting','Education','Engineering','Ecommerce & Internet','Events & Entertainment','Export & Import','Government & Public Sector','Healthcare','Hotel, Travel & Leisure','Insurance','IT & Telecom','Logistics & Transportation','Manufacturing','Manpower & Security','News & Media','NGO & Non profit','Pharmaceutical','Real Estate','Wholesale & Retail','Others');
                                      ?>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        
                                        @foreach($industries as $industry)
                                          <option @if(!is_null($intresting_jobs)) @if(in_array($industry,$intresting_jobs->industry)) selected @endif @endif>{{$industry}}</option>
                                          
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="location">2. Preferable Location</label>
                                      <?php 
                                        $locations = array('Home District','Home Province','Other City','Colombo','Industrial Zone','Abroad');
                                      ?>
                                      <select name="location[]" id="location" multiple class="form-control">
                                        @foreach($locations as $location) 
                                        <option  @if(!is_null($intresting_jobs)) @if(in_array($location,$intresting_jobs->location)) selected @endif @endif>{{$location}}</option>
                                        @endforeach  
                                      </select>
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <label for="experience">Your Expierinces</label>
                                  <textarea class="form-control" name="experience" id="experience">@if(!is_null($intresting_jobs)) {{$intresting_jobs->experience}} @endif</textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="min_salary">Min. Salary Expectation</label>
                                      <input type="number" value="@if(!is_null($intresting_jobs)){{$intresting_jobs->min_salary}}@endif" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label for="intresting_courses">Preferable Courses (if You like to follow)</label>
                                      <select name="intresting_courses[]" id="intresting_courses"  class="form-control" multiple>
                                        <option value="">Select Option</option>
                                        @foreach($course_categories as $cc)
                                           <option  @if(!is_null($intresting_jobs)) @if(in_array($cc->id,$intresting_jobs->intresting_courses)) selected @endif @endif value="{{$cc->id}}">{{$cc->course_category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" name="i_jobs_id" value="@if(!is_null($intresting_jobs)){{$intresting_jobs->id}}@endif">
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" value="@if(!is_null($intresting_business)) {{ $intresting_business->intresting_business }} @endif" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help =="Yes") selected @endif  @endif >Yes</option>
                                          <option @if(!is_null($intresting_business)) @if($intresting_business->need_help =="No") selected @endif  @endif>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Finacial") selected @endif  @endif >Finacial</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Material") selected @endif  @endif >Material</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Guidance") selected @endif  @endif >Guidance</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Tempory Training") selected @endif  @endif >Tempory Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Vocational Training") selected @endif  @endif >Vocational Training</option>
                                    <option @if(!is_null($intresting_business)) @if($intresting_business->type_of_help =="Other") selected @endif  @endif >Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <input type="hidden" name="i_business_id" value="@if(!is_null($intresting_business)){{$intresting_business->id}}@endif">
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">1. Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">2. Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">3. Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">4. Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Week Days") selected @endif  @endif>Week Days</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Weekends") selected @endif  @endif>Weekends</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Holiday") selected @endif  @endif>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="common_details_id" value="@if(!is_null($youth_common_details)){{$youth_common_details->id}}@endif">
                                {{csrf_field()}}
                                <input type="hidden" name="youth_id" id="" value="{{$youth->id}}">

                                <button type="button" class="btn btn-primary btn-flat" id="update-no-jobs">Update Changes</button>
                              </form>
                            </div>
                            
                            {{--self Employed--}}
                            
                            <div id="self" @if($youth->current_status!=='Self Employed') style="display: none" @endif>
                              <form id="self_employed">
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" name="title" id="title" class="form-control" value="@if(!is_null($jobs_details) && $jobs_details->nature_job="Self Employed"){{$jobs_details->title}} @endif">
                                </div>
                                <input type="hidden" name="jobs_detials_id"  value="@if(!is_null($jobs_details)){{$jobs_details->id}}@endif">
                                  <input type="hidden" name="nature_job" value="Self Employed">

                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">1. Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->bank_account =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">2. Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->smart_phone =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">3. Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="Yes") selected @endif  @endif>Yes</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->training =="No") selected @endif  @endif>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">4. Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Week Days") selected @endif  @endif>Week Days</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Weekends") selected @endif  @endif>Weekends</option>
                                    <option @if(!is_null($youth_common_details)) @if($youth_common_details->when =="Holiday") selected @endif  @endif>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="common_details_id" value="@if(!is_null($youth_common_details)){{$youth_common_details->id}}@endif">
                                
                                {{csrf_field()}}
                                <input type="hidden" name="youth_id" id="" value="{{$youth->id}}">

                                <button type="button" class="btn btn-primary btn-flat" id="update-self">Update Changes</button>
                              </form>
                            </div>
                            
                          </div>
                      </div>
                    </div>
                  </div>
                  
                </div> 
                
                <!-- /.tab-content -->
                <div class="tab-pane" id="tab_5">
                  <div class="check_mark">
                    <div class="sa-icon sa-success animate">
                      <span class="sa-line sa-tip animateSuccessTip"></span>
                      <span class="sa-line sa-long animateSuccessLong"></span>
                      <div class="sa-placeholder"></div>
                      <div class="sa-fix"></div>
                    </div>
                  </div>
                  <center>
                    <h4>Successfully updated data to database</h4>
                    
                  </center>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>

    </section>
</div>
@endsection
@section('scripts')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});

$('#preloader-wrapper')
    .hide()  // Hide it initially
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    });

</script>
<script type="text/javascript"  src="{{ asset('js/ajax-youth-update.js') }}"></script>
<script>
  $(document).ready(function(){
  // add new course
        $(document).on('click', '#add-course', function(){
          var form = $('#add-courses');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-new-course',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated details ! ', 'Congratulations', {timeOut: 5000});
                      $("#self_employed")[0].reset();
                      $('#add-course-model').modal('hide');
                      //window.load();
                      
                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});
</script>
<style type="text/css" media="screen">
	#autocomplete, #following, #followed, #family {
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
#autocomplete, #following, #followed, #family > li {
  padding: 3px 20px;
}
#autocomplete, #following, #followed, #family > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
.check_mark {
  width: 80px;
  height: 130px;
  margin: 0 auto;
}


.hide{
  display:none;
}

.sa-icon {
  width: 80px;
  height: 80px;
  border: 4px solid gray;
  -webkit-border-radius: 40px;
  border-radius: 40px;
  border-radius: 50%;
  margin: 20px auto;
  padding: 0;
  position: relative;
  box-sizing: content-box;
}

.sa-icon.sa-success {
  border-color: #4CAF50;
}

.sa-icon.sa-success::before, .sa-icon.sa-success::after {
  content: '';
  -webkit-border-radius: 40px;
  border-radius: 40px;
  border-radius: 50%;
  position: absolute;
  width: 60px;
  height: 120px;
  background: white;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}

.sa-icon.sa-success::before {
  -webkit-border-radius: 120px 0 0 120px;
  border-radius: 120px 0 0 120px;
  top: -7px;
  left: -33px;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
  -webkit-transform-origin: 60px 60px;
  transform-origin: 60px 60px;
}

.sa-icon.sa-success::after {
  -webkit-border-radius: 0 120px 120px 0;
  border-radius: 0 120px 120px 0;
  top: -11px;
  left: 30px;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
  -webkit-transform-origin: 0px 60px;
  transform-origin: 0px 60px;
}

.sa-icon.sa-success .sa-placeholder {
  width: 80px;
  height: 80px;
  border: 4px solid rgba(76, 175, 80, .5);
  -webkit-border-radius: 40px;
  border-radius: 40px;
  border-radius: 50%;
  box-sizing: content-box;
  position: absolute;
  left: -4px;
  top: -4px;
  z-index: 2;
}

.sa-icon.sa-success .sa-fix {
  width: 5px;
  height: 90px;
  background-color: white;
  position: absolute;
  left: 28px;
  top: 8px;
  z-index: 1;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
}

.sa-icon.sa-success.animate::after {
  -webkit-animation: rotatePlaceholder 4.25s ease-in;
  animation: rotatePlaceholder 4.25s ease-in;
}

.sa-icon.sa-success {
  border-color: transparent\9;
}
.sa-icon.sa-success .sa-line.sa-tip {
  -ms-transform: rotate(45deg) \9;
}
.sa-icon.sa-success .sa-line.sa-long {
  -ms-transform: rotate(-45deg) \9;
}

.animateSuccessTip {
  -webkit-animation: animateSuccessTip 0.75s;
  animation: animateSuccessTip 0.75s;
}

.animateSuccessLong {
  -webkit-animation: animateSuccessLong 0.75s;
  animation: animateSuccessLong 0.75s;
}

@-webkit-keyframes animateSuccessLong {
  0% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  65% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  84% {
    width: 55px;
    right: 0px;
    top: 35px;
  }
  100% {
    width: 47px;
    right: 8px;
    top: 38px;
  }
}
@-webkit-keyframes animateSuccessTip {
  0% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  54% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  70% {
    width: 50px;
    left: -8px;
    top: 37px;
  }
  84% {
    width: 17px;
    left: 21px;
    top: 48px;
  }
  100% {
    width: 25px;
    left: 14px;
    top: 45px;
  }
}
@keyframes animateSuccessTip {
  0% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  54% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  70% {
    width: 50px;
    left: -8px;
    top: 37px;
  }
  84% {
    width: 17px;
    left: 21px;
    top: 48px;
  }
  100% {
    width: 25px;
    left: 14px;
    top: 45px;
  }
}

@keyframes animateSuccessLong {
  0% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  65% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  84% {
    width: 55px;
    right: 0px;
    top: 35px;
  }
  100% {
    width: 47px;
    right: 8px;
    top: 38px;
  }
}

.sa-icon.sa-success .sa-line {
  height: 5px;
  background-color: #4CAF50;
  display: block;
  border-radius: 2px;
  position: absolute;
  z-index: 2;
}

.sa-icon.sa-success .sa-line.sa-tip {
  width: 25px;
  left: 14px;
  top: 46px;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}

.sa-icon.sa-success .sa-line.sa-long {
  width: 47px;
  right: 8px;
  top: 38px;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
}

@-webkit-keyframes rotatePlaceholder {
  0% {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
  }
  5% {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
  }
  12% {
    transform: rotate(-405deg);
    -webkit-transform: rotate(-405deg);
  }
  100% {
    transform: rotate(-405deg);
    -webkit-transform: rotate(-405deg);
  }
}
@keyframes rotatePlaceholder {
  0% {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
  }
  5% {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
  }
  12% {
    transform: rotate(-405deg);
    -webkit-transform: rotate(-405deg);
  }
  100% {
    transform: rotate(-405deg);
    -webkit-transform: rotate(-405deg);
  }
}

</style>
@endsection

