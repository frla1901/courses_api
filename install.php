<?php 
/* 
* Installationsfil för databas 
*/

// Inkludera configurationsfilen
include("includes/config.php");

// Anslut till db
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
// Om fel vid anslutning till db
if($db->connect_errno > 0) {
    die('Fel vid anslutning [' . $db->connect_error . ']');
}
/* Sql fråga A
* 1. Ta bort tabell om den finns. 
* 2. Skapa tabell 
*/
$sql = "DROP TABLE IF EXISTS courses;
    CREATE TABLE courses(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    courseCode VARCHAR(64) NOT NULL,
    courseName VARCHAR(64) NOT NULL,
    progression VARCHAR(64) NOT NULL,
    courseSyllabus VARCHAR(255) NOT NULL);
";
/* Sql fråga B
* Lägg olika kurser i tabellen
*/
$sql .= "
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT057G', 'Webbutveckling I', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT093G', 'Webbutveckling II', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27133');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT173G', 'Webbutveckling III', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22706');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT084G', 'Introduktion till programmering i JavaScript', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30811');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT162G', 'Javascript-baserad webbutveckling', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24366');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT003G', 'Databaser', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=21595');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('GD008G', 'Typografi och form för webb', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24399');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT163G', 'Digital bildbehandling för webb', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24403');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT152G', 'Webbdesign för CMS', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22324');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('DT068G', 'Webbanvändbarhet', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30563');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('IK060G', 'Projektledning', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27003');
INSERT INTO courses(courseCode,courseName,progression,courseSyllabus) VALUES('IG021G', 'Affärsplaner och kommersialisering', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22183');
";

echo "<pre>$sql</pre>";

// Skriver ut resultat av båda $sql
if($db->multi_query($sql)) {
    echo "<p>Tabeller installerade. </p>";
} else {
    echo "<p>Något gick fel vid installation av tabeller</p>";
}