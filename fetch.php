<?php

function debug_to_console($data) // Funktionen användes för att kunna debugga och printa ut information i konsolen.
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

if (isset($_POST['button1']) && !empty($_POST['inputValue'])) { // Kontrollerar om knappen har klickats och det finns ett värde i fältet. 

    $value = $_POST['inputValue'];

    callAPI($value); // Anropar på callAPI-funktionen.
}

function callAPI($value)
{

    $curl = curl_init(); // Skapar en curlsession.

    // Inaktivera Secure Sockets Layer som används för att skydda känslig data vid internetanslutning. 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    // Bestämmer att resultatet ska vara en sträng av returvärdet för curl_exec(), istället för att mata ut den direkt på skärmen.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Definierar vilken url. 
    curl_setopt($curl, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/weather?q=" . urldecode($value));

    // Definierar api-nyckeln och kommer att användas vid förfrågan till både servern och proxyn. 
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'x-api-key: <<token>>',
    ));

    // Exekverar hämtningen och tilldelar det till variabeln result.  
    $result = curl_exec($curl);

    // Avslutar en curlsession. 
    curl_close($curl);

    if (!$result) {
        die("Hämtning misslyckad");
    } else {
        createDOMObjects(json_decode($result, true)); // Anropar på en ny funktion för att visa exporterad data.
    }
}

function createDOMObjects($result)
{

    // I denna tagg presenteras resultatet.
    $html = '<div id="weathercard" style="text-align: center" class="container">';

    $domDocument = new DOMDocument(); // Skapar ett nytt dokument
    $domDocument->loadHTML($html); // Ladda HTML-fil från en sträng
    $node = $domDocument->getElementById('weathercard'); // Hämtar div-elementet med id:T weathercard

    $elementDiv = $domDocument->createElement('div'); // Skapar en div-tagg
    $Title_element = $domDocument->createElement('h2', "Vädret i " . $result["name"] . ", " . $result["sys"]["country"]); // Skapar ett h2-element.
    $Title_element->setAttribute('style', "margin-top: -10px;"); // Sätter ett attribut till h2-elementet.
    $elementDiv->appendChild($Title_element);
    $node->appendChild($elementDiv);

    $elementDiv = $domDocument->createElement('div');
    $elementDiv->setAttribute('class', "justify-content-center row px-4 mb-3");
    $grad = intval($result['main']['temp'] - 273.15);
    $temp_element = $domDocument->createElement('h2', $grad . " °C");
    $img_element = $domDocument->createElement('img');
    $img_element->setAttribute('src', "http://openweathermap.org/img/w/" . $result['weather'][0]['icon'] . ".png");
    $elementDiv->appendChild($temp_element);
    $elementDiv->appendChild($img_element);
    $node->appendChild($elementDiv);

    $table_element = $domDocument->createElement("table");
    $table_element->setAttribute("class", "table-lg mb-5 my-4 row justify-content-center");
    $table_element->setAttribute("cellpadding", "10");
    $node->appendChild($table_element);

    $thead_element = $domDocument->createElement("thead");
    $table_element->appendChild($thead_element);

    // En for-loop som utför 7 varv (rader) och för varje varv så skapar vi ett tr, th och td element.
    // En if-sats används för att kunna hämta och presentera specifik data i en tabell.  */
    for ($x = 0; $x < 7; $x++) {

        $tr_element = $domDocument->createElement("tr");
        $th_element = $domDocument->createElement("th");
        $td_element = $domDocument->createElement("td");

        if ($x == 0) {
            $th_element->textContent = "Description (Beskrivning)";
            $td_element->textContent =  $result["weather"][0]['description'];
        }
        if ($x == 1) {
            $th_element->textContent = "Wind (Vind)";
            $td_element->textContent =  $result["wind"]['speed'] . " m/s";
        }
        if ($x == 2) {
            $th_element->textContent = "Pressure (Tryck)";
            $td_element->textContent = $result["main"]['pressure'] . " hpa";
        }
        if ($x == 3) {
            $th_element->textContent = "Humidity (Fuktighet)";
            $td_element->textContent = $result["main"]['humidity'] . " %";
        }
        if ($x == 4) {

            date_default_timezone_set("Europe/Stockholm");
            $unix = $result["sys"]['sunrise'];
            $date = date("Y-m-d H:i:s", $unix);

            $th_element->textContent = "Sunrise (Soluppgång)";
            $td_element->textContent = $date;
        }

        if ($x == 5) {

            $unix = $result["sys"]['sunset'];
            $date = date("Y-m-d H:i:s", $unix);

            $th_element->textContent = "Sunset (Solnedgång):";
            $td_element->textContent = $date;
        }

        if ($x == 6) {
            $th_element->textContent = "Stadens geografiska läge, lat & long";
            $td_element->textContent = "[" . $result["coord"]['lat'] . ", " . $result["coord"]['lon'] . "]";
        }

        // Knyter ihop tabellen.
        $thead_element->appendChild($tr_element);
        $tr_element->appendChild($th_element);
        $tr_element->appendChild($td_element);
    }

    $node->appendChild($table_element); // infogar tabellen i div-taggen.


    echo $domDocument->saveHTML(); // Matar ut den genererade källkoden
}
