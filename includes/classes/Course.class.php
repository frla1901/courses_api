<?php
/* 
* Course klass 
* DT173G - Webbutveckling III - Moment 5 
* Created by Frida Lazzari oktober 2021. 
*/

class Course {
    private $db;
    private $courseCode;
    private $courseName;
    private $progression;
    private $courseSyllabus;

    // Constructor - med db anslutning samt stopp & felmeddelande om anlutningsfel
    public function __construct(){
        // MySqli anslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        // Kontrollera anslutningen
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning" . $this->db->connect_error);
        }
    }

    // courseCode metoder
    public function getCourseCode(): string {
        return $this->courseCode;
    }
    public function setCourseCode(string $courseCode): void {
        $this->courseCode = $this->db->real_escape_string($courseCode);
    }

    // courseName metoder
    public function getCourseName(): string {
        return $this->courseName;
    }
    public function setCourseName(string $courseName): void {
        $this->courseName = $this->db->real_escape_string($courseName);
    }

     // progression metoder
    public function getProgression(): string {
        return $this->progression;
    }
    public function setProgression(string $progression): void {
        $this->progression = $this->db->real_escape_string($progression);
    }

    // courseSyllabus metoder
    public function getCourseSyllasbus(): string {
        return $this->courseSyllabus;
    }
    public function setCourseSyllabus(string $courseSyllabus): void {
        $this->courseSyllabus = $this->db->real_escape_string($courseSyllabus);
    }

    /** 
    * Lägg till Kurs
    * @param string $courseCode
    * @param string $courseName
    * @param string $progression
    * @param string $courseSyllabus
    * @return boolean
    */
    public function addCourse(string $courseCode, string $courseName, string $progression, string $courseSyllabus) :bool {
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->progression = $progression;
        $this->courseSyllabus = $courseSyllabus;
    
        // Förbered statement 
        $stmt = $this->db->prepare("INSERT INTO courses(courseCode, courseName, progression, courseSyllabus) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $this->courseCode, $this->courseName, $this->progression, $this->courseSyllabus);

        // Genomför statement som returnerar sant eller falskt
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        // stäng statement
        $stmt->close();
    } 
    

    /** 
    * Uppdatera kurs
    * @param int $id
    * @param string $courseCode
    * @param string $courseName
    * @param string $progression
    * @param string $courseSyllabus
    * @return boolean
    */
    public function updateCourse(int $id, string $courseCode, string $courseName, string $progression, string $courseSyllabus) :bool {
        $id = intval($id);
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->progression = $progression;
        $this->courseSyllabus = $courseSyllabus;

        // Förbered statement 
        $stmt = $this->db->prepare("UPDATE courses SET courseCode=?, courseName=?, progression=?, courseSyllabus=? WHERE id=$id;");
        $stmt->bind_param("ssss", $this->courseCode, $this->courseName, $this->progression, $this->courseSyllabus);

        // Genomför statement som returnerar sant eller falskt
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        // Stäng statement
        $stmt->close();
    } 
    

    /** 
    * Hämta alla kurser
    * @return array
    */
    public function getAllCourses() : array {
        // Sql fråga sorteras på A eller B kurs
        $sql = "SELECT * FROM courses ORDER BY progression;";
        $result = $this->db->query($sql);

        // Returnera som associativ array genom att använda fetch 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**  
    * Hämta specifik kurs genom id
    * @param int $id
    * @return array
    */
    public function getCourseById(int $id) : array {
        $id = intval($id);

        // Sql fråga som tar id som parameter
        $sql = "SELECT * FROM courses WHERE id=$id;";
        $result = $this->db->query($sql);

        // returnera som associativ array genom att använda fetch 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**  
    * Radera kurs genom id
    * @param int $id
    * @return boolean
    */
    public function deleteCourse(int $id) : bool {
        $id = intval($id);

        //sql fråga som tar id som parameter
        $sql = "DELETE FROM courses WHERE id=$id;";
        $result = $this->db->query($sql);

        // returnerar sant eller falskt
        return $result;
    }

    
}
