<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Events\userLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ds', 'UserController@ds')->name('ds');
Route::get('/users', 'UserController@index')->name('users');
Route::post('userActivate', 'UserController@userActivate')->name('userActivate');
Route::post('userDelete', 'UserController@userDelete')->name('userDelete');
Route::post('changeRole', 'UserController@changeRole')->name('changeRole');
Route::post('branch', 'UserController@changeBranch')->name('changeBranch');
Route::post('markAsRead', 'NotificationsController@markAsRead')->name('markAsRead');
Route::get('notifications', 'NotificationsController@all')->name('notifications');
Route::get('unreadNotifications', 'NotificationsController@unread')->name('unreadNotifications');

Gate::define('userList', 'App\Policies\userRoles@superAdmin');
Route::get('markAllAsRead', 'NotificationsController@markAllAsRead')->name('markAllAsRead');
//Employer Routes
Route::get('newEmployer', 'EmployerController@create')->name('newEmployer')->middleware('can:create-Employer');
Route::post('employerList', 'AssesmentController@employerList');
Route::get('employers', 'EmployerController@index')->name('employers')->middleware('can:view-Employer');
Route::post('employerDelete', 'EmployerController@delete')->name('employerDelete')->middleware('can:delete-Employer');
Route::post('employerInsert', 'EmployerController@create')->name('employerInsert')->middleware('can:create-Employer');
Route::post('/employerUpdate', 'EmployerController@update')->name('employerUpdate')->middleware('can:update-Employer');
Route::get('/e-profile', 'EmployerController@profile')->name('e-profile')->middleware('can:view-Employer-Profile');
Route::post('/e-profile-update', 'EmployerController@profileUpdate')->name('e-profile-update')->middleware('can:view-Employer-Profile');
Route::post('/youth/select', 'EmployerController@select')->name('youth/select')->middleware('can:follow-youth');
Route::get('/youth/followers', 'EmployerController@followers')->name('youth/followers')->middleware('can:view-youth-followers');
Route::post('/youth/followers/status', 'EmployerController@application_status')->name('/youth/followers/status')->middleware('can:view-youth-followers');

//vacancies route
Route::get('/vacancies', 'VacancyController@index')->name('vacancies')->middleware('can:view-vacancies');
Route::get('/new-vacancy', 'VacancyController@show')->name('new-vacancy')->middleware('can:create-vacancies');
Route::post('/locationList', 'VacancyController@locationList')->name('locationList');
Route::post('/add-vacancy', 'VacancyController@store')->name('add-vacancy')->middleware('can:create-vacancies');
Route::get('/vacancy/{id}/edit', 'VacancyController@edit')->name('edit-vacancy')->middleware('can:edit-vacancies'); 
Route::post('/vacancy/update', 'VacancyController@update')->name('update-vacancy')->middleware('can:edit-vacancies'); 
Route::post('/vacancy/delete', 'VacancyController@delete')->name('delete-vacancy')->middleware('can:delete-vacancies'); 
Route::post('/vacancy/apply', 'VacancyController@apply')->name('apply-vacancy')->middleware('can:apply-vacancy'); 
Route::get('/vacancy/{id}/view', 'VacancyController@view')->name('view-vacancy')->middleware('can:view-vacancies'); 

//youth routes
Route::get('/youth/family/add', 'FamilyController@index')->name('youth/family/add')->middleware('can:add-youth');
Route::get('/youth/view', 'YouthController@index')->name('youth/view')->middleware('can:view-applications');
Route::get('/youth/applications', 'YouthController@applications')->name('youth/applications')->middleware('can:view-applications');
Route::get('/youth/add', 'YouthController@create')->name('youth/add')->middleware('can:add-youth');
Route::get('/youth/profile-add', 'YouthController@profile_add')->name('youth/profile-add')->middleware('can:add-youth');
Route::get('/youth/profile-view', 'YouthController@profile_view')->name('youth/profile-view')->middleware('can:add-youth');
Route::get('/youth/profile-edit', 'YouthController@profile_edit')->name('youth/profile-edit')->middleware('can:add-youth');
Route::post('/youth/add-personal', 'YouthController@create_personal')->name('youth/add-personal')->middleware('can:add-youth');
Route::post('/familyList', 'YouthController@familyList')->name('familyList');
Route::post('/courseList', 'ResultController@courseList')->name('courseList');
Route::post('/courseList1', 'ResultController@courseList1')->name('courseList1');
Route::post('/youth/changeStatus', 'YouthController@changeStatus')->name('youth/changeStatus');
Route::post('/youth/add-jobs', 'YouthController@create_permanant_jobs')->name('youth/add-jobs')->middleware('can:add-youth');
Route::post('/youth/add-tempory', 'YouthController@create_tempory_jobs')->name('youth/add-tempory')->middleware('can:add-youth');
Route::post('/youth/add-following-course', 'YouthController@create_following_course')->name('youth/add-following-course')->middleware('can:add-youth');
Route::post('/youth/add-no-jobs', 'YouthController@create_no_jobs')->name('youth/add-no-jobs')->middleware('can:add-youth');
Route::post('/youth/add-self', 'YouthController@create_self')->name('youth/add-self')->middleware('can:add-youth');
Route::post('/youth/add-feedback', 'YouthController@create_feedback')->name('youth/add-feedback')->middleware('can:add-youth');
Route::post('youth/add-language', 'YouthController@create_language')->name('youth/add-language')->middleware('can:add-youth');
Route::get('/youth/{id}/edit', 'YouthController@edit')->name('edit-youth')->middleware('can:edit-youth'); 
Route::get('/youth/{id}/view', 'YouthController@profile_view_by_branch')->name('view-youth')->middleware('can:view-youths-profile'); 
Route::post('/youth/update-personal', 'YouthController@update_personal')->name('youth/update-personal')->middleware('can:edit-youth');
Route::post('/youth/update-results', 'ResultController@update_results')->name('youth/update-results')->middleware('can:edit-youth');
Route::post('/youth/update-language', 'YouthController@update_language')->name('youth/update-language')->middleware('can:edit-youth');
Route::post('/youth/update-followed-course', 'YouthController@update_followed_course')->name('youth/update-followed-course')->middleware('can:edit-youth');
Route::post('/youth/update-jobs', 'YouthController@update_permanant_jobs')->name('youth/update-jobs')->middleware('can:edit-youth');
Route::post('/youth/update-tempory', 'YouthController@update_tempory_jobs')->name('youth/update-tempory')->middleware('can:edit-youth');
Route::post('/youth/update-following-course', 'YouthController@update_following_course')->name('youth/update-following-course')->middleware('can:edit-youth');
Route::post('/youth/add-new-course', 'YouthController@add_new_course')->name('youth/add-new-course')->middleware('can:edit-youth');
Route::post('/youth/update-no-jobs', 'YouthController@update_no_jobs')->name('youth/update-no-jobs')->middleware('can:edit-youth');
Route::post('/youth/update-self', 'YouthController@update_self')->name('youth/update-self')->middleware('can:edit-youth');

Route::post('/youth/delete-youth', 'YouthController@delete')->name('/youth/delete-youth')->middleware('can:delete-youth');  
Route::post('/youth/application/status', 'YouthController@application_status')->name('/youth/application/status'); 
 
Route::post('/youth/search', 'YouthController@search')->name('/youth/search')->middleware('can:search-youth'); 


//family routes
Route::post('/districts', 'FamilyController@get_districts')->name('districts'); 
Route::get('/ds-division', function(){
	$district = Input::get('district');
	$ds_divisions = DB::table('dsd_office')->where('District','=', $district)->get();
	return Response::json($ds_divisions);
}); 

Route::get('/gn-division', function(){
	$ds_division = Input::get('ds_division');
	$gn_divisions = DB::table('gn_office')->where('DSD_ID','=', $ds_division)->get();
	return Response::json($gn_divisions);


});

Route::post('/gn-division', 'FamilyController@get_gn')->name('gn-division')->middleware('can:view-vacancies'); 
Route::post('/youth/add-family', 'FamilyController@create')->name('family/add')->middleware('can:add-youth');


//Institutes  routes
Route::get('/institutes/view', 'InstituteController@index')->name('institutes/view')->middleware('can:view-institute');
Route::post('/institutes/add-institute', 'InstituteController@insert')->name('/institutes/add-institute')->middleware('can:edit-institute'); 
Route::post('/institutes/update-institute', 'InstituteController@update')->name('/institutes/update-institute')->middleware('can:add-institute'); 
Route::post('/institutes/delete-institute', 'InstituteController@delete')->name('/institutes/delete-institute')->middleware('can:delete-institute'); 
Route::get('/institute/{id}/view', 'InstituteController@view')->name('view-institute')->middleware('can:view-institute'); 
Route::post('/institutes/add-courses', 'InstituteController@update_courses')->name('/institutes/add-course')->middleware('can:add-institute'); 

//Courses  routes
Route::get('/courses/view', 'CourseController@index')->name('courses/view')->middleware('can:view-course');
Route::post('/courses/add', 'CourseController@insert')->name('courses/insert')->middleware('can:add-course');
Route::get('/courses/cat', 'CourseController@cat')->name('courses/cat');
Route::post('/courses/add-cat', 'CourseController@addCat')->name('courses/add-cat');
Route::post('/courses/delete', 'CourseController@delete')->name('courses/delete')->middleware('can:delete-course');
Route::post('/courses/update', 'CourseController@update')->name('courses/update')->middleware('can:edit-course');
Route::get('/courses/{id}/view', 'CourseController@view')->name('view-course')->middleware('can:view-course');
Route::post('/courses/add-institutes', 'CourseController@update_institutes')->name('add-course-institute')->middleware('can:add-course');
//results routs
Route::post('/result/add-education', 'ResultController@create_education')->name('result/add-education')->middleware('can:add-youth');
Route::post('/result/add-course', 'ResultController@create_course')->name('result/add-course')->middleware('can:add-youth');

//progress routs

Route::post('progress-cg', 'ProgressController@cg')->name('progress-cg');
Route::post('progress-soft', 'ProgressController@soft')->name('progress-soft');
Route::post('progress-vt', 'ProgressController@vt')->name('progress-vt');
Route::post('progress-prof', 'ProgressController@prof')->name('progress-prof');
Route::post('progress-jobs', 'ProgressController@jobs')->name('progress-jobs');
Route::post('progress-bss', 'ProgressController@bss')->name('progress-bss');
Route::get('view_completion', 'ProgressController@view_completion')->name('view_completion');
Route::post('view_completion/fetch', 'ProgressController@fetch')->name('view_completion/fetch');
Route::get('/youth/{id}/view-progress', 'ProgressController@view')->name('view-progress')->middleware('can:view-youth');
Route::post('/cgList', 'ProgressController@cgList')->name('cgList');
Route::post('/cg/add', 'ProgressController@add')->name('cg/add')->middleware('can:view-activities');
Route::post('/job/add', 'ProgressController@add_job')->name('job/add')->middleware('can:view-activities');
Route::post('/soft_skills/add', 'ProgressController@add_soft')->name('soft_skills/add')->middleware('can:view-activities');
Route::post('/vt/add', 'ProgressController@add_vt')->name('vt/add')->middleware('can:view-activities');
Route::post('/softCourseList', 'ProgressController@softCourseList')->name('softCourseList');
Route::post('/vtCourseList', 'ProgressController@vtCourseList')->name('vtCourseList');
Route::post('/activities/cg/delete', 'CarrerGuidanceController@delete')->name('activities/cg/delete')->middleware('can:view-activities');

//reports routs

Route::get('/reports/index', 'ReportController@index')->name('reports/index')->middleware('can:view-reports');
Route::get('/reports/personal', 'ReportController@personal_reports')->name('reports/personal')->middleware('can:view-reports');
Route::get('/reports/location', 'ReportController@location')->name('reports/location')->middleware('can:view-reports');
Route::get('/reports/status', 'ReportController@status')->name('reports/status')->middleware('can:view-reports');
Route::get('/reports/jobs', 'ReportController@jobs')->name('reports/jobs')->middleware('can:view-reports');
Route::get('/reports/business', 'ReportController@business')->name('reports/business')->middleware('can:view-reports');
Route::get('/reports/common', 'ReportController@common')->name('reports/common')->middleware('can:view-reports');
Route::get('/reports/youth_courses', 'ReportController@youth_courses')->name('reports/youth_courses')->middleware('can:view-reports');
Route::get('/reports/employers', 'ReportController@employers')->name('reports/employers')->middleware('can:view-reports');
Route::get('/reports/vacancies', 'ReportController@vacancies')->name('reports/vacancies')->middleware('can:view-reports');
Route::get('/reports/institutes', 'ReportController@institutes')->name('reports/institutes')->middleware('can:search-institutes');
Route::get('/reports/training_courses', 'ReportController@training_courses')->name('reports/courses')->middleware('can:search-institutes');
Route::get('/reports/courses', 'ReportController@courses')->name('reports/courses')->middleware('can:search-institutes');


//dashboard routes
Route::get('/home/admin', 'DashboardController@admin')->name('home/admin')->middleware('can:admin-dashboard');


//M&E

Route::get('/completion-reports', 'ProgressController@completion_reports')->middleware('can:view-M&E-reports');

Route::get('/education', function () {	
    return view('Activities.education.landing-page');
});


Route::get('/career-guidance', function () {
    return view('Activities.career-guidance.landing-page');
});

Route::get('/skill-development', function () {
    return view('Activities.skill-development.landing-page');
});

Route::get('/job-linking', function () {
    return view('Activities.job-linking.landing-page');
});

Route::get('/view_cg_youths', 'CarrerGuidanceController@view_youths')->name('view_cg_youths')->middleware('can:view-M&E-reports');
Route::get('/view_gvt_youths', 'CourseSupportController@view_youths')->name('view_gvt_youths')->middleware('can:view-M&E-reports');
Route::get('/view_soft_youths', 'ProvideSoftskillController@view_youths')->name('view_soft_youths')->middleware('can:view-M&E-reports');


Route::get('/activities/education/regional-meeting', 'RegionalMeetingController@index')->name('activities/education/regional-meeting')->middleware('can:add-M&E-reports');
Route::post('/activity/education/add-meeting', 'RegionalMeetingController@add')->name('activity/education/add-meeting')->middleware('can:add-M&E-reports');
Route::get('/activities/resourse-person', 'ResoursePersonController@index')->name('activities/resourse-person')->middleware('can:add-M&E-reports');
Route::post('/activity/add-resourse', 'ResoursePersonController@store')->name('activity/add-resourse')->middleware('can:add-M&E-reports');
Route::get('/activities/education/mentoring', 'MentoringController@index')->name('activities/education/mentoring')->middleware('can:add-M&E-reports');
Route::post('/resoursePersonList', 'MentoringController@resoursePersonList')->name('resoursePersonList')->middleware('can:add-M&E-reports');
Route::post('/activity/education/add-mentoring', 'MentoringController@add')->name('activity/education/add-mentoring')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/stake-holder-meeting', 'StakeHolderMeetingController@index')->name('activities/career-guidance/stake-holder-meeting')->middleware('can:add-M&E-reports');
Route::post('/activity/cg/add-stake-holder', 'StakeHolderMeetingController@add')->name('activity/cg/add-stake-holder')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/kick-off', 'KickOffController@index')->name('activities/career-guidance/kick-off')->middleware('can:add-M&E-reports');
Route::post('/activities/career-guidance/kick-off-add', 'KickOffController@add')->name('activities/career-guidance/kick-off-add')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/households', 'KickOffController@households')->name('activities/career-guidance/households')->middleware('can:add-M&E-reports');
Route::post('/activities/career-guidance/hhs-add', 'KickOffController@add_HHS')->name('activities/career-guidance/hhs-add')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/tot-cg', 'CarrerGuidanceController@add_tot')->name('activities/career-guidance/tot-cg')->middleware('can:add-M&E-reports');
Route::post('/activities/career-guidance/tot-cg-add', 'CarrerGuidanceController@insert_tot')->name('activities/career-guidance/tot-cg-add')->middleware('can:add-M&E-reports');
Route::get('/activities/cg/view', 'CarrerGuidanceController@index')->name('activities/cg/view')->middleware('can:add-M&E-reports');
Route::post('/activities/add-cg', 'CarrerGuidanceController@insert')->name('activities/cg-add')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/pes', 'PesUnitController@index')->name('activities/career-guidance/pes')->middleware('can:add-M&E-reports');
Route::post('/activities/career-guidance/pes-add', 'PesUnitController@insert')->name('activities/career-guidance/pes-add')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/pes-support', 'PesUnitSupportController@index')->name('activities/career-guidance/pes-support')->middleware('can:add-M&E-reports');
Route::post('/pes_list', 'PesUnitSupportController@pes_List')->name('pes_list');
Route::post('/activities/career-guidance/pes-support-add', 'PesUnitSupportController@insert')->name('activities/career-guidance/pes-support-add')->middleware('can:add-M&E-reports');
Route::get('/activities/career-guidance/cg-training', 'CGtrainingController@index')->name('activities/career-guidance/cg-training')->middleware('can:add-M&E-reports');
Route::post('/activities/career-guidance/cg-training-add', 'CGtrainingController@insert')->name('activities/career-guidance/cg-training-add')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/course-support', 'CourseSupportController@index')->name('skill-development/course-support')->middleware('can:add-M&E-reports');
Route::post('/institutesList', 'CourseSupportController@instituesList')->name('institutesList')->middleware('can:add-M&E-reports');
Route::post('/support-courseList', 'CourseSupportController@courseList')->name('support-courseList')->middleware('can:add-M&E-reports');
Route::post('/youthList', 'CourseSupportController@youthList')->name('youthList')->middleware('can:add-M&E-reports');
Route::post('/review_report_list', 'CourseSupportController@reviewList')->name('reviewList')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-course-support', 'CourseSupportController@insert')->name('activity/skill/add-course-support')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/provide-softskill', 'ProvideSoftskillController@index')->name('skill-development/provide-softskill')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-provide-soft', 'ProvideSoftskillController@insert')->name('activity/skill/add-provide-soft')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/finacial-support', 'FinancialSupportController@index')->name('skill-development/finacial-support')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-finacial-support', 'FinancialSupportController@insert')->name('activity/skill/add-finacial-support')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/partnership', 'PartnershipTrainingController@index')->name('skill-development/partnership')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-partner-support', 'PartnershipTrainingController@insert')->name('activity/skill/add-partner-support')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/institute-review', 'InstituteReviewController@index')->name('skill-development/institute-review')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-institute-review', 'InstituteReviewController@insert')->name('activity/skill/add-institute-review')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/incoperate-soft-skills', 'IncoperationSoftSkillController@index')->name('skill-development/incoperate-soft-skills')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-incoperation', 'IncoperationSoftSkillController@insert')->name('activity/skill/add-incoperation')->middleware('can:add-M&E-reports');
Route::get('/activities/skill-development/tvec-meeting', 'TvecMeetingController@index')->name('skill-development/tvec-meeting')->middleware('can:add-M&E-reports');
Route::post('/activity/skill/add-tvec', 'TvecMeetingController@insert')->name('activity/skill/add-tvec')->middleware('can:add-M&E-reports');
Route::get('/activities/job-linking/assesment', 'AssesmentController@index')->name('job-linking/assesment')->middleware('can:add-M&E-reports');
Route::post('/activity/job-linking/add-assesment', 'AssesmentController@insert')->name('job-linking/add-assesment')->middleware('can:add-M&E-reports');
Route::get('/activities/job-linking/awareness', 'AwarenessController@index')->name('job-linking/awareness')->middleware('can:add-M&E-reports');
Route::post('/activity/job-linking/add-awareness', 'AwarenessController@insert')->name('job-linking/add-awareness')->middleware('can:add-M&E-reports');
Route::get('/activities/job-linking/placements', 'PlacementController@index')->name('job-linking/placements')->middleware('can:add-M&E-reports');
Route::post('/employerList', 'PlacementController@employerList')->name('employerList');
Route::post('/activity/job-linking/add-placement', 'PlacementController@insert')->name('job-linking/add-placement')->middleware('can:add-M&E-reports');
Route::get('/activities/job-linking/individual', 'PlacementController@individual')->name('job-linking/individual')->middleware('can:add-M&E-reports');
Route::post('/activity/job-linking/add-individual', 'PlacementController@insert_individual')->name('job-linking/add-individual')->middleware('can:add-M&E-reports');
Route::get('/tasks', 'TodoController@index')->name('tasks')->middleware('can:admin');
Route::post('/add-task', 'TodoController@add')->name('add-task');
Route::post('/update-task', 'TodoController@update')->name('update-task');
Route::post('/delete-task', 'TodoController@delete')->name('delete-task');

//m and e reports
Route::get('/m&e-reports', function () {
	//$count = Auth::user()->unreadNotifications->get();
	//$regional = DB::table('regional_meetings')->count();
    return view('Activities.Reports.select-report');
});

//regional meeting reports
Route::get('/reports-me/education/regional-meeting', 'RegionalMeetingController@view')->name('reports-me/education/regional-meeting')->middleware('can:view-M&E-reports');
Route::post('/reports-me/education/regional-meeting/fetch', 'RegionalMeetingController@fetch')->name('reports-me/education/regional-meeting/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/education/regional-meeting/{id}/view', 'RegionalMeetingController@view_meeting')->name('meeting-view')->middleware('can:view-M&E-reports');

//mentoring program reports
Route::get('/reports-me/education/mentoring', 'MentoringController@view')->name('reports-me/education/mentoring')->middleware('can:view-M&E-reports');
Route::post('/reports-me/education/mentoring/fetch', 'MentoringController@fetch')->name('reports-me/education/mentoring/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/education/mentoring/{id}/view', 'MentoringController@view_meeting')->name('mentoring-view')->middleware('can:view-M&E-reports');
Route::get('/download/mentoring/{file_name}', 'MentoringController@download')->name('mentoring-view')->middleware('can:view-M&E-reports');
Route::get('/download/mentoring/photos/{id}', 'MentoringController@download_photos')->middleware('can:view-M&E-reports');
Route::get('/resource-people', 'ResoursePersonController@show')->name('resource-people')->middleware('can:view-M&E-reports');
Route::get('/download/cv/{id}', 'ResoursePersonController@download')->name('download/cv')->middleware('can:view-M&E-reports');


//stake holder meeting reports
Route::get('/reports-me/cg/stake-holder-meeting', 'StakeHolderMeetingController@view')->name('reports-me/cg/stake-holder-meeting')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/stake-holder-meeting/fetch', 'StakeHolderMeetingController@fetch')->name('reports-me/cg/stake-holder-meeting/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/stakeHolder/{id}/view', 'StakeHolderMeetingController@view_meeting')->name('mentoring-view')->middleware('can:view-M&E-reports');
Route::get('/download/stake/{file_name}', 'StakeHolderMeetingController@download')->name('stake-view')->middleware('can:view-M&E-reports');
Route::get('/download/stake/photos/{id}', 'StakeHolderMeetingController@download_photos')->middleware('can:view-M&E-reports');

//kickoff meeting reports
Route::get('/reports-me/cg/kick-off-meeting', 'KickOffController@view')->name('reports-me/cg/kick-off-meeting')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/kick-off-meeting/fetch', 'KickOffController@fetch')->name('reports-me/cg/kick-off-meeting/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/kick-off/{id}/view', 'KickOffController@view_meeting')->name('kick-off-view')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/hhs/{id}/view', 'KickOffController@view_hhs')->name('kick-off-view')->middleware('can:view-M&E-reports');
Route::get('/download/kick-off/{file_name}', 'KickOffController@download')->name('kick-off-view')->middleware('can:view-M&E-reports');
Route::get('/download/kick-off/photos/{id}', 'KickOffController@download_photos')->middleware('can:view-M&E-reports');


//cg reports
Route::get('/reports-me/cg/cg', 'CarrerGuidanceController@view')->name('reports-me/cg/cg')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/cg/fetch', 'CarrerGuidanceController@fetch')->name('reports-me/cg/cg/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/cg/{id}/view', 'CarrerGuidanceController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/{file_name}', 'CarrerGuidanceController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/photos/{id}', 'CarrerGuidanceController@download_photos')->middleware('can:view-M&E-reports');


//pes reports
Route::get('/reports-me/cg/pes', 'PesUnitController@view')->name('reports-me/cg/pes')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/pes/fetch', 'PesUnitController@fetch')->name('reports-me/cg/pes/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/pes/{id}/view', 'PesUnitController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');

//pes supports
Route::get('/reports-me/cg/pes-support', 'PesUnitSupportController@view')->name('reports-me/cg/pes-support')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/pes-support/fetch', 'PesUnitSupportController@fetch')->name('reports-me/cg/pes-support/fetch')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/pes-support/fetch', 'PesUnitSupportController@fetch')->name('reports-me/cg/pes-support/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/pes-support/{id}/view', 'PesUnitSupportController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/pes-support/{id}', 'PesUnitSupportController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/pes-support/photos/{id}', 'PesUnitSupportController@download_photos')->middleware('can:view-M&E-reports');

//CG Training
Route::get('/reports-me/cg/cg-training', 'CGtrainingController@view')->name('reports-me/cg/cg-training')->middleware('can:view-M&E-reports');
Route::post('/reports-me/cg/cg-training/fetch', 'CGtrainingController@fetch')->name('reports-me/cg/cg-training/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/cg-training/{id}/view', 'CGtrainingController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg-training/{file_name}', 'CGtrainingController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg-training/photos/{id}', 'CGtrainingController@download_photos')->middleware('can:view-M&E-reports');
Route::get('/download/cg-training/test/{id}', 'CGtrainingController@download_test')->middleware('can:view-M&E-reports');


//gvt Training
Route::get('/reports-me/skill/gvt-support', 'CourseSupportController@view')->name('reports-me/skill/gvt-support')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/gvt-support/fetch', 'CourseSupportController@fetch')->name('reports-me/skill/gvt-support/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/gvt-support/{id}/view', 'CourseSupportController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');

//soft skill Training
Route::get('/reports-me/skill/soft-skill', 'ProvideSoftskillController@view')->name('reports-me/skill/soft-skill')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/soft-skill/fetch', 'ProvideSoftskillController@fetch')->name('reports-me/skill/soft-skill/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/soft-skill/{id}/view', 'ProvideSoftskillController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/soft-skill/{file_name}', 'ProvideSoftskillController@download')->name('cg-view')->middleware('can:view-M&E-reports');

//finacial support
Route::get('/reports-me/skill/financial', 'FinancialSupportController@view')->name('reports-me/skill/soft-skill')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/financial/fetch', 'FinancialSupportController@fetch')->name('reports-me/skill/financial/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/financial/{id}/view', 'FinancialSupportController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/financial/{file_name}', 'FinancialSupportController@download')->name('cg-view')->middleware('can:view-M&E-reports');

//partnership
Route::get('/reports-me/skill/partnership', 'PartnershipTrainingController@view')->name('reports-me/skill/partnership')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/partnership/fetch', 'PartnershipTrainingController@fetch')->name('reports-me/skill/partnership/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/partnership/{id}/view', 'PartnershipTrainingController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/partnership/{file_name}', 'PartnershipTrainingController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/partnership/group-photo/{file_name}', 'PartnershipTrainingController@group')->name('cg-view')->middleware('can:view-M&E-reports');

//institute review
Route::get('/reports-me/skill/institute-review', 'InstituteReviewController@view')->name('reports-me/skill/institute-review')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/institute-review/fetch', 'InstituteReviewController@fetch')->name('reports-me/skill/institute-review/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/institute-review/{id}/view', 'InstituteReviewController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/institute-review/{file_name}', 'InstituteReviewController@download')->name('cg-view')->middleware('can:view-M&E-reports');

//Incoperation Soft Skill
Route::get('/reports-me/skill/incoperate-soft-skills', 'IncoperationSoftSkillController@view')->name('reports-me/skill/incoperate-soft-skills')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/incoperate-soft-skills/fetch', 'IncoperationSoftSkillController@fetch')->name('reports-me/skill/incoperate-soft-skills/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/incoperate-soft-skills/{id}/view', 'IncoperationSoftSkillController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/incoperate-soft-skills/{file_name}', 'IncoperationSoftSkillController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/incoperate-soft-skills/photos/{id}', 'IncoperationSoftSkillController@download_photos')->middleware('can:view-M&E-reports');

//TVEC Meeting
Route::get('/reports-me/skill/tvec-meeting', 'TvecMeetingController@view')->name('reports-me/skill/tvec-meeting')->middleware('can:view-M&E-reports');
Route::post('/reports-me/skill/tvec-meeting/fetch', 'TvecMeetingController@fetch')->name('reports-me/skill/tvec-meeting/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/skill/tvec-meeting/{id}/view', 'TvecMeetingController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/tvec-meeting/{file_name}', 'TvecMeetingController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/tvec-meeting/photos/{id}', 'TvecMeetingController@download_photos')->middleware('can:view-M&E-reports');
Route::get('/download/tvec-meeting/minute/{id}', 'TvecMeetingController@download_minute')->middleware('can:view-M&E-reports');


//Workplace assesment
Route::get('/reports-me/job/assesment', 'AssesmentController@view')->name('reports-me/skill/assesment')->middleware('can:view-M&E-reports');
Route::post('/reports-me/job/assesment/fetch', 'AssesmentController@fetch')->name('reports-me/skill/assesment/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/job/assesment/{id}/view', 'AssesmentController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');

//Awareness
Route::get('/reports-me/job/awareness', 'AwarenessController@view')->name('reports-me/job/awareness')->middleware('can:view-M&E-reports');
Route::post('/reports-me/job/awareness/fetch', 'AwarenessController@fetch')->name('reports-me/job/awareness/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/job/awareness/{id}/view', 'AwarenessController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/awareness/{file_name}', 'AwarenessController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/awareness/photos/{id}', 'AwarenessController@download_photos')->middleware('can:view-M&E-reports');
Route::get('/download/awareness/test/{id}', 'AwarenessController@download_test')->middleware('can:view-M&E-reports');

//job placement
Route::get('/reports-me/job/placements', 'PlacementController@view')->name('reports-me/job/placements')->middleware('can:view-M&E-reports');
Route::post('/reports-me/job/placements/fetch', 'PlacementController@fetch')->name('reports-me/job/placements/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/job/placements/{id}/view', 'PlacementController@view_meeting')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/reports-me/job/ind-placements/{id}/view', 'PlacementController@view_meeting2')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/placements/{file_name}', 'PlacementController@download')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/placements/photos/{id}', 'PlacementController@download_photos')->middleware('can:view-M&E-reports');
Route::get('/download/placements/attendance/{id}', 'PlacementController@download_e_attendance')->middleware('can:view-M&E-reports');

//tot
Route::get('/reports-me/cg/tot', 'CarrerGuidanceController@view_tot')->name('reports-me/cg/tot')->middleware('can:view-M&E-reports');
Route::post('/reports-me/jcg/tot/fetch', 'CarrerGuidanceController@fetch_tot')->name('reports-me/cg/tot/fetch')->middleware('can:view-M&E-reports');
Route::get('/reports-me/cg/tot/{id}/view', 'CarrerGuidanceController@view_meeting_tot')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/tot/{file_name}', 'CarrerGuidanceController@download_tot')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/tot/tr/{file_name}', 'CarrerGuidanceController@download_tr')->name('cg-view')->middleware('can:view-M&E-reports');
Route::get('/download/cg/tot/photos/{id}', 'CarrerGuidanceController@download_photos_tot')->middleware('can:view-M&E-reports');


//audits
Route::get('/audits', 'AuditContrller@index')->middleware('can:admin');
Route::post('/audit/fetch', 'AuditContrller@fetch')->name('audit/fetch')->middleware('can:admin');

//verify reports

Route::post('/verify/report', 'ProgressController@verify')->middleware('can:verify-report');

//edit m and e reports
Route::get('/reports-me/regional/{id}/edit', 'RegionalMeetingController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/education/edit-meeting', 'RegionalMeetingController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/education/update-meeting', 'RegionalMeetingController@update_participants')->middleware('can:edit-M&E-reports');
Route::post('/activity/education/add-part', 'RegionalMeetingController@add_participants')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/stake/{id}/edit', 'StakeHolderMeetingController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-stake-holder', 'StakeHolderMeetingController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-meeting', 'StakeHolderMeetingController@update_participants')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-part', 'StakeHolderMeetingController@add_participants')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/cg/{id}/edit', 'CarrerGuidanceController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/edit-cg', 'CarrerGuidanceController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-cg', 'CarrerGuidanceController@update_participants')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-part-cg', 'CarrerGuidanceController@add_participants')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-youth', 'CarrerGuidanceController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-youth-cg', 'CarrerGuidanceController@add_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-req', 'CarrerGuidanceController@update_req')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-cts', 'CarrerGuidanceController@update_cts')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/kick-off/{id}/edit', 'KickOffController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activities/career-guidance/kick-off-edit', 'KickOffController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-kick-p', 'KickOffController@update_participants')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-part-kick', 'KickOffController@add_participants')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/pes/{id}/edit', 'PesUnitController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activities/career-guidance/pes-update', 'PesUnitController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-pes', 'PesUnitController@update_services')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/pes-support/{id}/edit', 'PesUnitSupportController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activities/career-guidance/pes-support-update', 'PesUnitSupportController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/update-pes-s', 'PesUnitSupportController@update_gaps')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-gap-pes', 'PesUnitSupportController@add_gaps')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/cg-training/{id}/edit', 'CGtrainingController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activities/career-guidance/cg-training-update', 'CGtrainingController@update')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/gvt-support/{id}/edit', 'CourseSupportController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/edit-course-support', 'CourseSupportController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-youth-support', 'CourseSupportController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-new-youth', 'CourseSupportController@add_youth')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/soft-skill/{id}/edit', 'ProvideSoftskillController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-provide-soft', 'ProvideSoftskillController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/add-new-ss-youth', 'ProvideSoftskillController@add_youth')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-youth-soft', 'ProvideSoftskillController@update_youths')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/financial/{id}/edit', 'FinancialSupportController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-finacial-support', 'FinancialSupportController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-youth-finacial', 'FinancialSupportController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-new-finacial-youth', 'FinancialSupportController@add_youth')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/partnership/{id}/edit', 'PartnershipTrainingController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-partnership', 'PartnershipTrainingController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-youth-partnership', 'PartnershipTrainingController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-new-partnership-youth', 'PartnershipTrainingController@add_youth')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/review/{id}/edit', 'InstituteReviewController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-institute-review', 'InstituteReviewController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-review', 'InstituteReviewController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-review', 'InstituteReviewController@add_youth')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/incorporation/{id}/edit', 'IncoperationSoftSkillController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-incoperation', 'IncoperationSoftSkillController@update')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/assesment/{id}/edit', 'AssesmentController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/job-linking/update-assesment', 'AssesmentController@update')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/awareness/{id}/edit', 'AwarenessController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/job-linking/update-awareness', 'AwarenessController@update')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/placement/{id}/edit', 'PlacementController@edit')->middleware('can:edit-M&E-reports');
Route::post('/activity/job-linking/update-placement', 'PlacementController@update')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-employer', 'PlacementController@update_employers')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/add-new-employer', 'PlacementController@add_employer')->middleware('can:edit-M&E-reports');
Route::post('/activity/skill/update-youth-placement', 'PlacementController@update_youths')->middleware('can:edit-M&E-reports');
Route::post('/activity/cg/add-new-placement-youth', 'PlacementController@add_youth')->middleware('can:edit-M&E-reports');

Route::get('/reports-me/individual/{id}/edit', 'PlacementController@edit_i')->middleware('can:edit-M&E-reports');
Route::post('/activity/job-linking/update-individual', 'PlacementController@update_i')->middleware('can:edit-M&E-reports');

Route::get('/stake-holders', 'StakeHolderMeetingController@participants')->middleware('can:view-M&E-reports');

Route::get('/completion_targets', 'ProgressController@completion_targets')->middleware('can:admin');
Route::post('/completion_targets-add', 'ProgressController@completion_targets_add')->middleware('can:admin');
Route::post('/completion_targets-update', 'ProgressController@completion_targets_update')->middleware('can:admin');
Route::get('/baselines', 'ProgressController@baselines')->name('baselines');
Route::get('/youth_progress', 'CarrerGuidanceController@youth_progress')->name('youth_progress');
Route::get('/financial-youth', 'FinancialSupportController@view_youths')->name('financial_youth');


Route::get('event', function () {
    event(new userLogin('User Logged'));
});



});