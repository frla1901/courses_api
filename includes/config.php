<?php 
/* 
* Konfiguration för databasanslutning
*/

// variabel under uveckling av webbtjänst - sätts till false vid publicering
$devMode = false;

// Fel rapportering under utveckling (devMode)
if($devMode) {
error_reporting(-1);
ini_set("display_errors", 1);
}

// autoupload - inkluderar/laddar alla klasser i katalogen classes
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

if($devMode) {
// db inställningar när lokalt (localhost)
define("DBHOST", "localhost");
define("DBUSER", "rest");
define("DBPASS", "Password");
define("DBDATABASE", "moment5");

} else {
// db inställningar publikt (inleed webhotel - domain frida360)
define("DBHOST", "localhost");
define ("DBUSER", "frida360_admin-api");
define ("DBPASS", "dt173g_moment5_2021");
define("DBDATABASE", "frida360_courses-api");
}
?>
