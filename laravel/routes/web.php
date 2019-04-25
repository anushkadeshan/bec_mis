<?php
use Illuminate\Support\Facades\Input;
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

