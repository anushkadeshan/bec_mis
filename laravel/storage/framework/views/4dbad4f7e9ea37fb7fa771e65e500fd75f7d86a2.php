<?php $__env->startSection('title', 'GVT Course Support |'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-8">

                        <h4>Support for course enrollment & directing to Gvt. Institutes <small class="badge badge-success">
                                <?php echo e(count($meetings)); ?></small></h4>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(Route('home')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(url('m&e-reports')); ?>">Reports</a></li>
                            <li class="breadcrumb-item active">3.1.1</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 hidden-print">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Filters</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false" style="background-color: #5E6971; color: white;">

                            <?php $branch_id = Auth::user()->branch; ?>
                            <?php if(is_null($branch_id)): ?>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <div class="form-group">
                                            <label for="disability">Branch &nbsp;&nbsp;</label>
                                            <select name="branch_id" id="branch_id" class="form-control">
                                                <option value="">All</option>
                                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </a>
                                </li>
                            <?php else: ?>
                                <input type="hidden" name="branch_id" value="<?php echo e($branch_id); ?>">
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link">

                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" id="dateStart" data-date-end-date="0d"
                                            placeholder="From">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" name="dateEnd" id="dateEnd" class="form-control"
                                            data-date-end-date="0d" placeholder="To">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!--
                          <li class="nav-item">
                            <a class="nav-link">
                                <div class="form-group">
                                <label for="disability">Course &nbsp;&nbsp;</label>
                                <select name="course_id" id="course_id" class="form-control">
                                  <option value="">All</option>
                                  <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($course->id); ?>"><?php echo e($course->course_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link">
                                <div class="form-group">
                                <label for="disability">Institute &nbsp;&nbsp;</label>
                                <select name="institute_id" id="institute_id" class="form-control">
                                  <option value="">All</option>
                                  <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($institute->id); ?>"><?php echo e($institute->institute_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </a>
                          </li>
                        -->
                            <li class="nav-item">
                                <a class="nav-link">
                                    <button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i
                                            id="loading" class="fas fa-filter"></i> Filter <i style="display:none"
                                            id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button>
                                    <button type="button" name="refresh" id="refresh"
                                        class="btn btn-default btn-flat">Refresh</button>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">Data</h3>
                                <ul class="nav nav-pills ml-auto p-2" id="tabs">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1"
                                            data-toggle="tab">Summary</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Programs</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3">More</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_4">Review Report</a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div>

                                            <a class="btn btn-app zoom">
                                                <span class="badge bg-warning" id="total_records"></span>
                                                <i class="fa fa-handshake"></i>Programs
                                            </a>
                                            <a class="btn btn-app zoom">
                                                <span class="badge bg-warning" id="total_male1"></span>
                                                <i class="fa fa-mars" style="color:blue"></i>Total Male
                                            </a>
                                            <a class="btn btn-app zoom">
                                                <span class="badge bg-warning" id="total_female1"></span>
                                                <i class="fa fa-venus" style="color:#FF00CD"></i>Total Female
                                            </a>
                                            <a class="btn btn-app zoom">
                                                <span class="badge bg-warning" id="total_p_male"></span>
                                                <i class="fa fa-wheelchair" style="color:blue"></i>PWD Male
                                            </a>
                                            <a class="btn btn-app zoom">
                                                <span class="badge bg-warning" id="total_p_female"></span>
                                                <i class="fa fa-wheelchair" style="color:#FF00CD"></i>PWD Female
                                            </a>
                                        </div>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?>
                                        <div class="col-md-12">
                                            <table id="example10" class="table row-border table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch</th>
                                                        <th>No of Times</th>
                                                        <th>Total Male</th>
                                                        <th>Total Female</th>
                                                        <th>Total Youths</th>
                                                        <th>Youths still in courses</th>
                                                        <th>Dropouts</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>

                                            </table>

                                        </div>
                                    <?php endif; ?>
                                        <div class="card card-success">
                                            <div class="card-header">
                                                Current Status of GVT Supported Youths
                                            </div>
                                            <div class="card-body">
                                                <table id="youths_table" class="table row-border table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Youth ID</th>
                                                            <th>Youth Name</th>
                                                            <th>Contacts</th>
                                                            <th>Course Status</th>
                                                            <th>Current Status</th>
                                                            <th>Branch</th>
                                                        </tr>
                                                    <tbody>

                                                        <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($youth->youth_id); ?></td>
                                                                <td><a
                                                                        href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>"><?php echo e($youth->youth_name); ?></a>
                                                                </td>
                                                                <td><?php echo e($youth->phone); ?></td>
                                                                <td>
                                                                    <?php switch($youth->dropout):
                                                                        case (1): ?>
                                                                        <small
                                                                            class="badge badge-danger"><?php echo e('Dropout'); ?></small>
                                                                        <?php break; ?>
                                                                        <?php case (0): ?>
                                                                        <?php if($youth->end_date < date('Y-m-d')): ?>
                                                                            <small
                                                                                class="badge badge-warning"><?php echo e('Finished'); ?></small>
                                                                        <?php else: ?>
                                                                            <small
                                                                                class="badge badge-success"><?php echo e('Ongoing'); ?></small>
                                                                        <?php endif; ?>
                                                                        <?php break; ?>
                                                                        <?php default: ?>

                                                                    <?php endswitch; ?>
                                                                </td>
                                                                <td>

                                                                    <?php
                                                                    $job =
                                                                    DB::table('placement_individual')->where('youth_id',$youth->youth_id)->first();
                                                                    $vt = DB::table('finacial_supports_youths')
                                                                    ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                                                                    ->where('end_date', '>', date("Y-m-d"))
                                                                    ->where('youth_id',$youth->youth_id)->first();

                                                                    $soft = DB::table('provide_soft_skills_youths')
                                                                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                                                                    ->where('end_date', '>', date("Y-m-d"))
                                                                    ->where('youth_id',$youth->youth_id)->first();
                                                                    ?>
                                                                    <select <?php if($youth->end_date > date('Y-m-d') || !is_null($job) || !is_null($vt) || !is_null($soft)): ?>
                                                                        disabled
                                                        <?php endif; ?>
                                                        name="current_status" id="current_status" class="form-control"
                                                        onchange="updateStatus(this.value,<?php echo e($youth->youth_id); ?>)">
                                                        <option <?php if($youth->cs == 5): ?> selected
                                                            <?php endif; ?> value="5">No Job</option>
                                                        <option <?php if($youth->end_date > date('Y-m-d')): ?> selected
                                                            <?php endif; ?> value="1">Still Following Course
                                                        </option>
                                                        <option <?php if(!is_null($vt)): ?> selected
                                                            <?php endif; ?> value="2">Following Course-BEC
                                                            Supported</option>
                                                        <option <?php if($youth->cs == 3): ?> selected
                                                            <?php endif; ?> value="3">Following Course-BEC Not
                                                            Supported</option>
                                                        <option <?php if(!is_null($soft)): ?> selected
                                                            <?php endif; ?> value="7">Following a Soft Skill Course
                                                            </option>
                                                        <option <?php if(!is_null($job)): ?> selected
                                                            <?php endif; ?> value="4">On the Job</option>
                                                        <option <?php if($youth->cs == 6): ?> selected
                                                            <?php endif; ?> value="6">Not Contactable</option>
                                                        </select>

                                                        </td>
                                                        <td><?php echo e($youth->ext); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                                            Add Following Course and Completion Date</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" id="following_course">
                                                                            <?php echo e(csrf_field()); ?>

                                                                            <div class="form-group">
                                                                                <label for="dm_name">Course Name</label>
                                                                                <input data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Search course name and select"
                                                                                    type="text" id="course_name"
                                                                                    name="res_id" class="form-control"
                                                                                    placeholder="Search Name of Course">
                                                                                <div id="course_list"></div>
                                                                                <input type="hidden" id="course_id"
                                                                                    name="following_course_id" value="">
                                                                                <input type="hidden" id="status_youth_id"
                                                                                    name="youth_id" value="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Expected Course Completion
                                                                                    Date</label>
                                                                                <input type="date" class="form-control"
                                                                                    name="following_course_end_date">
                                                                            </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tbody>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    <div class="card card-success">
                                        <div class="card-header">
                                            Enrolled Youths <a href="<?php echo e(Route('view_gvt_youths')); ?>"><span
                                                    class="badge badge-warning float-right" id="row_count">View Youth
                                                    Report</span></a>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="curve_chart" style=" height: 400px"></div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <table id="example" class="table row-border table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Program Date</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Course</th>
                                                <th>Institute</th>
                                                <th>Course End</th>
                                                <th>Branch</th>
                                                <th>Action</th>
                                            </tr>
                                        <tbody>
                                        </tbody>
                                        </thead>
                                    </table>
                                    <?php echo e(csrf_field()); ?>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane print" id="tab_3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Program Details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item border-0"><strong>District :
                                                            </strong><span id="district"></span></li>
                                                        <li class="list-group-item border-0"><strong>DSDs :
                                                            </strong><span id="dsd"></span></li>
                                                        <li class="list-group-item border-0"><strong>DM Name :
                                                            </strong><span id="dm_name"></span></li>
                                                        <li class="list-group-item border-0"><strong>Program Date :
                                                            </strong><span id="meeting_date"></span></li>
                                                        <li class="list-group-item border-0"><strong>Institute :
                                                            </strong><a href="" id="link3" target="_blank"><span
                                                                    id="institute"></span></a></li>
                                                        <li class="list-group-item border-0"><strong>Institute Review
                                                                Done ? : </strong><span id="review"></span></li>
                                                        <li class="list-group-item border-0"><strong>Course :
                                                            </strong><a href="" id="link2" target="_blank"><span
                                                                    id="course"></span></a></li>
                                                        <li class="list-group-item border-0"><strong>Start Date:
                                                            </strong><span id="s-date"></span></li>
                                                        <li class="list-group-item border-0"><strong>End Date:
                                                            </strong><span id="e-date"></span></li>
                                                        <li class="list-group-item border-0"><strong>Total Male:
                                                            </strong><span id="total_male"></span></li>
                                                        <li class="list-group-item border-0"><strong>Total Female:
                                                            </strong><span id="total_female"></span></li>
                                                        <li class="list-group-item border-0"><strong>PWD Male:
                                                            </strong><span id="pwd_male"></span></li>
                                                        <li class="list-group-item border-0"><strong>PWD Female:
                                                            </strong><span id="pwd_female"></span></li>
                                                        <li class="list-group-item border-0"><strong>Branch:
                                                            </strong><span id="branch"></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Youth Details <small
                                                            class="badge badge-danger" id="total_participants"></small>
                                                    </h3>
                                                </div>
                                                <div class="card-body">

                                                    <table id="example2" class="table row-border table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name </th>
                                                                <th>Nature of Support</th>
                                                                <th>Inst. Type </th>
                                                            </tr>
                                                        <tbody>
                                                        </tbody>

                                                        </thead>
                                                    </table>
                                                    <button type="button hidden-print" id="print"
                                                        class="btn btn-success btn-flat"><i class="fas fa-print"></i>
                                                        Print</button>
                                                    <button type="button" id="review_id" name="file_name"
                                                        class="btn btn-primary btn-flat" data-id=""
                                                        data-attendance=""><i class="fas fa-download"></i> Review
                                                        Report</button>

                                                    <?php echo e(csrf_field()); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Review Details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item border-0"><strong>District :
                                                            </strong><span id="district1"></span></li>
                                                        <li class="list-group-item border-0"><strong>DSDs :
                                                            </strong><span id="dsd1"></span></li>
                                                        <li class="list-group-item border-0"><strong>DM Name :
                                                            </strong><span id="dm_name1"></span></li>
                                                        <li class="list-group-item border-0"><strong>Review Date :
                                                            </strong><span id="meeting_date1"></span></li>
                                                        <fieldset class="border p-2 list-group-flush">
                                                            <legend class="w-auto text-primary"><small> Institute
                                                                    Details</small></legend>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <li class="list-group-item border-0">
                                                                        <strong>Institute : </strong> <br><a href=""
                                                                            id="link-new" target="_blank"><span
                                                                                id="institute1"></span></a></li>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <li class="list-group-item border-0"><strong>Head of
                                                                            Institute : </strong><br><span
                                                                            id="head"></span></li>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <li class="list-group-item border-0"><strong>Contact
                                                                            : </strong><br><span id="contact"></span>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <li class="list-group-item border-0">
                                                                        <strong>Commenced on : </strong><br><span
                                                                            id="c_date"></span></li>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <li class="list-group-item border-0"><strong>TVEC
                                                                            Expiary on : </strong><br><span
                                                                            id="e_date"></span></li>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset class="border p-2 list-group-flush">
                                                            <legend class="w-auto text-primary"><small> Others</small>
                                                            </legend>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0"><strong>Is the
                                                                            OJT compulsory for all courses ? :
                                                                        </strong><br> <span id="ojt"></span></li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0"><strong>Courses
                                                                            that OJT is not compulsory : </strong><br>
                                                                        <span id="courses"></span></li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0"><strong>Follow
                                                                            up services on passed out trainees :
                                                                        </strong><br> <span id="follow"></span></li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0">
                                                                        <strong>Services offered : </strong><br> <span
                                                                            id="services"></span></li>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <li class="list-group-item border-0">
                                                                        <strong>Training Allowance : </strong><br> <span
                                                                            id="allow"></span></li>
                                                                    <li class="list-group-item border-0"><strong>Amount
                                                                            : </strong><br> <span id="amount"></span>
                                                                    </li>
                                                                    <li class="list-group-item border-0"><strong>Source
                                                                            : </strong><br> <span id="source"></span>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0"><strong>Soft
                                                                            skill development components included ? :
                                                                        </strong><br> <span id="soft"></span></li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0"><strong>Does
                                                                            the institute agree to incorporate/update
                                                                            soft skill components at their own expenses
                                                                            : </strong><br> <span id="agree"></span>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li class="list-group-item border-0">
                                                                        <strong>Existing gaps to incorporate soft skill
                                                                            components : </strong><br> <span
                                                                            id="gaps"></span></li>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <li class="list-group-item border-0"><strong>Branch:
                                                            </strong><span id="branch1"></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card card-success card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Courses provided <small
                                                            class="badge badge-danger" id="total_participants1"></small>
                                                    </h3>
                                                </div>
                                                <div class="card-body">

                                                    <table id="example3" class="table row-border table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Courses </th>
                                                                <th>Period of Intake</th>
                                                                <th>Intake per Batch</th>
                                                                <th># Students Currently following</th>
                                                                <th># Students passed out</th>
                                                            </tr>
                                                        <tbody>
                                                        </tbody>

                                                        </thead>
                                                    </table>
                                                    <button type="button hidden-print" id="print"
                                                        class="btn btn-success btn-flat"><i class="fas fa-print"></i>
                                                        Print</button>

                                                    <?php echo e(csrf_field()); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="<?php echo e(asset('js/printThis.js')); ?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).ready(function() {
        //search resourse Person
        $('#course_name').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: SITE_URL + '/support-courseList',
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#course_list').fadeIn();
                        $('#course_list').html(data);
                    }
                });
            }
        });

        $(document).on('click', '#course li', function() {
            $('#course_list').fadeOut();
            $('#course_name').val($(this).text());
            $('#start_date').focus();

            var ins_id = $(this).attr('id');
            $('#course_id').val(ins_id);

        });
    });

    function updateStatus(value, id) {
        if (value == 3) {
            courseDetails(value, id);
        } else {
            var _token = '<?php echo e(csrf_field()); ?>';
            $.ajax({
                type: 'GET',
                url: SITE_URL + '/change-gvt-status/' + value + '/' + id,

                success: function(data) {
                    if (data.code == 401) {
                        toastr.error(data.msg, 'Oops!', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.success(data.msg, 'Great!', {
                            timeOut: 5000
                        });
                    }

                },

                error: function(jqXHR, exception) {
                    console.log(jqXHR);
                    toastr.error('Error !', 'Something Error')
                },
            });
        }
    }

    function courseDetails(value, id) {
        $('#status_youth_id').val(id);

        $('#exampleModalCenter').modal('show');

    }
    $(document).ready(function() {

        var dataTable = $("#example").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
        });

        var dataTable2 = $("#example10").DataTable({
            dom: 'Bfrtip',
            buttons: [

            ],

            "bFilter": false,
            "bPaginate": false,
            "info": false,

        });

        dataTable2.columns('.sum').every(function() {
            var column = this;

            var sum = column
                .data()
                .reduce(function(a, b) {
                    a = parseInt(a, 10);
                    if (isNaN(a)) {
                        a = 0;
                    }

                    b = parseInt(b, 10);
                    if (isNaN(b)) {
                        b = 0;
                    }

                    return a + b;
                });

            $(this.footer()).html(sum);
        });

        var date = new Date();

        $('.input-group').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        var _token = $('input[name="_token"]').val();

        fetch_data();

        function fetch_data(dateStart = '', dateEnd = '', branch = '' /* ,course='',institute=''*/ ) {
            $.ajax({
                url: "<?php echo e(Route('reports-me/skill/gvt-support/fetch')); ?>",
                method: "POST",
                data: {
                    dateStart: dateStart,
                    dateEnd: dateEnd,
                    _token: _token,
                    branch: branch /*,course:course,institute:institute*/
                },
                dataType: "json",
                beforeSend: function() {
                    $("#loading").attr('class', 'fa fa-spinner fa-lg faa-spin animated');
                },
                complete: function() {
                    $("#loading").attr('class', 'fas fa-filter');

                },
                success: function(data) {

                    dataTable.clear().draw();
                    var count = 1;
                    var male_sum = 0;
                    var female_sum = 0;
                    var pwd_m_sum = 0;
                    var pwd_f_sum = 0;

                    dataTable2.clear().draw();
                    var count2 = 1;
                    $.each(data.summary, function(index, value2) {
                        // use data table row.add, then .draw for table refresh
                        dataTable2.row.add([count2++, value2.name, value2.progs, value2.male, value2.female, value2.male + value2.female,value2.status, value2.gvt_drop
                        ]).draw();
                    });


                    $.each(data.data, function(index, value) {
                        //console.log(value);
                        // use data table row.add, then .draw for table refresh
                        dataTable.row.add([count++, value.meeting_date, value.total_male,
                            value.total_female, value.course_name, value
                            .institute_name, value.end_date, value.ext,
                            '<div class="btn-group"><button type="button" name="view" data-id="' +value.m_id + '" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="<?php echo e(url('reports-me/gvt-support')); ?>/'+value.m_id +'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>'
                        ]).draw();

                        var total_male = value.total_male;
                        var total_female = value.total_female;
                        var total_p_male = value.pwd_male;
                        var total_p_female = value.pwd_female;
                        if ($.isNumeric(total_male, total_female, total_p_male,
                                total_p_female)) {
                            male_sum += parseFloat(total_male);
                            female_sum += parseFloat(total_female);
                            pwd_m_sum += parseFloat(total_p_male);
                            pwd_f_sum += parseFloat(total_p_female);
                        }
                    });

                    $('#total_records').text(data.data.length);
                    $('#total_male1').text(male_sum);
                    $('#total_female1').text(female_sum);
                    $('#total_p_male').text(pwd_m_sum);
                    $('#total_p_female').text(pwd_f_sum);

                }
            });

            $('#filter').click(function() {
                var dateStart = $('#dateStart').val();
                var dateEnd = $('#dateEnd').val();
                var branch = $('#branch_id').val();
                /*var course = $('#course_id').val();
                var institute = $('#institute_id').val();*/
                if (dateStart != '' && dateEnd != '') {
                    //alert(branch);
                    fetch_data(dateStart, dateEnd, branch /*, course,institute*/ );

                } else {
                    toastr.error('Error !', 'Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#dateStart').val('');
                $('#dateEnd').val('');
                $('#branch_id').val('');
                /*$('#course_id').val('');
                $('#institute_id').val('');*/
                fetch_data();
            });
        }

    });

    $('body').on('click', '.btn_view', function() {

        var meeting_id = $(this).data('id');


        $.get("<?php echo e(url('reports-me/skill/gvt-support')); ?>" + '/' + meeting_id + '/view', function(data) {
            $('#tabs a[href="#tab_3"]').tab('show');
            $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

            $('#district').text(data.meeting.district);
            $('#dsd').text(data.meeting.dsd);
            $('#dm_name').text(data.meeting.dm_name);
            $('#meeting_date').text(data.meeting.meeting_date);
            $('#institute').text(data.meeting.institute_name);
            $('#review').text(data.meeting.institutional_review);
            $('#course').text(data.meeting.course_name);
            $('#s-date').text(data.meeting.start_date);
            $('#e-date').text(data.meeting.end_date);
            $('#total_male').text(data.meeting.total_male);
            $('#total_female').text(data.meeting.total_female);
            $('#pwd_male').text(data.meeting.pwd_male);
            $('#pwd_female').text(data.meeting.pwd_female);
            $('#branch').text(data.meeting.branch_name);

            $('#review_id').data("id", data.meeting.review_report);


            //$("#link").attr("href",url);

            var course = data.meeting.c_id;
            var url2 = SITE_URL + '/courses/' + course + '/view';

            $("#link2").attr("href", url2);

            var institute = data.meeting.i_id;
            var url3 = SITE_URL + '/institute/' + institute + '/view';

            $("#link3").attr("href", url3);

            var output1 = '';
            $('#total_participants').text(data.youths.length);

            for (var count = 0; count < data.youths.length; count++) {

                output1 += '<tr>';
                output1 += '<td>' + (count + 1) + '</td>';
                output1 += '<td><a target="_blank" href="' + SITE_URL + '/youth/' + data.youths[count].youth_id + '/view">' + data.youths[count].name + '</a></td>';
                output1 += '<td>' + data.youths[count].nature_of_support + '</td>';
                output1 += '<td>' + data.youths[count].institute_type + '</td></tr>';
            }
            $('#example2 tbody').html(output1);

        })

    });

    $('body').on('click', '#review_id', function() {

        var meeting_id = $(this).data('id');
        // alert(meeting_id);


        $.get("<?php echo e(url('reports-me/skill/institute-review')); ?>" + '/' + meeting_id + '/view', function(data) {
            $('#tabs a[href="#tab_4"]').tab('show');
            $('#tabs a[href="#tab_4"]').attr("data-toggle", "tab");

            $('#district1').text(data.meeting.district);
            $('#dsd1').text(data.meeting.dsd);
            $('#dm_name1').text(data.meeting.dm_name);
            $('#meeting_date1').text(data.meeting.meeting_date);
            $('#institute1').text(data.meeting.institute_name);
            $('#head').text(data.meeting.head_of_institute);
            $('#contact').text(data.meeting.contact);
            $('#c_date').text(data.meeting.commencement_date);
            $('#e_date').text(data.meeting.tvec_ex_date);
            $('#training_stage').text(data.meeting.training_stage);
            $('#s-date').text(data.meeting.start_date);
            $('#e-date').text(data.meeting.end_date);
            $('#ojt').text(data.meeting.ojt_compulsory);
            $('#courses').text(data.meeting.courses_not_compulsory);
            $('#follow').text(data.meeting.followup);
            $('#services').text(data.meeting.services_offered);
            $('#allow').text(data.meeting.trainee_allowance);
            $('#amount').text(data.meeting.amount);
            $('#source').text(data.meeting.source);
            $('#soft').text(data.meeting.soft_skill);
            $('#agree').text(data.meeting.agreement_soft_skill);
            $('#gaps').text(data.meeting.gaps);
            $('#branch1').text(data.meeting.branch_name);



            var institute = data.meeting.i_id;
            var url3 = SITE_URL + '/institute/' + institute + '/view';

            $("#link-new").attr("href", url3);

            var output1 = '';
            $('#total_participants1').text(data.courses.length);

            for (var count = 0; count < data.courses.length; count++) {

                output1 += '<tr>';
                output1 += '<td>' + (count + 1) + '</td>';
                output1 += '<td><a target="_blank" href="' + SITE_URL + '/courses/' + data.courses[count].course_id + '/view">' + data.courses[count].name + '</a></td>';
                output1 += '<td>' + data.courses[count].period_intake + '</td>';
                output1 += '<td>' + data.courses[count].intake_per_batch + '</td>';
                output1 += '<td>' + data.courses[count].current_following + '</td>';
                output1 += '<td>' + data.courses[count].passed_out + '</td></tr>';
            }
            $('#example3 tbody').html(output1);

        })

    });


    $('#print').click(function() {
        $('.print').printThis({
            pageTitle: "CG Training",
        });
    });


    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Total Male', 'Total Female', 'PWD Male', 'PWD Female'],
            ['2018',  <?php if($participants2018->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2018->total_male); ?> <?php endif; ?> , <?php if($participants2018->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2018->total_female); ?><?php endif; ?>, <?php if($participants2018->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2018->pwd_male); ?><?php endif; ?>,<?php if($participants2018->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2018->pwd_female); ?><?php endif; ?>],
            ['2019',  <?php if($participants2019->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2019->total_male); ?> <?php endif; ?> , <?php if($participants2019->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2019->total_female); ?><?php endif; ?>, <?php if($participants2019->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2019->pwd_male); ?><?php endif; ?>,<?php if($participants2019->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2019->pwd_female); ?><?php endif; ?>],
            ['2020',  <?php if($participants2020->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2020->total_male); ?> <?php endif; ?> , <?php if($participants2020->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2020->total_female); ?><?php endif; ?>, <?php if($participants2020->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2020->pwd_male); ?><?php endif; ?>,<?php if($participants2020->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2020->pwd_female); ?><?php endif; ?>],
            ['2021',  <?php if($participants2021->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2021->total_male); ?> <?php endif; ?> , <?php if($participants2021->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2021->total_female); ?><?php endif; ?>, <?php if($participants2021->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2021->pwd_male); ?><?php endif; ?>,<?php if($participants2021->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2021->pwd_female); ?><?php endif; ?>],

        ]);

        var options = {
            title: '',
            curveType: 'function',
            chartArea: {
                left: 45,
                top: 20,
                bottom: 20,
            },
            legend: {
                position: 'Left',
                interpolateNulls: true,
                animation: {
                    duration: 1000,
                    easing: 'out',
                },
            }

        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }

    $(document).ready(function() {
        $("#following_course").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/gvt-status/course-follow',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success('Succesfully updated Status and Course Details ! ',
                            'Congratulations', {
                                timeOut: 5000
                            });
                        $("#following_course")[0].reset();
                        $('#exampleModalCenter').modal('hide');

                    } else {
                        $('#loading').hide();
                        toastr.error('', 'Something Error !');
                        printValidationErrors(data.error);

                    }
                },

                error: function(jqXHR, exception) {
                    console.log(jqXHR);
                    toastr.error('Error !', 'Something Error')
                },
            });
        });
    });

</script>
<style>
    th {
        font-size: 15px;
    }

    td {
        font-size: 14px;
    }

    .zoom:hover {
        transform: scale(1.5);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        z-index: 5000;
        transition: all .2s ease-in-out;
    }

    #autocomplete,
    #institute,
    #course,
    #youths,
    #review_reports {
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

    #autocomplete,
    #institute,
    #course,
    #youths,
    #review_reports>li {
        padding: 3px 20px;
    }

    #autocomplete,
    #institute,
    #course,
    #youths,
    #review_reports>li.ui-state-focus {
        background-color: #DDD;
    }

    .ui-helper-hidden-accessible {
        display: none;
    }

</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>