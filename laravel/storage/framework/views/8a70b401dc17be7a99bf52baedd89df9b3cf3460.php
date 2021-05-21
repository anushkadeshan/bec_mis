
<?php $__env->startSection('title','View Youth Profile |'); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Youth Profile  </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">User Profile </li>
          <li class="breadcrumb-item active"><font class="badge badge-primary"><?php echo e(request()->route('id')); ?></font> </li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
              src="<?php if($youth->gender=="Female"): ?><?php echo e(URL::asset('images/young.png')); ?><?php else: ?> <?php echo e(URL::asset('images/male.jpg')); ?> <?php endif; ?>"
              alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo e($youth->name); ?> <?php if($youth->bss==1): ?> <span  class="badge badge-success">BSS</span> <?php endif; ?> </h3> 
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('follow-youth')): ?>
            <button class="btn btn-success btn-block" id="select-youth" data-id="<?php echo e($youth->id); ?>">Select This Youth to hire &nbsp;&nbsp;&nbsp;&nbsp;<i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button> 
            <?php endif; ?>
            <p class="text-muted text-center"><?php if(!is_null($jobs_details)): ?><?php echo e($jobs_details->title); ?><?php endif; ?></p>
            
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Full Name</b> <a class="float-right"><?php echo e($youth->full_name); ?></a>
              </li>
              <li class="list-group-item">
                <b>Gender</b> <a class="float-right"><?php echo e($youth->gender); ?></a>
              </li>
              <?php 
              $dateOfBirth = $youth->birth_date;
              $today = date("Y-m-d");
              $diff = date_diff(date_create($dateOfBirth), date_create($today));
              
              ?>
              <li class="list-group-item">
                <b>Birth Date</b> <a class="float-right"><?php echo e($youth->birth_date); ?> <font class="badge badge-primary">Age is <?php echo e($diff->format('%y')); ?></font></a>
              </li>
              <li class="list-group-item">
                <b>Maritial Status</b> <a class="float-right"><?php echo e($youth->maritial_status); ?></a>
              </li>
              <li class="list-group-item">
                <b>Driving Licence</b> <a class="float-right"><?php echo e($youth->driving_licence); ?></a>
              </li>
              <li class="list-group-item">
                <b>Race</b> <a class="float-right"><?php echo e($youth->nationality); ?></a>
              </li>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-youth-contacts')): ?>
              
              <li class="list-group-item">
                <b>Contacts</b> <a class="float-right"><?php echo e($youth->phone); ?></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?php echo e($youth->email); ?></a>
              </li>
              <li class="list-group-item">
                <b>Address</b> <a class="float-right"><?php echo e($youth->family->address); ?></a>
              </li>
              <li class="list-group-item">
                <b>DS Division</b> <a class="float-right"><?php echo e($youth->DSD_Name); ?></a>
              </li>
              <li class="list-group-item">
                <b>GN Division</b> <a class="float-right"><?php echo e($youth->GN_Office); ?></a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fa fa-book mr-1"></i> Highest Education Level</strong>

            <p class="text-muted"><?php echo e($youth->highest_qualification); ?></p>
            <hr>
            <strong><i class="fa fa-book mr-1"></i>Other Education</strong>

            <p class="text-muted">
              <ul class="list-group list-group-unbordered mb-3">
                <?php if(!is_null($results)): ?>
                <li class="list-group-item text-muted">
                 <?php echo e($results->degree); ?> at <?php echo e($results->university); ?>

               </li>
               <?php endif; ?>
               <?php if(!is_null($results)): ?>
               <li class="list-group-item text-muted">
                 <?php echo e($results->other_professional_qualifications); ?>

               </li>
               <?php endif; ?>

               <?php if(!is_null($followed_courses)): ?>
               <?php $__currentLoopData = $followed_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li class="list-group-item text-muted">
                 Followed <?php echo e($fc->course_name); ?> Course in <?php echo e($fc->institute_name); ?>

               </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
               <?php if(!is_null($following_course)): ?>
               <li class="list-group-item text-muted">
                 Following <?php echo e($following_course->course_name); ?> Course in <?php echo e($following_course->institute_name); ?>

               </li>
               <?php endif; ?>

             </ul>
           </p>

           <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

           <p class="text-muted">
             <?php if(!is_null($youth->family)): ?>
             <?php echo e($youth->family->district); ?>

             <?php endif; ?>
           </p>

           <hr>


           <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

           <p class="text-muted">
             <?php if($youth->disability=="Yes"): ?> I'm a differntly abled person.
             <?php endif; ?>
           </p>
         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
     </div>
     <!-- /.col -->
     <div class="col-md-8">
      <div class="card card-success card-outline">
        <div class="card-header p-2">
          <ul class="nav nav-pills">    
            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Family Details </a></li>
            <li class="nav-item"><a class="nav-link " href="#tab_2" data-toggle="tab">Intresting Things</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Language Proficiency </a></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-M&E-reports')): ?>  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">BEC Program Status </a></li><?php endif; ?>
            
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
         <div class="tab-content">
          
          <div class="tab-pane active" id="tab_1">
            <?php if(Auth::user()->can('view-youth-contacts')): ?>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Head of Household : </strong><span><?php echo e($youth->family->head_of_household); ?></span></li>
              <li class="list-group-item"><strong>NIC of Head of Household : </strong><span><?php echo e($youth->family->nic_head_of_household); ?></span></li>

              <li class="list-group-item"><strong>Family Type : </strong><span><?php echo e($youth->family->family_type); ?></span></li>

              <li class="list-group-item"><strong>Total Income : </strong><span><?php echo e(number_format($youth->family->total_income,2)); ?></span></li>
              <li class="list-group-item"><strong>Total Family Members : </strong><span><?php echo e($youth->family->total_members); ?></span></li>
              <li class="list-group-item"><strong>PCI : </strong><span><?php if(!is_null($youth->family->total_members)): ?>
                <?php
                $pci = $youth->family->total_income / $youth->family->total_members
                ?>
                <?php echo e(number_format($pci,2)); ?>

              <?php endif; ?></span></li>
            </ul>
            <?php else: ?>
            Content is not allowed
            <?php endif; ?>
          </div>
          
          <div class="tab-pane" id="tab_2">
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
               <i class="fa fa-hotel bg-primary"></i>
               <div class="timeline-item">
                
                <h3 class="timeline-header">Intresting Job Industries</h3>

                <div class="timeline-body text-muted">
                  <?php if(!is_null($intresting_jobs)): ?>
                  <?php echo e(implode(', ', $intresting_jobs->industry)); ?>	
                  <?php endif; ?>
                </div>
                
              </div>
            </li>
          </ul>

          <ul class="timeline timeline-inverse">
            <!-- timeline time label -->
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
             <i class="fa fa-globe bg-primary"></i>

             <div class="timeline-item">
              
              <h3 class="timeline-header">Intresting Job Locations</h3>

              <div class="timeline-body text-muted">
                <?php if(!is_null($intresting_jobs)): ?>
                <?php echo e(implode(', ', $intresting_jobs->location)); ?>	
                
                <?php endif; ?>
              </div>
              
            </div>
          </li>
        </ul>
        <ul class="timeline timeline-inverse">
          <!-- timeline time label -->
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
           <i class="fa fa-graduation-cap bg-primary"></i>
           <div class="timeline-item">
            
            <h3 class="timeline-header">Intresting Courses Catogeries</h3>

            <div class="timeline-body text-muted">
             <?php if(!is_null($intresting_courses)): ?>
             <?php $__currentLoopData = $intresting_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php echo e($courses->course_category); ?> , 	
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>
           </div>
           
         </div>
       </li>
     </ul>
     <ul class="timeline timeline-inverse">
      <!-- timeline time label -->
      <!-- /.timeline-label -->
      <!-- timeline item -->
      <li>
       <i class="fa fa-award bg-primary"></i>
       <div class="timeline-item">
        
        <h3 class="timeline-header">Intresting Self Businesses</h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($intresting_business)): ?>
          <?php echo e($intresting_business->intresting_business); ?>	
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>
</div>
<div class="tab-pane" id="tab_3">
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
            <input type="checkbox" readonly name="reading_tamil" <?php if(!is_null($language)): ?><?php if($language->reading_tamil): ?> checked <?php endif; ?> <?php endif; ?>>  

          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="reading_sinhala" <?php if(!is_null($language)): ?><?php if($language->reading_sinhala): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="reading_english" <?php if(!is_null($language)): ?><?php if($language->reading_english): ?> checked <?php endif; ?> <?php endif; ?>>  
            
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
            <input type="checkbox" readonly name="speaking_tamil" <?php if(!is_null($language)): ?><?php if($language->speaking_tamil): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="speaking_sinhala" <?php if(!is_null($language)): ?><?php if($language->speaking_sinhala): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="speaking_english" <?php if(!is_null($language)): ?><?php if($language->speaking_english): ?> checked <?php endif; ?> <?php endif; ?>>  
            
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
            <input type="checkbox" readonly name="writing_tamil" <?php if(!is_null($language)): ?><?php if($language->writing_tamil): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="writing_sinhala" <?php if(!is_null($language)): ?><?php if($language->writing_sinhala): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <input type="checkbox" readonly name="writing_english" <?php if(!is_null($language)): ?><?php if($language->writing_english): ?> checked <?php endif; ?> <?php endif; ?>>  
            
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-M&E-reports')): ?>
<div class="tab-pane" id="tab_4">
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($cg)): ?> <i class="fa fa-hotel bg-default"></i> <?php else: ?> <i class="fa fa-hotel bg-success"></i><?php endif; ?>
      <div class="timeline-item">
        
        <h3 class="timeline-header">Career Guidance <span  style="float: right" class="text-success"><?php if(!is_null($cg)): ?><i class="far fa-check-circle"></i><?php endif; ?></span></h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($cg)): ?>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Date : </strong><span><?php echo e($cg->program_date); ?></span></li>
            <li class="list-group-item"><strong>Vanue : </strong><span><?php echo e($cg->venue); ?></span></li>
            <li class="list-group-item"><strong>Career Field : </strong><span><?php echo e($cg->career_field1); ?></span></li>
            <li class="list-group-item"><strong>Career Field 2 : </strong><span><?php echo e($cg->career_field2); ?></span></li>
            <li class="list-group-item"><strong>Career Field 3 : </strong><span><?php echo e($cg->career_field3); ?></span></li>
          </ul>
          <?php else: ?>
          No data Available
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>

  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($soft)): ?><i class="fa fa-globe bg-default"></i><?php else: ?> <i class="fa fa-globe bg-success"></i><?php endif; ?>

      <div class="timeline-item">
        
        <h3 class="timeline-header">Soft Skills Course <span  style="float: right" class="text-success"><?php if(!is_null($soft)): ?><i class="far fa-check-circle"></i><?php endif; ?></span> </h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($soft)): ?>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span><?php echo e($soft->name); ?></span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span><?php echo e($soft->start_date); ?></span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span><?php echo e($soft->end_date); ?></span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                <?php switch($soft->dropout):
                case (1): ?>
                <small class="badge badge-danger"><?php echo e("Dropout"); ?></small>
                <?php break; ?>
                <?php case (0): ?>
                <?php if($soft->end_date < date("Y-m-d")): ?>
                <small class="badge badge-warning"><?php echo e("Finished"); ?></small>
                <?php else: ?>
                <small class="badge badge-success"><?php echo e("Ongoing"); ?></small>
                <?php endif; ?>
                <?php break; ?>
                <?php default: ?>
                
                <?php endswitch; ?>
              </span>
            </li>
            <?php if($soft->dropout==1): ?><li class="list-group-item"><strong>Reason to Dropout : </strong><span><?php echo e($soft->reoson_to_dropout); ?></span></li><?php endif; ?>
          </ul>
          <?php else: ?>
          No data Available
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($gvt)): ?><i class="fa fa-graduation-cap bg-default"></i><?php else: ?> <i class="fa fa-hotel bg-success"></i><?php endif; ?>
      <div class="timeline-item">
        
        <h3 class="timeline-header">Support to Follow Gvt. Courses <span  style="float: right" class="text-success"><?php if(!is_null($gvt)): ?><i class="far fa-check-circle"></i><?php endif; ?></span></h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($gvt)): ?>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span><?php echo e($gvt->institute_name); ?></span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span><?php echo e($gvt->course_name); ?></span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span><?php echo e($gvt->course_type); ?></span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span><?php echo e($gvt->start_date); ?></span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span><?php echo e($gvt->end_date); ?></span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                <?php switch($gvt->dropout):
                case (1): ?>
                <small class="badge badge-danger"><?php echo e("Dropout"); ?></small>
                <?php break; ?>
                <?php case (0): ?>
                <?php if($gvt->end_date < date("Y-m-d")): ?>
                <small class="badge badge-warning"><?php echo e("Finished"); ?></small>
                <?php else: ?>
                <small class="badge badge-success"><?php echo e("Ongoing"); ?></small>
                <?php endif; ?>
                <?php break; ?>
                <?php default: ?>
                
                <?php endswitch; ?>
              </span>
            </li>
            <?php if($gvt->dropout==1): ?><li class="list-group-item"><strong>Reason to Dropout : </strong><span><?php echo e($gvt->reoson_to_dropout); ?></span></li><?php endif; ?>
          </ul>
          <?php else: ?>
          No data Available
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($financial)): ?><i class="fa fa-award bg-default"></i><?php else: ?> <i class="fa fa-award bg-success"></i><?php endif; ?>
      <div class="timeline-item">
        
        <h3 class="timeline-header">Finacial Assistance for Courses <span  style="float: right" class="text-success"><?php if(!is_null($financial)): ?><i class="far fa-check-circle"></i><?php endif; ?></span></h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($financial)): ?>
          <ul class="list-group list-group-flush">
            <?php $__currentLoopData = $financial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $financial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item"><strong>Institute : </strong><span><?php echo e($financial->institute_name); ?></span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span><?php echo e($financial->course_name); ?></span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span><?php echo e($financial->course_type); ?></span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span><?php echo e($financial->start_date); ?></span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span><?php echo e($financial->end_date); ?></span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                <?php switch($financial->dropout):
                case (1): ?>
                <small class="badge badge-danger"><?php echo e("Dropout"); ?></small>
                <?php break; ?>
                <?php case (0): ?>
                <?php if($financial->end_date < date("Y-m-d")): ?>
                <small class="badge badge-warning"><?php echo e("Finished"); ?></small>
                <?php else: ?>
                <small class="badge badge-success"><?php echo e("Ongoing"); ?></small>
                <?php endif; ?>
                <?php break; ?>
                <?php default: ?>
                
                <?php endswitch; ?>
              </span>
            </li>
            <?php if($financial->dropout==1): ?><li class="list-group-item"><strong>Reason to Dropout : </strong><span><?php echo e($financial->reoson_to_dropout); ?></span></li><?php endif; ?>
            <li class="list-group-item"><strong>Approved Ammount : </strong><span><?php echo e($financial->approved_amount); ?></span></li>
            <li class="list-group-item"><strong>Installments : </strong><span><?php echo e($financial->installments); ?></span></li>
            <hr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <?php else: ?>
          No data Available
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($partner)): ?><i class="fa fa-award bg-default"></i><?php else: ?> <i class="fa fa-award bg-success"></i><?php endif; ?>
      <div class="timeline-item">
        
        <h3 class="timeline-header">Support to Courses with Partnerships <span  style="float: right" class="text-success"><?php if(!is_null($partner)): ?><i class="far fa-check-circle"></i><?php endif; ?></span></h3>

        <div class="timeline-body text-muted">
          <?php if(!is_null($partner)): ?>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span><?php echo e($partner->institute_name); ?></span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span><?php echo e($partner->course_name); ?></span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span><?php echo e($partner->course_type); ?></span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span><?php echo e($partner->start_date); ?></span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span><?php echo e($partner->end_date); ?></span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                <?php switch($partner->dropout):
                case (1): ?>
                <small class="badge badge-danger"><?php echo e("Dropout"); ?></small>
                <?php break; ?>
                <?php case (0): ?>
                <?php if($partner->end_date < date("Y-m-d")): ?>
                <small class="badge badge-warning"><?php echo e("Finished"); ?></small>
                <?php else: ?>
                <small class="badge badge-success"><?php echo e("Ongoing"); ?></small>
                <?php endif; ?>
                <?php break; ?>
                <?php default: ?>
                
                <?php endswitch; ?>
              </span>
            </li>
            <?php if($partner->dropout==1): ?><li class="list-group-item"><strong>Reason to Dropout : </strong><span><?php echo e($partner->reoson_to_dropout); ?></span></li><?php endif; ?>
            <li class="list-group-item"><strong>Approved Ammount : </strong><span><?php echo e($partner->approved_amount); ?></span></li>

          </ul>
          <?php else: ?>
          No data Available
          <?php endif; ?>
        </div>
        
      </div>
    </li>
  </ul>
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <?php if(is_null($placement) || is_null($individual)): ?><i class="fa fa-briefcase bg-default"></i><?php else: ?> <i class="fa fa-briefcase bg-success"></i><?php endif; ?>
      <div class="timeline-item">
        
        <h3 class="timeline-header">Job Placement <span  style="float: right" class="text-success"><?php if(!is_null($placement) || !is_null($individual)): ?><i class="far fa-check-circle"></i><?php endif; ?></span></h3>

        <div class="timeline-body text-muted">
         <?php if(!is_null($placement)): ?>
         <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Employer : </strong><span><?php echo e($placement->name); ?></span></li>
          <li class="list-group-item"><strong>Vacancy Placed : </strong><span><?php echo e($placement->vacancies); ?></span></li>
          <li class="list-group-item"><strong>Salary : </strong><span><?php echo e($placement->salary); ?></span></li>                          
        </ul>
        <?php elseif(!is_null($individual)): ?>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Employer : </strong><span><?php echo e($individual->name); ?></span></li>
          <li class="list-group-item"><strong>Vacancy Placed : </strong><span><?php echo e($individual->vacancy); ?></span></li>
          <li class="list-group-item"><strong>Salary : </strong><span><?php echo e($individual->salary); ?></span></li>                          
        </ul>
        <?php else: ?>
        No data Available
        <?php endif; ?>
      </div>
      
    </div>
  </li>
</ul>
</div>
<?php endif; ?>
<!-- /.tab-pane -->
</div>
<!-- /.tab-content -->
</div><!-- /.card-body -->
</div>
<!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
	$(document).ready(function(){
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
  });


  $(document).ready(function(){
   $(document).on('click' , '#select-youth' ,function (){
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: SITE_URL + '/youth/select',
      
      data: {
        '_token': $('input[name=_token]').val(),
        'youth_id': id
      },
      beforeSend: function(){
        $('#loading').show();
      },
      complete: function(){
        $('#loading').hide();
      },          
      success: function(data) {
        if($.isEmptyObject(data.error)){              
          toastr.success('Succesfully select this youth! ', 'Congratulations', {timeOut: 5000});
        }
        else{
          toastr.error('Error !', ""+data.error+"");
          
        }         
      },

      error: function (jqXHR, exception) {    
        console.log(jqXHR);
        toastr.error('Error !', 'Something Error')
      },
    });
  });
 });

  <?php if(session('error')): ?>
  toastr.error('<?php echo e(session('error')); ?>')
  <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>