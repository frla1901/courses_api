# dt173g_moment5_steg1 

## Skapande av REST-webbtjänsten courses_api

## Syftet 

### Denna webbtjänst har som syfte att hantera information om kurser jag genomfört. Informationen om kurserna är följande:
* **id (id)** 
* **Kurskod (courseCode)** 
* **Kursnamn (courseName)**
* **Progression (progression)**
* **Kursplan (courseSyllabus)**

## Funktionalitet

### Följande funktionalitet ska finnas i din lösning för godkänt:

1. Webbtjänst skapad enligt kraven ovan. Data från webbtjänsten ska presenteras i JSON-format.
2. Implementerat CRUD (Create Read Update Delete) som använder följande verb: GET, POST, PUT och DELETE.
3. Webbtjänsten ska vara publicerad på publikt tillgänglig webbhost, med möjlighet till "cross origin request). Det ska vara möjligt att testköra din webbtjänst från annan domän än den du publicerat till.
4. Källkoden ska vara väl kommenterad, och publicerad till ett online repository som exempelvis Github eller Git bucket.
5. En README-fil ska finnas i ditt repo som beskriver din webbtjänst, samt inkluderar URI's (webblänkar) för att använda CRUD.

**OBS!**
I steg 1 av moment 5 har jag inte använt gulp utan arbetat lokalt med Mamp, phpmyAdmin, VSC samt testkört i webbläsaren Chrome samt med Advanced Rest Client. Publiceringen gjordes genom mitt webbhotell hos Inleed, phpmyAdmin samt FilwZilla (ftp överföring av filer) och därefter testkördes allt igen i webbläsaren Chrome samt med Advanced Rest Client.

**Grund**
Jag hade sen kursen DT162G - Javascriptbaserad webbutveckling, en halvklar JSON-fil med kurser som jag initialt justerade för att ha all information som ska finnas med i webbtjänsten. Denna kommer inte att användas som något annat än ett underlag men hjälpte mig att strukturera upp vilka olika delar som ska inkluderas. 

Därefter klonade jag ner det repo som fanns under teori och läshänvisningar för att ha en grund att utgå ifrån. Valde att döpa om den till api.php istället för rest.php.
[https://github.com/MallarMiun/Grund-for-webbtjanst.git](https://github.com/MallarMiun/Grund-for-webbtjanst.git) 


**1.**
När jag testat att api.php fungerade skapade jag en databas lokalt på datorn _"moment5"_ med en databas användare: _"rest"_ och lösenord: _"Password"_ dock utan några tabeller. 
Gjorde allt som ett test initialt och följde de videos som fanns under teori och läshänvisningar samt mötestider. Skapade en mapp includes för att kunna inkludera filer. Där placerade jag en fil config.php som bland annat innehåller inställningar för databasanslutning under utveckling devMode samt vid publicering. 

Därefter skapade jag en install-fil samt en .htaccess fil. I install.php finns mysqli databasanslutning samt sql frågor som dels skapar tabellen courses samt lägger till rader i tabellen. Denna fil kan användas av alla som vill testa. 

När jag fått det att fungera i testet så gick jag vidare till att skapa CRUD funktionaliteten. 

**2.** 
Skapade först en mapp classes i includes mappen och där jag påbörjad arbetet med filen Course.class.php. Denna fil innehåller metoder och funktioner som sen ska användas i webbtjänsten. Se nedan funktionsspecifikation: 
* Lägg till kurs (POST) använder SQL fråga INSERT 
* Uppdatera kurs (PUT) använder SQL fråga UPDATE samt parametern id.
* Hämta alla kurser (GET) använder SQL fråga SELECT 
* Hämta en specifik kurs (GET) använder SQL fråga SELECT samt parametern id. 
* Radera en specifik kurs (DELETE) använder SQL frågan DELETE samt parametern id. 

Nästa steg var att arbeta med själva api filen för att kunna implementera CRUD. 
Klassen Course instantieras samt metoder för respektive verb GET, POST, PUT och DELETE tydliggör data i JSON format.

**3.**
Webbtjänsten är publicerad till mitt webbhotell där den kan testköras och användas. Se nedan länk samt information.
[https://www.frida360.se/courses-api/api]( https://www.frida360.se/courses-api/api)

**4.**
Koden komenterades löpande under arbete samt kontrollerades innan publicering. I detta repo finns alla källkodsfiler som använts. 

**5.**
Denna fil är skapad och fungerar som en beskrivning av min webbtjänst. 

För att använda CRUD följ länkarna nedan:

**C**reate = POST (ny kurs)
[https://www.frida360.se/courses-api/api]( https://www.frida360.se/courses-api/api)

**R**ead = GET (alla kurser)
[https://www.frida360.se/courses-api/api]( https://www.frida360.se/courses-api/api)

**U**pdate - PUT (en specifik kurs – id skickas med exempelvis 2)
[https://www.frida360.se/courses-api/api?id=2]( https://www.frida360.se/courses-api/api?id=2 ) 

**D**elete = DELETE (en specifik kurs – id skickas med exempelvis 2)
[https://www.frida360.se/courses-api/api?id=2]( https://www.frida360.se/courses-api/api?id=2 ) 

Read = GET (en specifik kurs – id skickas med exempelvis 2)
[https://www.frida360.se/courses-api/api?id=2]( https://www.frida360.se/courses-api/api?id=2 ) 




