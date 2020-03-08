@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<br>
  <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-exclamation-triangle"></i> Alert!</h5>
        You have to add more <strong>{{$cg_youths->target - $youths}} </strong> Base Line Applications against your Career Guidance Progress <strong>({{$cg_youths->target }} )</strong> in 2018 and 2019 years. Please Add rest of Baseline applications ASAP.
  </div>
    <section class="content">
	    	<div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Youth Details</h3>
                <ul class="nav nav-pills ml-auto p-2" id="tabs">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Personal Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2">Education</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_7">Language Proficiency </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">Courses</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4">Current Status</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_5">Feedback</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_6">Finish</a></li>
                  
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
                   					<input type="text" id="name" name="name" class="form-control">
                   				</div>
                   				<div class="form-group">
                   					<label for="nic">4. NIC: &nbsp;&nbsp;</label>
                   					<input type="text" id="nic" name="nic" class="form-control">
                   				</div>
                          <div class="form-group">
                            <label for="nic">7. Phone Numbers: &nbsp;&nbsp; <small>(seperete with comma)</small></label>
                            <input type="text" id="phone" name="phone" class="form-control">
                          </div> 
                   				<div class="form-group">
                   					<label for="maritial_status">10. Marital Status &nbsp;&nbsp;</label>
                   					<select name="maritial_status" id="maritial_status" class="form-control">
                   						<option value="">Select Option</option>
                   						<option>Single</option>
                   						<option>Married</option>
                   						<option>Divorced</option>
                   						<option>Seperated</option>
                   						<option>Dependent</option>
                   						<option>Widow</option>
                   					</select>
                   				</div>
                   				

                          <div class="form-group">
                            <label for="branch_id">13. Select Branch &nbsp;&nbsp;</label>
                            <select class="form-control" id="branch_id" name="branch_id">
                                <option value="0">Select a Option </option>
                                @foreach ($branches as $branch) 
                                <option @if(Auth::user()->branch == $branch->id) selected @endif  value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="nic">16. is Youth a BSS beneficiary ? &nbsp;&nbsp;</label>
                            <select name="bss" id="bss" class="form-control">
                              <option value="">Select Option</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                          </div>
	                  		</div>
	                  		<div class="col-md-4">
	                  			<div class="form-group">
                   					<label for="full_name">2. Full Name: &nbsp; &nbsp;</label>
                   					<input type="text" name="full_name" id="full_name" class="form-control">
                   				</div>
                   				<div class="form-group">
                   					<label for="birth_date">5. Birth Date: &nbsp; &nbsp;</label>
                   					<input type="date" name="birth_date" id="birth_date" class="form-control">
                   				</div>
                          <div class="form-group">
                            <label for="birth_date">8. Email Address: &nbsp; &nbsp;</label>
                            <input type="email" name="email" id="email" class="form-control">
                          </div>
                   				<div class="form-group">
                   					<label for="nationality">11. Race: &nbsp;&nbsp;</label>
                   					<select name="nationality" id="nationality" class="form-control">
                   						<option value="">Select Option</option>
                   						<option>Sinhala</option>
                   						<option>Tamil</option>
                   						<option>Muslim</option>
                   						<option>Burger</option>
                   						<option>Other</option>
                   					</select>
                   				</div>
                          <div class="form-group">
                            <label for="disability">14. Are you differtnly abled? &nbsp;&nbsp;</label>
                            <select name="disability" id="disability" class="form-control">
                              <option value="">Select Option</option>
                              <option>Yes</option>
                              <option>No</option>
                            </select>
                          </div>
                   					
	                  		</div>
	                  		<div class="col-md-4">
                   				<div class="form-group">
                   					<label for="gender">3. Gender: &nbsp;&nbsp;</label>
                   					<select name="gender" id="gender" class="form-control">
                   						<option value="">Select Option</option>
                   						<option value="Male">Male</option>
                   						<option value="Female">Female</option>
                   						
                   					</select>
                   				</div>
                   				<div class="form-group">
                   					<label for="gender">6. Driving Licence &nbsp;&nbsp;</label>
                   					<select name="driving_licence" id="driving_licence" class="form-control">
                   						<option value="">Select Option</option>
                   						<option>No Licence</option>
                   						<option>A1,A,D</option>
                   						<option>B1,E,F</option>
                   						<option>B,C,C1</option>
                   						<option>C1,B1</option>
                   						<option>C,B</option>
                   						<option>CE,B</option>
                   						<option>D1,A1</option>
                   						<option>D,A</option>
                   						<option>DE</option>
                   						<option>G1</option>
                   						<option>G</option>
                   						<option>J</option>
                   						
                   					</select>
                   				</div>
                   				<div class="form-group">
			          				<label for="highest_qualification">9. Highest Educational Qualification:</label>
			          				<select name="highest_qualification" id="highest_qualification" class="form-control">
			          					<option value="">Select Option</option>
			          					<option>Ordinary Level</option>
			          					<option>Advanced Level</option>
			          					<option>Certificate</option>
			          					<option>Diploma</option>
			          					<option>Higher Diploma</option>
			          					<option>Degree</option>
			          					<option>Masters</option>
			          					<option>Doctorate</option>
			          					<option>Skilled Apprentice</option>
			          				</select>
		          				</div>
		          				<div class="form-group">

									     <label for="family_id">12. Select Family</label>
										      
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Add family details before search and select. Click on add button" type="text" id="fam_id" name="fam_id" class="form-control" placeholder="Enter Name of Household">
                        <div style="cursor: pointer" onclick="window.open('{{Route('youth/family/add')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add family to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="familyList"></div>
                          <input type="hidden" id="family_id" name="family_id" value="">
								      </div>
                      <div class="form-group">
                            <label for="reason">15. if Yes Explian</label>
                            <textarea class="form-control" id="reason" placeholder="optional" name="reason"></textarea>
                          </div>
	                  	</div>
	                  	</div>	
                      <input type="hidden" id="user_id" name="user_id" value="{{Auth::id()}}">
                      
                   
                   		<button type="button" id="personal_info" class="btn btn-success btn-flat">Next &nbsp;&nbsp;<i class="fas fa-forward"></i></button>
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
                                <input class="form-control" maxlength="4" type="number" name="ol_year" id="ol_year">
                              </div> 
                              <div class="form-group">
                                <label for="ol_attempt">O\L Attempt</label>
                                <input class="form-control" maxlength="2" step="1" type="number" name="ol_attempt" id="ol_attempt">
                              </div> 
                              <div class="form-group">
                                <label for="ol_pass_or_fail">O\L pass or fail ?</label>
                                  <select class="form-control" name="ol_pass_or_fail">
                                    <option value="">Select Option</option>
                                    <option>Pass</option>
                                    <option>Fail</option>
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
                                <input class="form-control" maxlength="4" type="number" name="al_year" id="al_year">
                                </div> 
                                <div class="form-group">
                                  <label for="al_attempt">A\L Attempt</label>
                                  <input class="form-control" maxlength="2" step="1" type="number" name="al_attempt" id="al_attempt">
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for="al_pass_or_fail">A\L pass or fail ?</label>
                                        <select class="form-control" name="al_pass_or_fail" id="al_pass_or_fail">
                                          <option value="">Select Option</option>
                                          <option>Pass</option>
                                          <option>Fail</option>
                                        </select>
                                    </div>
                                   </div>
                                   <div class="col-sm-6">
                                     <div class="form-group">
                                      <label for="stream">Stream</label>
                                      <select class="form-control" name="stream" id="stream">
                                        <option value="">Select Option</option>
                                        <option>Commerce</option>
                                        <option>Art</option>
                                        <option>Maths</option>
                                        <option>Science</option>
                                        <option>Technology</option>
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
                                    <input type="text" name="degree" id="degree" class="form-control">
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="pass_out_year">Pass out Year</label>
                                      <input type="number" name="pass_out_year" id="pass_out_year" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                     
                                    <div class="form-group">
                                        <label for="medium">Medium</label>
                                        <input type="text" name="medium" id="medium" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" name="grade" id="grade" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="university">University</label>
                                    <input type="text"  name="university" id="university" class="form-control">
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
                                    <textarea class="form-control" id="other_professional_qualifications" name="other_professional_qualifications"></textarea>
                                </div>
                                 
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      {{ csrf_field() }}
                      
                          <input type="hidden" id="youth_id" name="youth_id" value="">
                      <div class="form-group">
                        <button type="button" id="add-education" class="btn btn-success btn-flat">Next &nbsp;&nbsp;<i class="fas fa-forward"></i></button>
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
                                    <input type="checkbox" name="reading_tamil">  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="reading_sinhala">  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="reading_english">  
                                  
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
                                    <input type="checkbox" name="speaking_tamil">  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="speaking_sinhala">  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="speaking_english">  
                                  
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
                                    <input type="checkbox" name="writing_tamil">  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="writing_sinhala">  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" name="writing_english">  
                                  
                                </a>
                              </li>
                              <li class="nav-item text-right">
                                <br>  
                                {{csrf_field()}}
                                  <button type="button" id="add-language" class="btn btn-success btn-flat text-right">Submit</button>   
                               
                              </li>
                            </ul>
                          </div>
                      </div>
                      <input type="hidden" name="youth_id" id="language_youth_id" value="">
                    </form>
                  </div>
                  <div class="tab-pane" id="tab_3">
                    
                        <div class="card card-success">
                              <div class="card-header">
                                <h3 class="card-title">Followed Courses Detials</h3>
                              </div>
                                
                              <div class="card-body">
                                <form action="" id="courses">
                                <div  class="row">
                                <div  class="col-md-4">
                                  <div class="form-group">
                                    <label for="ol_year">Course</label>
                                      <div class="input-group">
                                      <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Search Course">
                                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                        <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                        </div>  
                                      </div>
                                  <div id="courseList"></div>
                                  <input class="form-control" type="hidden" name="course_id" id="course_id">
                                  </div>                               
                              </div>
                              <input type="hidden" name="status" id="status" value="Followed">
                              <div  class="col-md-4 form-group">
                                <label>is supported by Berendina ?</label>

                                <select name="provided_by_bec" class="form-control">
                                  <option value="">Select Option</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                  
                                </select>
                              </div>

                              <div  class="col-md-4">
                                <div class="form-group">
                                <label for="completed_at">Completed Date <small class="text-muted">(Approximate)</small></label>
                                <input type="date" name="completed_at" id="completed_at" class="form-control">
                              </div>
                              </div>
                            
                        </div>
                        {{ csrf_field() }}
                          <input type="hidden" id="youth_id_2" name="youth_id" value="">

                        <button type="button" class="btn btn-success btn-flat" id="add-course"><i class="fas fa-plus"></i> &nbsp;&nbsp;Add Course </button>
                        <button type="button" id="next" class="btn btn-primary btn-flat">Next &nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                        </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
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
                              <input type="hidden" name="id" id="youth_id_3" value="">
                              <select name="current_status" id="current_status" class="form-control">
                                <option value="">Select Option</option>
                                <option >Permanent Job After Vocational/Prof Training</option>
                                <option >Permanent Job without Vocational/Prof Training</option>
                                <option >Temporary Job After Vocational/Prof Training</option>
                                <option >Temporary Job without Vocational/Prof Training</option>
                                <option >Following a course</option>
                                <option >Self Employed</option>
                                <option >No Job</option>
                                
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
                            <div id="job" style="display:none">
                              <form id="jobs">
                                <div class="form-group">
                                  <label for="title">Job Title</label>
                                  <input type="text" name="title" id="title" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="employer_name">Employer Name</label>
                                  <input type="text" name="employer_name" id="employer_name" class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="need_help">Do you have a proper career plan ?</label>
                                        <select name="career_plan" id="career_plan" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                        <label for="need_help">Have you taken any step on it ?</label>
                                        <select name="step_forward" id="step_forward" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                    <label>What are the steps you have taken ?</label>
                                    
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                  </div>
                                {{csrf_field()}}
                                <input type="hidden" name="youth_id" id="youth_id_4" value="">
                                <input type="hidden" name="nature_job" value="Permanat Job">
                                <button type="button" class="btn btn-primary btn-flat" id="add-jobs">Save Data</button>
                              </form>
                            </div>
                            <div id="temp_job" style="display:none">
                              <form id="temp_jobs">
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="industry">Preferable Industry</label>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        <option value="">Not Mentioned</option>
                                        <option>Agriculture &amp; Food Processing</option>
                                        <option>Automobiles</option>
                                        <option>Banking &amp; Financial Services</option>
                                        <option>BPO or KPO </option>
                                        <option>Civil &amp; Construction</option>
                                        <option>Consumer Goods &amp; Durables</option>
                                        <option>Consulting</option>
                                        <option>Education</option>
                                        <option>Engineering</option>
                                        <option>Ecommerce &amp; Internet</option>
                                        <option>Events &amp; Entertainment</option>
                                        <option>Export &amp; Import</option>
                                        <option>Government &amp; Public Sector</option>
                                        <option>Healthcare</option>
                                        <option>Hotel, Travel &amp; Leisure</option>
                                        <option>Insurance</option>
                                        <option>IT &amp; Telecom</option>
                                        <option>Logistics &amp; Transportation</option>
                                        <option>Manufacturing</option>
                                        <option>Manpower &amp; Security</option>
                                        <option>News &amp; Media</option>
                                        <option>NGO &amp; Non profit</option>
                                        <option>Pharmaceutical</option>
                                        <option>Real Estate</option>
                                        <option>Wholesale &amp; Retail</option>
                                        <option>Others</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="location">Preferable Location</label>
                                      <select name="location[]" id="location" multiple class="form-control">
                                        <option value="">Not Mentioned</option>
                                        <option>Home District</option>
                                        <option>Home Province</option>
                                        <option>Other City</option>
                                        <option>Colombo</option>
                                        <option>Industrial Zone</option>
                                        <option>Abroad</option>   
                                      </select>
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <label for="experience">Your Expierinces</label>
                                  <textarea class="form-control" name="experience" id="experience"></textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="min_salary">Min. Salary Expectation</label>
                                      <input type="number" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label for="intresting_courses">Preferable Courses (if You like to follow)</label>
                                      <select name="intresting_courses[]" id="intresting_courses"  class="form-control" multiple>
                                        <option value="">Not Mentioned</option>
                                        @foreach($course_categories as $cc)
                                           <option value="{{$cc->id}}">{{$cc->course_category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option>Yes</option>
                                          <option>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Finacial</option>
                                    <option>Material</option>
                                    <option>Guidance</option>
                                    <option>Tempory Training</option>
                                    <option>Vocational Training</option>
                                    <option>Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Week Days</option>
                                    <option>Weekends</option>
                                    <option>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            
                                {{csrf_field()}}

                                <input type="hidden" name="youth_id" id="youth_id_5" value="">
                                <button type="button" class="btn btn-primary btn-flat" id="add-tempory">Save Data</button>
                              </form>
                            </div>
                            {{--VT courses--}}
                            <div id="vt_course" style="display:none">
                              <form id="vt_courses">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ol_year">Course</label>
                                      <div class="input-group">
                                      <input class="form-control" type="text" name="course_name2" id="course_name2" placeholder="Search Course">
                                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                        <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                        </div>  
                                      </div>
                                  <div id="courseList2"></div>
                                  <input class="form-control" type="hidden" name="course_id" id="course_id2">
                                  </div>
                                  <input type="hidden" name="status" id="status" value="Following">
                                  <div  class="col-md-6">
                                    <div class="form-group">
                                    <label for="completed_at">Completed date</label>
                                    <input type="date" name="completed_at" id="completed_at" class="form-control">
                                  </div>
                                  </div>

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
                                      <select name="location[]" id="location" multiple class="form-control">
                                        <option value="">Not Mentioned</option>
                                        <option>Home District</option>
                                        <option>Home Province</option>
                                        <option>Other City</option>
                                        <option>Colombo</option>
                                        <option>Industrial Zone</option>
                                        <option>Abroad</option>   
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="industry">2. Preferable Industry</label>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        <option value="">Not Mentioned</option>
                                        <option>Agriculture &amp; Food Processing</option>
                                        <option>Automobiles</option>
                                        <option>Banking &amp; Financial Services</option>
                                        <option>BPO or KPO </option>
                                        <option>Civil &amp; Construction</option>
                                        <option>Consumer Goods &amp; Durables</option>
                                        <option>Consulting</option>
                                        <option>Education</option>
                                        <option>Engineering</option>
                                        <option>Ecommerce &amp; Internet</option>
                                        <option>Events &amp; Entertainment</option>
                                        <option>Export &amp; Import</option>
                                        <option>Government &amp; Public Sector</option>
                                        <option>Healthcare</option>
                                        <option>Hotel, Travel &amp; Leisure</option>
                                        <option>Insurance</option>
                                        <option>IT &amp; Telecom</option>
                                        <option>Logistics &amp; Transportation</option>
                                        <option>Manufacturing</option>
                                        <option>Manpower &amp; Security</option>
                                        <option>News &amp; Media</option>
                                        <option>NGO &amp; Non profit</option>
                                        <option>Pharmaceutical</option>
                                        <option>Real Estate</option>
                                        <option>Wholesale &amp; Retail</option>
                                        <option>Others</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="profession_adequate">3. Is the course you are currently pursuing in such a profession adequate ?</label>
                                        <select name="profession_adequate" id="profession_adequate" class="form-control">
                                              <option value="">Select Option</option>
                                              <option>Yes</option>
                                              <option>No</option>
                                              <option>No Idea</option>
                                    </select>
                                  </div>
                                  </div>
                                   <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="plan_to_meet_qualifications">4. If No, Do you have any plan to meet the qualifications?</label>
                                        <select name="plan_to_meet_qualifications" id="plan_to_meet_qualifications" class="form-control">
                                              <option value="">Select Option</option>
                                              <option>Yes</option>
                                              <option>No</option>
                                    </select>
                                  </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="details">5. If yes, Explain in detail</label>
                                  <textarea class="form-control" name="details" id="details"></textarea>
                                </div>

                                <div class="form-group">
                                  <label for="experience">6. Your Experiences</label>
                                  <textarea class="form-control" name="experience" id="experience"></textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="min_salary">7. Min. Salary Expectation</label>
                                      <input type="number" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    
                                  </div>
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option>Yes</option>
                                          <option>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Finacial</option>
                                    <option>Material</option>
                                    <option>Guidance</option>
                                    <option>Tempory Training</option>
                                    <option>Vocational Training</option>
                                    <option>Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Week Days</option>
                                    <option>Weekends</option>
                                    <option>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="youth_id" id="youth_id_6" value="">
                                {{csrf_field()}}
                                <button type="button" class="btn btn-primary btn-flat" id="add-following-course">Save Data</button>
                              </form>
                            </div>

                            {{--No Job--}}
                            <div id="no_job" style="display:none">
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
                                      <label for="industry">Preferable Industry</label>
                                      <select id="industry" name="industry[]" class="form-control" multiple>
                                        <option value="">Not Mentioned</option>
                                        <option>Agriculture &amp; Food Processing</option>
                                        <option>Automobiles</option>
                                        <option>Banking &amp; Financial Services</option>
                                        <option>BPO or KPO </option>
                                        <option>Civil &amp; Construction</option>
                                        <option>Consumer Goods &amp; Durables</option>
                                        <option>Consulting</option>
                                        <option>Education</option>
                                        <option>Engineering</option>
                                        <option>Ecommerce &amp; Internet</option>
                                        <option>Events &amp; Entertainment</option>
                                        <option>Export &amp; Import</option>
                                        <option>Government &amp; Public Sector</option>
                                        <option>Healthcare</option>
                                        <option>Hotel, Travel &amp; Leisure</option>
                                        <option>Insurance</option>
                                        <option>IT &amp; Telecom</option>
                                        <option>Logistics &amp; Transportation</option>
                                        <option>Manufacturing</option>
                                        <option>Manpower &amp; Security</option>
                                        <option>News &amp; Media</option>
                                        <option>NGO &amp; Non profit</option>
                                        <option>Pharmaceutical</option>
                                        <option>Real Estate</option>
                                        <option>Wholesale &amp; Retail</option>
                                        <option>Others</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="location">Preferable Location</label>
                                      <select name="location[]" id="location" multiple class="form-control">
                                        <option value="">Not Mentioned</option>
                                        <option>Home District</option>
                                        <option>Home Province</option>
                                        <option>Other City</option>
                                        <option>Colombo</option>
                                        <option>Industrial Zone</option>
                                        <option>Abroad</option>   
                                      </select>
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <label for="experience">Your Expierinces</label>
                                  <textarea class="form-control" name="experience" id="experience"></textarea>
                                </div>
                                
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="min_salary">Min. Salary Expectation</label>
                                      <input type="number" step="10000" name="min_salary" id="min_salary" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label for="intresting_courses">Preferable Courses (if You like to follow)</label>
                                      <select name="intresting_courses[]" id="intresting_courses"  class="form-control" multiple>
                                        
                                        @foreach($course_categories as $cc)
                                           <option value="{{$cc->id}}">{{$cc->course_category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Preferable Business
                                  </span>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" name="intresting_business" id="intresting_business" class="form-control">
                                </div>
                                <div  class="row" >
                                    <div  class="col-md-6">
                                      <div class="form-group">
                                        <label for="need_help">Do you expect a support ?</label>
                                        <select name="need_help" id="need_help" class="form-control">
                                          <option value="">Select Option</option>
                                          <option>Yes</option>
                                          <option>No</option>
                                        </select>
                                      </div>
                                    </div>
                                <div class="col-md-6">     
                                <div class="form-group">
                                  <label for="type_of_help">What type of Support</label>
                                  <select name="type_of_help" id="type_of_help" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Finacial</option>
                                    <option>Material</option>
                                    <option>Guidance</option>
                                    <option>Tempory Training</option>
                                    <option>Vocational Training</option>
                                    <option>Other</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Week Days</option>
                                    <option>Weekends</option>
                                    <option>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="youth_id" id="youth_id_7" value="">
                                {{csrf_field()}}

                                <button type="button" class="btn btn-primary btn-flat" id="add-no-jobs">Save Data</button>
                              </form>
                            </div>

                            {{--self Employed--}}
                            <div id="self" style="display:none">
                              <form id="self_employed">
                                <div class="form-group">
                                  <label for="intresting_business">Nature of business</label>
                                  <input type="text" name="title" id="title" class="form-control">
                                  <input type="hidden" name="nature_job" value="Self Employed">
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                                    Common Questions
                                  </span>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="bank_account">Do you have an account created by a reputed bank ?</label>
                                  <select name="bank_account" id="bank_account" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="smart_phone">Do You have a Smart Phone ?</label>
                                  <select name="smart_phone" id="smart_phone" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="training">Do You like to participate to a Smart Phone training ?</label>
                                  <select name="training" id="training" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="when">Then When ?</label>
                                  <select name="when" id="when" class="form-control">
                                    <option value="">Select Option</option>
                                    <option>Week Days</option>
                                    <option>Weekends</option>
                                    <option>Holiday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <input type="hidden" name="youth_id" id="youth_id_8" value="">
                                
                                {{csrf_field()}}

                                <button type="button" class="btn btn-primary btn-flat" id="add-self">Save Data</button>
                              </form>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="tab-pane" id="tab_5">
                  <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Feedback</h3>
                      </div>
                                
                      <div class="card-body">
                        <form id="feedbacks">
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="like_to_feedback">Do you like to give further feedbacks ?</label>
                                <select name="like_to_feedback" id="like_to_feedback" class="form-control">
                                  <option value="">Select Option</option>
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="like_to_feedback">How do u like to give feedbacks ?</label>
                                <select name="how_to_feedback[]" id="how_to_feedback" class="form-control" multiple size="5">
                                  <option>Phone</option>
                                  <option>Online</option>
                                  <option>SMS</option>
                                  <option>Letter</option>
                                  <option>Face to Face</option>
                                </select>
                              </div>
                          </div>

                        </div>
                        <p>Note : Your Informations can be viewed by employers and other parties without your contact details</p>
                         
                          <input type="hidden" name="youth_id" id="youth_id_9" value="">
                                {{csrf_field()}}
                          
                          <button type="button" class="btn btn-primary btn-flat" id="add-feedback">Agreed and Finish </button>
                          </form>
                      </div>
                    </div>
                  </div> 
                <div class="tab-pane" id="tab_6">
                  <div class="check_mark">
                    <div class="sa-icon sa-success animate">
                      <span class="sa-line sa-tip animateSuccessTip"></span>
                      <span class="sa-line sa-long animateSuccessLong"></span>
                      <div class="sa-placeholder"></div>
                      <div class="sa-fix"></div>
                    </div>
                  </div>
                  <center>
                    <h4>Successfully added data to database</h4>
                    <a href="{{Route('youth/add')}}" title=""><button type="button" class="btn btn-success btn-flat">Add Another</button></a>
                  </center>
                </div> 
                <!-- /.tab-content -->
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
	$(document).ready(function(){
//serahc course id
			 $('#course_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/courseList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#courseList').fadeIn();  
			           $('#courseList').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#followed li', function(){  
			    	$('#courseList').fadeOut(); 
			        $('#course_name').val($(this).text()); 
			        var course_id = $(this).attr('id');
			        $('#course_id').val(course_id);
			         
			    });  
		});

$(document).ready(function(){
  // add youth personal data to database
        $(document).on('click', '#personal_info', function(){
          var form = $('#youth');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-personal',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull Added Personal Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#youth")[0].reset(); 
                      $('#tabs a[href="#tab_2"]').tab('show');
                      $('#tabs a[href="#tab_2"]').attr("data-toggle", "tab");
                      $('#youth_id').val(data.youth_id);
                      $('#tabs a[href="#tab_1"]').removeAttr("data-toggle", "tab");

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


      function printValidationErrors(msg){
        $.each(msg, function(key,value){
          toastr.error('Validation Error !', ""+value+"");
        });
      }

$(document).ready(function(){
  // add youth education data to database
        $(document).on('click', '#add-education', function(){
          var form = $('#education');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/result/add-education',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull Added Education Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#education")[0].reset(); 
                      $('#tabs a[href="#tab_7"]').tab('show');
                      $('#tabs a[href="#tab_7"]').attr("data-toggle", "tab");
                      $('#youth_id_2').val(data.youth_id);
                      $('#youth_id_3').val(data.youth_id);
                      $('#youth_id_4').val(data.youth_id);
                      $('#youth_id_5').val(data.youth_id);
                      $('#youth_id_6').val(data.youth_id);
                      $('#youth_id_7').val(data.youth_id);
                      $('#youth_id_8').val(data.youth_id);
                      $('#language_youth_id').val(data.youth_id);
                      $('#youth_id_9').val(data.youth_id);
                      $('#tabs a[href="#tab_2"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add youth education data to database
        $(document).on('click', '#add-language', function(){
          var form = $('#language');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-language',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull Added Language Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#language")[0].reset(); 
                      $('#tabs a[href="#tab_3"]').tab('show');
                      $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");
                      $('#tabs a[href="#tab_7"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add youth courses data to database
        $(document).on('click', '#add-course', function(){
          var form = $('#courses');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/result/add-course',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added course and you can add more ! ', 'Congratulations', {timeOut: 5000});
                      $("#courses")[0].reset();   
                      $( "#course_name" ).focus();

                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  toastr.error('You cannot add same course twice! ', 'Error !', {timeOut: 5000});
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add permantat jobs data to database
        $(document).on('click', '#add-jobs', function(){
          var form = $('#jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-jobs',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#jobs")[0].reset();
                      $('#tabs a[href="#tab_6"]').tab('show');
                      $('#tabs a[href="#tab_6"]').attr("data-toggle", "tab");   
                      $('#tabs a[href="#tab_5"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add temp_jobs  data to database
        $(document).on('click', '#add-tempory', function(){
          var form = $('#temp_jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-tempory',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#temp_jobs")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $('#tabs a[href="#tab_4"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add following courses  data to database
        $(document).on('click', '#add-following-course', function(){
          var form = $('#vt_courses');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-following-course',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#vt_courses")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab");  
                      $('#tabs a[href="#tab_4"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add no Jobs  data to database
        $(document).on('click', '#add-no-jobs', function(){
          var form = $('#no_jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-no-jobs',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#no_jobs")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab");
                      $('#tabs a[href="#tab_4"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add Self Employed  data to database
        $(document).on('click', '#add-self', function(){
          var form = $('#self_employed');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-self',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#self_employed")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $('#tabs a[href="#tab_4"]').removeAttr("data-toggle", "tab");


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

$(document).ready(function(){
  // add feedback  data to database
        $(document).on('click', '#add-feedback', function(){
          var form = $('#feedbacks');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/add-feedback',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Thank You', {timeOut: 5000});
                      $("#feedbacks")[0].reset();
                      $('#tabs a[href="#tab_6"]').tab('show');
                      $('#tabs a[href="#tab_6"]').attr("data-toggle", "tab"); 
                      $('#tabs a[href="#tab_5"]').removeAttr("data-toggle", "tab");
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);


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
$(document).ready(function(){
    $(document).on('click' , '#next', function(){
        
        if($('#course_name').val()==""){
            $('#tabs a[href="#tab_4"]').tab('show');
            $('#tabs a[href="#tab_4"]').attr("data-toggle", "tab");
            $('#tabs a[href="#tab_3"]').removeAttr("data-toggle", "tab");
        }

        else{
          
          toastr.error('Something Error !', 'Please Add course before going to next!');

        }
        

    });
});
  $(document).ready(function(){
//serahc family id
       $('#fam_id').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/familyList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){ 
                 $('#familyList').fadeIn();  
                 $('#familyList').html(data);
                }
               });
              }
          });

          $(document).on('click', '#family li', function(){  
            $('#familyList').fadeOut(); 
              $('#fam_id').val($(this).text()); 
              var family_id = $(this).attr('id');
              $('#family_id').val(family_id);
               
          });  
    });
$(document).ready(function(){
  $(document).on('change' , '#current_status', function (){
    var id = $('#youth_id_3').val();
    var current_status = $(this).children("option:selected").val();
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/youth/changeStatus',
                  
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'current_status': current_status
            
        },
        cache: false,          
        success: function(data) {
        load_status_data(current_status);              
        toastr.success('Status Succesfully Changed ! ', 'Congratulations', {timeOut: 5000});
                  
        },

        error: function (jqXHR, exception) {    
            console.log(jqXHR);
            toastr.error('Something Error !', 'Status not Changed!');
            
        },
    });
});
});

function load_status_data(current_status){
  if(current_status=="Permanent Job After Vocational/Prof Training"){
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#job').show();

  }

  if(current_status=="Permanent Job without Vocational/Prof Training"){
      $('#temp_job').hide();
      $('#vt_course').hide();
      $('#no_job').hide();
      $('#self').hide();
      $('#job').show();

    }

  if(current_status=="Temporary Job After Vocational/Prof Training"){
    $('#job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#temp_job').show();
  }

  if(current_status=="Temporary Job without Vocational/Prof Training"){
    $('#job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#temp_job').show();
  }

  if(current_status=="Following a course"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#vt_course').show();
  }

  if(current_status=="Self Employed"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').show();
  }

  if(current_status=="No Job"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#self').hide();
    $('#no_job').show();

  }
}

$(document).ready(function(){
//serahc course id
       $('#course_name2').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/courseList1',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#courseList2').fadeIn();  
                 $('#courseList2').html(data);
                }
               });
              }
          });

          $(document).on('click', '#following li', function(){  
            $('#courseList2').fadeOut(); 
              $('#course_name2').val($(this).text()); 
              var course_id = $(this).attr('id');
              $('#course_id2').val(course_id);
               
          });  
    });
$(document).ready(function () {
        var today = new Date();
        var day=today.getDate()>9?today.getDate():"0"+today.getDate(); // format should be "DD" not "D" e.g 09
        var month=(today.getMonth()+1)>9?(today.getMonth()+1):"0"+(today.getMonth()+1);
        var year=today.getFullYear();

        $("#completed_at").attr('max', year + "-" + month + "-" + day);
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

