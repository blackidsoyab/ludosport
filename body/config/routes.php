<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

include_once (APPPATH . 'helpers/inflector_helper.php');

$path = explode('/', $_SERVER['REQUEST_URI']);
if ($_SERVER['HTTP_HOST'] == 'www.myludosport.net') {
    $controller = $path[1];
} else {
    $controller = $path[2];
}

$route[$controller] = plural($controller) . "/view" . ucwords($controller);
$route[$controller . '/list'] = plural($controller) . "/view" . ucwords($controller);
$route[$controller . '/view/(:num)'] = plural($controller) . "/view" . ucwords($controller) . "/$1";
$route[$controller . '/view/(:num)/(:any)'] = plural($controller) . "/view" . ucwords($controller) . "/$1/$2";
$route[$controller . '/add'] = plural($controller) . "/add" . ucwords($controller);
$route[$controller . '/edit/(:num)'] = plural($controller) . "/edit" . ucwords($controller) . "/$1";
$route[$controller . '/delete/(:num)'] = plural($controller) . "/delete" . ucwords($controller) . "/$1";
$route[$controller . '/getjson'] = "json/get" . plural($controller) . "JsonData";
$route[$controller . '/getjson/(:any)'] = "json/get" . plural($controller) . "JsonData/$1";
$route[$controller . '/getjson/(:any)/(:any)'] = "json/get" . plural($controller) . "JsonData/$1/$2";

//Default
$route['default_controller'] = "dashboard";
$route['404_override'] = 'authenticate/error_404';

//Cron Jobs
$route['send_regular_mail'] = "cronjobs/sendRegularMail";

//Authenticate
$route['login'] = "authenticate/index";
$route['validate'] = "authenticate/validateUser";
$route['logout'] = "authenticate/logout";
$route['forgot_password'] = "authenticate/userForgotPassword";
$route['send_reset_password_link'] = "authenticate/userSendResetPasswordLink";
$route['reset_password/(:any)'] = "authenticate/userResetPassword/$1";
$route['checkusername/(:num)'] = "ajax/checkUsernameExit/$1";
$route['checkemail/(:num)'] = "ajax/checkEmailExit/$1";
$route['denied'] = "authenticate/permissionDenied";

//Registration
$route['register/step_1'] = "authenticate/register";
$route['add_user'] = "authenticate/saveUser";
$route['register/step_2'] = "dashboard/studentRegistrationSecondPhase";
$route['register_step_2/download/(:any)'] = "ajax/downloadRegistrationPdf/$1";

//Commom
$route['getstate/(:num)'] = "ajax/getAllStatesOptionsFromCountry/$1";
$route['getcity/(:num)'] = "ajax/getAllCitiesOptionsFromState/$1";
$route['checkNotification/(:num)'] = "ajax/checkNotification/$1";
$route['checkMessage/(:num)'] = "ajax/checkMessage/$1";
$route['load_more_notification/(:num)'] = "ajax/notificationPanigate/$1";
$route['class_details/(:num)/(:num)'] = "ajax/generateCalendatDates/$1/$2";

//Dashboard
$route['dashboard'] = "dashboard/index";
$route['change_language/(:any)'] = "ajax/setNewLanguage/$1";
$route['change_role/(:any)'] = "ajax/setNewRole/$1";
$route['mark_all_notification_read'] = "ajax/markAllNotificationRead";
$route['mark_all_message_read'] = "ajax/markAllMessageRead";

//Profile
$route['change_password'] = "profiles/changePassword";
$route['check_current_password'] = "ajax/checkCurrentPassword";

//System Setting
$route['system_setting/(:any)'] = "systemsettings/viewSystemSetting/$1";

//Permission
$route['permission/getmethod/(:any)/(:any)'] = "ajax/getMethodsFromControllers/$1/$2";
$route['permission/check/(:num)'] = "ajax/checkValidPermision/$1";

//Role
$route['role/check/(:num)'] = "ajax/checkValidRole/$1";

//Classes
$route['clan/getschools/(:num)'] = "ajax/getSchoolsOptionFromAcademy/$1";
$route['clan/getclasses/(:num)'] = "ajax/getClassesOptionFromSchool/$1";
$route['clan/trial_lesson_request'] = "clans/listTrialLessonRequest";
$route['clan/trial_lesson_request/(:num)'] = "clans/listTrialLessonRequest/$1";
$route['clan/listTrialLessonRequestJson'] = "json/getTrialLessonRequestJsonData";
$route['clan/listTrialLessonRequestJson/(:num)'] = "json/getTrialLessonRequestJsonData/$1";
$route['clan/change_status_trial_student/(:num)/(:num)'] = "clans/changeStatusTrialStudent/$1/$2";
$route['clan/change_status_trial_student/(:num)/(:num)/(:any)'] = "clans/changeStatusTrialStudent/$1/$2/$3";

//Teacher List => Admin , Rector, Dean, Teacher
$route['clan/teacherlist'] = "clans/clanTeacherList";
$route['clan/teacherlist/(:num)/(:any)'] = "clans/clanTeacherList/$1/$2";
$route['clan/teacherjson'] = "json/getTeachersJsonData";
$route['clan/teacherjson/(:any)'] = "json/getTeachersJsonData/$1";
$route['clan/teacherjson/(:any)/(:any)'] = "json/getTeachersJsonData/$1/$2";
$route['clan/teacherjson/(:any)/(:any)/(:any)'] = "json/getTeachersJsonData/$1/$2/$3";

//Student List => Admin , Rector, Dean, Teacher
$route['clan/studentlist'] = "clans/clanStudentList";
$route['clan/studentlist/(:num)/(:any)'] = "clans/clanStudentList/$1/$2";
$route['clan/studentjson'] = "json/getStudentsJsonData";
$route['clan/studentjson/(:any)'] = "json/getStudentsJsonData/$1";
$route['clan/studentjson/(:any)/(:any)'] = "json/getStudentsJsonData/$1/$2";
$route['clan/studentjson/(:any)/(:any)/(:any)'] = "json/getStudentsJsonData/$1/$2/$3";
$route['clan/change_date/(:num)'] = "clans/changeClanDate/$1";
$route['clan/delete_date/(:num)'] = "clans/deleteClanDate/$1";

//Admin Dashboard


//Dean Dashboard
$route['dean/absence_approval/(:num)'] = "deans/teacherAbsenceApproval/$1";
$route['dean/absence_approval/(:num)/(:any)'] = "deans/teacherAbsenceApproval/$1/$2";
$route['dean/change_recovery_teacher/(:num)'] = "deans/getSchoolTeachers/$1";
$route['dean/update_recovery_teacher'] = "deans/UpdateRecoverTeacher";

//Teacher Dashboard
$route['getclandates_teacher/(:num)'] = "clans/getDateOfClanForTeacher/$1";
$route['get_same_level_clan/(:num)'] = "clans/getSameLevelClans/$1";
$route['mark_student_absence_teacher'] = "clans/changeDateStudentByTeacher";
$route['clan/clan_attendance/(:num)/(:any)'] = "clans/clanAttendances/$1/$2";
$route['clan/save_attendance/(:num)'] = "clans/saveClanAttendances/$1";
$route['clan/next_week_attendance/(:num)'] = "clans/nextWeekAttendances/$1";
$route['teacher_mark_absence'] = "teachers/markAbsence";
$route['teacher/school_related_teacher/(:num)'] = "teachers/teachersReleatedSchool/$1";


//Student Dashboard
$route['student_mark_absence'] = "students/markAbsence";
$route['student/clan/(:num)/(:any)'] = "dashboard/studentClan/$1/$2";
$route['history'] = "students/viewHistory";
$route['history/load_more_timeline/(:num)'] = "ajax/timelinePanigate/$1";
$route['rating'] = "students/viewTopRating";
$route['rating_list'] = "students/viewRatingList";
$route['rating_list/(:any)'] = "students/viewRatingList/$1";
$route['duels'] = "students/viewDuels";
$route['duels/do_it'] = "students/challengeStudent";
$route['duels/json_data/(:num)/(:any)'] = "json/getDuelJsonData/$1/$2";
$route['duels/json_data/(:num)/(:any)/(:any)'] = "json/getDuelJsonData/$1/$2/$3";
$route['duels/view'] = "students/duelView";
$route['duels/view/(:any)'] = "students/duelView/$1";
$route['duels/single/(:num)'] = "students/duelSingleView/$1";
$route['duels/single/(:num)/(:any)'] = "students/duelSingleView/$1/$2";
$route['duels/declare_result_box/(:num)'] = "ajax/duelResultBox/$1";
$route['duels/declare_result'] = "students/duelResult";
$route['student/rating_list_json'] = "json/getRattingListJsonData";
$route['student/rating_list_json/(:any)'] = "json/getRattingListJsonData/$1";

//Pending Student
$route['getclanonlocation/(:num)'] = "ajax/getClanDetails/$1";
$route['getclandates/(:num)'] = "ajax/getDateForClan/$1";
$route['pending_student/save_trial_lesson'] = "dashboard/pendingStudnetSaveTrailLesson";

//Email Templates
$route['email/remove_attachment/(:num)'] = "emails/removeAttachment/$1";

//Message System
$route['message/compose'] = "messages/composeMessage";
$route['message/compose/(:any)'] = "messages/composeMessage/$1";
$route['message/sent'] = "messages/sentMessage";
$route['message/trash'] = "messages/trashMessage";
$route['message/read/(:num)'] = "messages/readMessage/$1";
$route['message/reply/(:num)'] = "messages/replyMessage/$1";
$route['message/delete'] = "messages/deleteMessage";
$route['message/attachmment/download/(:num)'] = "ajax/downloadAttachment/$1";

//Events
$route['event/invitation/(:num)'] = "events/sendEventInvitation/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */