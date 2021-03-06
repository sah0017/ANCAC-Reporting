<?php
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
        $page_title = 'ANCAC Network Calendar';

/**
 * Does various initialization tasks and includes all needed files.
 *
 * This page is included by most WebCalendar pages as the only include file.
 * This greatly simplifies the other PHP pages since they don't need to worry
 * about what files it includes.
 *
 * <b>Comments:</b>
 * The following scripts do not use this file:
 * - login.php
 * - week_ssi.php
 * - upcoming.php
 * - tools/send_reminders.php
 *
 * How to use:
 * 1. call include_once 'includes/init.php'; at the top of your script.
 * 2. call any other functions or includes not in this file that you need
 * 3. call the print_header function with proper arguments
 *
 * What gets called:
 *
 * - include_once 'includes/config.php';
 * - include_once 'includes/php-dbi.php';
 * - include_once 'includes/functions.php';
 * - include_once "includes/$user_inc";
 * - include_once 'includes/validate.php';
 * - include_once 'includes/connect.php';
 * - {@link load_global_settings()};
 * - {@link load_user_preferences()};
 * - include_once 'includes/translate.php';
 * - include_once 'includes/styles.php';
 *
 * Also, for month.php, day.php, week.php, week_details.php:
 * - {@link send_no_cache_header()};
 *
 * @version $Id: init.php,v 1.53.2.1 2005/07/14 23:00:37 cknudsen Exp $
 * @package WebCalendar
 *
 */

// Security Check
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
  die ( "You can't access this file directly!" );
}

// Make sure another app in the same domain doesn't have a 'user' cookie
if ( empty ( $HTTP_GET_VARS ) ) $HTTP_GET_VARS = $_GET;
if ( empty ( $HTTP_POST_VARS ) ) $HTTP_POST_VARS = $_POST;
if ( ( ! empty ( $HTTP_GET_VARS ) && empty ( $HTTP_GET_VARS['user'] ) ) &&
  ( ! empty ( $HTTP_POST_VARS ) && empty ( $HTTP_POST_VARS['user'] ) ) &&
  isset ( $GLOBALS['user'] ) ) {
  unset ( $GLOBALS['user'] );
}

// Get script name
$self = $_SERVER['PHP_SELF'];
if ( empty ( $self ) )
  $self = $PHP_SELF;
preg_match ( "/\/(\w+\.php)/", $self, $match);
$SCRIPT = $match[1];

// Several files need a no-cache header and some of the same code
$special = array('month.php', 'day.php', 'week.php', 'week_details.php', 'year.php');
$DMW = in_array($SCRIPT, $special);

// Unset some variables that shouldn't be set
unset($user_inc);
 
include_once 'includes/config.php';
include_once 'includes/php-dbi.php';
include_once 'includes/functions.php';
include_once "includes/$user_inc";
include_once 'includes/validate.php';
include_once 'includes/connect.php';

load_global_settings ();

if ( empty ( $ovrd ) )
  load_user_preferences ();

include_once 'includes/translate.php';

// error-check some commonly used form variable names
$id = getValue ( "id", "[0-9]+", true );
$user = getValue ( "user", "[A-Za-z0-9_\.=@,\-]*", true );
$date = getValue ( "date", "[0-9]+" );
$year = getValue ( "year", "[0-9]+" );
$month = getValue ( "month", "[0-9]+" );
$hour = getValue ( "hour", "[0-9]+" );
$minute = getValue ( "minute", "[0-9]+" );
$cat_id = getValue ( "cat_id", "[0-9]+" );
$friendly = getValue ( "friendly", "[01]" );
if ( empty ( $public_access ) )
  $public_access = 'N';

// Load if $SCRIPT is in $special array:
if ($DMW) {
  
  // Tell the browser not to cache
  send_no_cache_header ();

  if ( $allow_view_other != 'Y' && ! $is_admin )
    $user = "";

  $can_add = ( $readonly == "N" || $is_admin == "Y" );
  if ( $public_access == "Y" && $login == "__public__" ) {
    if ( $public_access_can_add != "Y" )
      $can_add = false;
    if ( $public_access_others != "Y" )
      $user = ""; // security precaution
  }

  if ( $groups_enabled == "Y" && $user_sees_only_his_groups == "Y" &&
    ! $is_admin ) {
    $valid_user = false;
    $userlist = get_my_users();
    if ($nonuser_enabled == "Y" ) {
      $nonusers = get_nonuser_cals ();
      $userlist =  array_merge($nonusers, $userlist);
    }
    for ( $i = 0; $i < count ( $userlist ); $i++ ) {
      if ( $user == $userlist[$i]['cal_login'] ) $valid_user = true;
    } 
    if ($valid_user == false) { 
      $user = ""; // security precaution
    }
  }

  if ( ! empty ( $user ) ) {
    $u_url = "user=$user&amp;";
    user_load_variables ( $user, "user_" );
    if ( $user == "__public__" )
      $user_fullname = translate ( $PUBLIC_ACCESS_FULLNAME );
  } else {
    $u_url = "";
    $user_fullname = $fullname;
    if ( $login == "__public__" )
      $user_fullname = translate ( $PUBLIC_ACCESS_FULLNAME );
  }

  set_today($date);

  if ( $categories_enabled == "Y" ) {
    if ( ! empty ( $cat_id ) ) {
      $cat_id = $cat_id;
    } elseif ( ! empty ( $CATEGORY_VIEW ) ) {
      $cat_id = $CATEGORY_VIEW;
    } else {
      $cat_id = '';
    }
  } else {
    $cat_id = '';
  }
  if ( empty ( $cat_id ) )
    $caturl = "";
  else
    $caturl = "&amp;cat_id=$cat_id";
}

/** Maps page filenames to the id that page's <body> tag will have
 *
 * @global array $bodyid
 */
$bodyid = array(
 "activity_log.php" => "activitylog",
 "add_entry.php" => "addentry",
 "admin.php" => "admin",
 "adminhome.php" => "adminhome",
 "approve_entry.php" => "approveentry",
 "assistant_edit.php" => "assistantedit",
 "category.php" => "category",
 "day.php" => "day",
 "del_entry.php" => "delentry",
 "del_layer.php" => "dellayer",
 "edit_entry.php" => "editentry",
 "edit_layer.php" => "editlayer",
 "edit_nonusers.php" => "editnonusers",
 "edit_nonusers_handler.php" => "editnonusershandler",
 "edit_report.php" => "editreport",
 "edit_template.php" => "edittemplate",
 "edit_user.php" => "edituser",
 "edit_user_handler.php" => "edituserhandler",
 "export.php" => "export",
 "group_edit.php" => "groupedit",
 "group_edit_handler.php" => "groupedithandler",
 "groups.php" => "groups",
 "help_admin.php" => "helpadmin",
 "help_bug.php" => "helpbug",
 "help_edit_entry.php" => "helpeditentry",
 "help_import.php" => "helpimport",
 "help_index.php" => "helpindex",
 "help_layers.php" => "helplayers",
 "help_pref.php" => "helppref",
 "import.php" => "import",
 "index.php" => "index",
 "layers.php" => "layers",
 "layers_toggle.php" => "layerstoggle",
 "list_unapproved.php" => "listunapproved",
 "login.php" => "login",
 "month.php" => "month",
 "nonusers.php" => "nonusers",
 "pref.php" => "pref",
 "publish.php" => "publish",
 "purge.php" => "purge",
 "reject_entry.php" => "rejectentry",
 "report.php" => "report",
 "search.php" => "search",
 "select_user.php" => "selectuser",
 "set_entry_cat.php" => "setentrycat",
 "users.php" => "users",
 "usersel.php" => "usersel",
 "view_d.php" => "viewd",
 "view_entry.php" => "viewentry",
 "view_l.php" => "viewl",
 "view_m.php" => "viewm",
 "view_t.php" => "viewt",
 "view_v.php" => "viewv",
 "view_w.php" => "vieww",
 "views.php" => "views",
 "views_edit.php" => "viewsedit",
 "week.php" => "week",
 "week_details.php" => "weekdetails",
 "week_ssi.php" => "weekssi",
 "year.php" => "year"
);

/**
 * Prints the HTML header and opening HTML body tag.
 *
 * @param array  $includes     Array of additional files to include referenced
 *                             from the includes directory
 * @param string $HeadX        Data to be printed inside the head tag (meta,
 *                             script, etc)
 * @param string $BodyX        Data to be printed inside the Body tag (onload
 *                             for example)
 * @param bool   $disbleCustom Do not include custom header? (useful for small
 *                             popup windows, such as color selection)
 * @param bool   $disableStyle Do not include the standard css?
 */
function print_header($includes = '', $HeadX = '', $BodyX = '',
  $disableCustom=false, $disableStyle=false) {
  global $application_name;
  global $FONTS,$WEEKENDBG,$THFG,$THBG,$PHP_SELF;
  global $TABLECELLFG,$TODAYCELLBG,$TEXTCOLOR;
  global $POPUP_FG,$BGCOLOR;
  global $LANGUAGE;
  global $CUSTOM_HEADER, $CUSTOM_SCRIPT;
  global $friendly;
  global $bodyid, $self;
  $lang = '';
  if ( ! empty ( $LANGUAGE ) )
    $lang = languageToAbbrev ( $LANGUAGE );
  if ( empty ( $lang ) )
    $lang = 'en';

 // Start the header & specify the charset
 // The charset is defined in the translation file
require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/networkcalendar/includes/header2.php");


 if ( ! empty ( $LANGUAGE ) ) {
   $charset = translate ( "charset" );
   if ( $charset != "charset" ) {
     echo "<?xml version=\"1.0\" encoding=\"$charset\"?>\n" .
       "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
       "\"DTD/xhtml1-transitional.dtd\">\n" .
       "<html xmlns=\"http://www.w3.org/1999/xhtml\" " .
       "xml:lang=\"$lang\" lang=\"$lang\">\n" .
       "<head>\n" .
       "<meta http-equiv=\"Content-Type\" content=\"text/html; " .
       "charset=$charset\" />\n";
     echo "<title>".translate($application_name)."</title>\n";
   } else {
     echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n" .
       "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
       "\"DTD/xhtml1-transitional.dtd\">\n" .
       "<html xmlns=\"http://www.w3.org/1999/xhtml\" " .
       "xml:lang=\"en\" lang=\"en\">\n" .
       "<head>\n" .
       "<title>".translate($application_name)."</title>\n";
   }
 }

 // Any other includes?
 if ( is_array ( $includes ) ) {
   foreach( $includes as $inc ){
     include_once 'includes/'.$inc;
   }
 }

  // Do we need anything else inside the header tag?
  if ($HeadX) echo $HeadX."\n";

  // Include the styles
  if ( ! $disableStyle ) {
    include_once 'includes/styles.php';
  }

  // Add custom script/stylesheet if enabled
  if ( $CUSTOM_SCRIPT == 'Y' && ! $disableCustom ) {
    $res = dbi_query (
      "SELECT cal_template_text FROM webcal_report_template " .
      "WHERE cal_template_type = 'S' and cal_report_id = 0" );
    if ( $res ) {
      if ( $row = dbi_fetch_row ( $res ) ) {
        echo $row[0];
      }
      dbi_free_result ( $res );
    }
  }

  // Include includes/print_styles.css as a media="print" stylesheet. When the
  // user clicks on the "Printer Friendly" link, $friendly will be non-empty,
  // including this as a normal stylesheet so they can see how it will look 
  // when printed. This maintains backwards-compatibility for browsers that 
  // don't support media="print" stylesheets
  echo "<link rel=\"stylesheet\" type=\"text/css\"" . ( empty ( $friendly ) ? " media=\"print\"" : "" ) . " href=\"includes/print_styles.css\" />\n";

  // Link to favicon
  echo "<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\" />\n";

  // Finish the header
  echo "</head>\n<body";

  // Find the filename of this page and give the <body> tag the corresponding id
  $thisPage = substr($self, strrpos($self, '/') + 1);
  if ( isset( $bodyid[$thisPage] ) )
    echo " id=\"" . $bodyid[$thisPage] . "\"";

  // Add any extra parts to the <body> tag
  if ( ! empty( $BodyX ) )
    echo " $BodyX";
  echo ">\n";

  echo "<div align=center>\n";
  echo "<table border=0 width=80% id=table331>\n";
  echo "<tr><td>\n";
  // Add custom header if enabled
  if ( $CUSTOM_HEADER == 'Y' && ! $disableCustom ) {
    $res = dbi_query (
      "SELECT cal_template_text FROM webcal_report_template " .
      "WHERE cal_template_type = 'H' and cal_report_id = 0" );
    if ( $res ) {
      if ( $row = dbi_fetch_row ( $res ) ) {
        echo $row[0];
      }
      dbi_free_result ( $res );
    }
  }
}


/**
 * Prints the common trailer.
 *
 * @param bool $include_nav_links Should the standard navigation links be
 *                               included in the trailer?
 * @param bool $closeDb           Close the database connection when finished?
 * @param bool $disableCustom     Disable the custom trailer the administrator
 *                                has setup?  (This is useful for small popup
 *                                windows and pages being used in an iframe.)
 */
function print_trailer ( $include_nav_links=true, $closeDb=true,
  $disableCustom=false )
{
  global $CUSTOM_TRAILER, $c, $STARTVIEW;
  global $login, $user, $cat_id, $categories_enabled, $thisyear,
    $thismonth, $thisday, $DATE_FORMAT_MY, $WEEK_START, $DATE_FORMAT_MD,
    $readonly, $is_admin, $public_access, $public_access_can_add,
    $single_user, $use_http_auth, $login_return_path, $require_approvals,
    $is_nonuser_admin, $public_access_others, $allow_view_other,
    $views, $reports_enabled, $LAYER_STATUS, $nonuser_enabled,
    $groups_enabled, $fullname, $has_boss;
  

  if ( $include_nav_links ) {
    include_once "includes/trailer.php";
  }

  // Add custom trailer if enabled
  if ( $CUSTOM_TRAILER == 'Y' && ! $disableCustom && isset ( $c ) ) {
    $res = dbi_query (
      "SELECT cal_template_text FROM webcal_report_template " .
      "WHERE cal_template_type = 'T' and cal_report_id = 0" );
    if ( $res ) {
      if ( $row = dbi_fetch_row ( $res ) ) {
        echo $row[0];
      }
      dbi_free_result ( $res );
    }
  }

  if ( $closeDb ) {
    if ( isset ( $c ) )
      dbi_close ( $c );
    unset ( $c );
  }
}
?>
