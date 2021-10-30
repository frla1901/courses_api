<?php
/* Inkluderar konfigurationsfilen */
include_once("includes/config.php");

/* 
* Headers med inställningar för min REST webbtjänst - courses_api 
*/

// Gör att webbtjänsten går att komma åt från alla domäner (valde att ge alla (*) tillgång)
header('Access-Control-Allow-Origin: *');

// Talar om att webbtjänsten skickar data i JSON-format
header('Content-Type: application/json');

// De metoder som webbtjänsten accepterar, jag tillåter förutom GET även PUT, POST & DELETE.
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

// Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Läser in vilken metod som skickats och lagrar i en variabel
$method = $_SERVER['REQUEST_METHOD'];

// Om en parameter av id finns i urlen lagras det i en variabel
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

$course = new Course();

switch($method) {
    case 'GET':
        if(isset($id)) {
             // Skickar en "HTTP response status code"
            http_response_code(200); //Ok 

            // Hämta en specifik kurs
            $response = $course->getCourseById($id);
        } else {

        // Skickar en "HTTP response status code"
        http_response_code(200); // Ok

            // Hämtar alla kurser
            $response = $course->getAllCourses();
        }
        if(count($response)==0) {
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Tom array - inga kurser! (GET)");
        }

        break;
    case 'POST':
        // Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $input = json_decode(file_get_contents("php://input"));

        // Kontrollerar att input inte är tom
        if ($input->courseCode =="" || $input->courseName =="" || $input->progression =="" || $input->courseSyllabus =="") {
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Fyll i kurskod, kursnamn, progression samt länk till kursplan");
            
            // Skickar en "HTTP response status code"
            http_response_code(400); // Fel på klientsidan

        } else {
        // Lägger till kurs
        if($course->addCourse($input->courseCode, $input->courseName, $input->progression, $input->courseSyllabus)) {
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Kurs har skapats");

            // Skickar en "HTTP response status code"
            http_response_code(201); // Ok 

        } else {
            // Skickar en "HTTP response status code"
            http_response_code(500); // Fel på serversidan
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Något gick fel när kursen skulle skapas!");
        }
    }

        break;
    case 'PUT':
        // Om inget id är med skickat, skicka felmeddelande
        if(!isset($id)) {
            // Skickar en "HTTP response status code"
            http_response_code(400); // Fel på klientsidan 
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Inget id skickades med");
        // Om id är skickad   
        } else {
            $input = json_decode(file_get_contents("php://input"));

            // Kontrollerar att input inte är tom
            if ($input->courseCode =="" || $input->courseName =="" || $input->progression =="" || $input->courseSyllabus =="") {
                // Lagrar ett meddelande som sedan skickas tillbaka 
                $response = array("message" => "Fyll i kurskod, kursnamn, progression samt länk till kursplan");
                
                // Skickar en "HTTP response status code"
                http_response_code(400); // Fel på klientsidan
            } else {
            
            // Uppdaterar kurs
            $course->updateCourse($id, $input->courseCode, $input->courseName, $input->progression, $input->courseSyllabus);

            // Skickar en "HTTP response status code"
            http_response_code(200); // ok 
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Kursen med id $id uppdaterades");
            }
        }
            

        break;
    case 'DELETE':
        // Om inget id är med skickat, skicka felmeddelande
        if(!isset($id)) {
            // Skickar en "HTTP response status code"
            http_response_code(400); // Fel på klientsidan 
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Inget id skickades med");  
        // Om id är skickad 
        } else {

            // Tar bort kurs
            if($course->deleteCourse($id)) {
                // Skickar en "HTTP response status code"
                http_response_code(200); // ok
                // Lagrar ett meddelande som sedan skickas tillbaka 
                $response = array("message" => "Kursen med id $id raderades");  
            } else {

            // Skickar en "HTTP response status code"
            http_response_code(500); //  Fel på serversidan
            // Lagrar ett meddelande som sedan skickas tillbaka 
            $response = array("message" => "Kursen med id $id raderades inte");
        }
    }
        break;
        
}

//Skickar JSON svar tillbaka till avsändaren
echo json_encode($response); 