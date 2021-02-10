<?php
ini_set('MAX_EXECUTION_TIME', '-1');
// echo "Hello World";

echo "<hr>";

// *******************
// DATABASE CONNECTION
try{
    $driver = "mysql";

    $host   = "localhost";
    // $port   = "";
    $schema = "db_helper2020";
    $user   = "root";
    $password = "";

    $dbh = new PDO($driver.":host=".$host.";dbname=".$schema.";charset=utf8", $user, $password);    
}catch (PDOException $e){
    echo "ERROR: ".$e->getMessage()."<br/>";
}

$dbh->beginTransaction();

// ********************
// echo __FILE__; die('die');

/*

"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/mamad-fayza",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/doua-sara",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/balouz-khaoula",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/chfali-anouar",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/benhommess-nada",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/laghmam-youssef",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/belgarch-nadia",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/bouhayat-fatima",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/azriouil-fatima",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/chekkaf-fadwa",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/essabir-mohammed",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/fikri-wafaa",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/boubia-samira",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/maach-mouna",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/mounazil-soumaya",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/rochdi-nadia",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/elkannassi-maria",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/amir-mourad",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/akhlef-khadija",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/lhallabi-najya",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/elmouktafi-driss",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/aglou-khadija",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/douich-khadija",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/guerimej-mustapha",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/tajri-ennasery-kawtar",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/nazih-salwa",
"https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/abdelhaq-lousana",

*/

// $html = file_get_contents("https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/chekkaf-fadwa#carte");
// $html = file_get_contents("https://www.dabadoc.com/doctors-temara/page/27");
// $html = file_get_contents("https://www.telecontact.ma/liens/pharmacies/temara.php&page=9");
// $dom  = new DOMDocument();
// libxml_use_internal_errors( 1 );
// $dom->loadHTML( $html );
// $xpath = new DOMXpath( $dom );
// $jsonScripts = $xpath->query( '//script[@type="application/ld+json"]' );
// $json = trim( $jsonScripts->item(0)->nodeValue );

// $data = json_decode( $json );
// var_dump($data);

// INFORMATION THAT NEED TO BE STORED

// SPECIALITY

// FULL NAME

// PHONE NUMBER



// ADDRESS
    // COUNTRY

    // CITY

    // CODE POSTAL

    // LOCATION ADDRESS

// GEOLOCALISATION
    // LATITUDE

    // LONGTITUDE



// EXTRACT PHARMACIES ADDRESSES

    // $html = file_get_contents("https://www.telecontact.ma/plan-acces/pharmacie-almaarifa-adrar-/1790700/temara");
    
    // $data = explode("setView", $html);
    // $data1 = explode("[", $data[$i]);
    // $data2 = explode("]", $data1[1]);
    // $data3 = explode(",", $data2[0]);
    // // $data2 = explode("]", $data1[1]);
    // echo "Latitude: ".$data3[0];
    // echo "<br>";
    // echo "Longitude: ".trim($data3[1]);

    $html = file_get_contents("https://www.telecontact.ma/liens/pharmacies/temara.php&page=1");
    
        //
            // $dom = new DOMDocument();
            // libxml_use_internal_errors( 1 );
            // $dom->loadHTML($html);
            // $articles = $dom->getElementsByTagName('article');
            // print_r($articles->item(0));
        //


    $data = explode('<article', $html);
    // var_dump($data);
    // echo($data[$i]);
    // echo "<hr>";
    // die();



    // DATA RETRIEVING
    $i = 0;
    // echo sizeof($data);die();
    $ii = 0;
    $exTrack = 0;

    //ARRAY
    $pharmacies = array("First-Line"=>"Empty");

    // VARIABLES
    $PhaName = "";
    $Address = "";
    $PostalCode = "";
    $Ville  = "";
    $country= "Maroc";
    $Fix    = "";
    $lat    = 0;
    $long   = 0;


    //FIRST EXECUTION.
    $FE = 1;
    $stop = true;
    for($ii = 1; $ii <= 9;$ii++){
        $html = file_get_contents("https://www.telecontact.ma/liens/pharmacies/temara.php&page=".$ii);
        $data = explode('<article', $html);
        // echo "<hr><b> --- PAGE: ".$ii."URL: https://www.telecontact.ma/liens/pharmacies/temara.php&page=".$ii." --- </b><hr>";
        for($i = 1; $i < sizeof($data); $i++){
            
        // while( sizeof($pharmacies)<= sizeof($data))
            // echo "<hr><b> --- Pharmacie: ".$i." --- </b><hr>";
            // NOM DE LA PHARMACIE
            // echo "<hr>";
            // echo "Pharmacie: ".(trim(explode('</a>',explode('temara.php">',$data[$i])[3])[0]));
            $PhaName = (trim(explode('</a>',explode('temara.php">',$data[$i])[3])[0]));
            $MyPha_Flag = false;
            // var_dump($pharmacies);

            foreach($pharmacies as $val){
                // echo "<hr><p>val(".$val.") == PhaName(".$PhaName.") =".($val == $PhaName)."</p><hr>";
                if($val == $PhaName){
                    // echo "<hr> Duplication.... <hr>";
                    $MyPha_Flag = false;
                    break;
                }else $MyPha_Flag = true;
            }

            if($MyPha_Flag){
                // echo "RECORD: ".++$exTrack;
                // echo "<hr> No Duplication.... INSERTING...<hr>";
                // echo "<hr>";
                // echo "<hr><b> --- Pharmacie: ".(++$exTrack)." --- </b><hr>";
                // echo "Pharmacie: ".(trim(explode('</a>',explode('temara.php">',$data[$i])[3])[0]));
                

                // // ADDRESS
                // echo "<hr>";
                // echo"ADDRESS: ".(trim(explode('</span>',explode('<span itemprop="address">',$data[$i])[1])[0]));
                 $Address = (trim(explode('</span>',explode('<span itemprop="address">',$data[$i])[1])[0]));
                
                // // POSTAL CODE
                // echo "<hr>";
                if(sizeof(explode('postalCode">',$data[$i])) != 1){
                    // echo"CODE POSTAL: ".(trim(explode('</',explode('postalCode">',$data[$i])[1])[0]));
                    $PostalCode = (trim(explode('</',explode('postalCode">',$data[$i])[1])[0]));
                }else { $PostalCode = "0"; }

                // // CITY'S NAME
                // echo "<hr>";
                // echo "VILLE: ".(trim(explode('</',explode('class="match">',$data[$i])[2])[0]));
                 $Ville = (trim(explode('</',explode('class="match">',$data[$i])[2])[0]));

                // // PHARMACIE FIX NUMBER
                // echo "<hr>";
                // echo "Numero De Fix: ".(trim(explode('</',explode('fa-phone"></i>',$data[$i])[2])[0]));
                 $Fix = (trim(explode('</',explode('fa-phone"></i>',$data[$i])[2])[0]));

                // //URL GEOLOCALISATION
                    // // <a title="Plan d'acc�s" href="
                    // echo "<hr>";
                    if($PhaName != "Acima Harhoura"){
                        $geoUrl = "https://www.telecontact.ma".(trim(explode('">',explode('href="',$data[$i])[5])[0]));
                        // echo $geoUrl;
                        // // GET CONTENT OF THE GEOLOCALISATION
                        $geoData = file_get_contents($geoUrl);
                        // print_r($geoData);
                        // EXTRACT PHARMACIES ADDRESSES
                        
                        $gdata = explode("setView", $geoData);
                        $gdata1 = explode("[", $gdata[1]);
                        $gdata2 = explode("]", $gdata1[1]);
                        $gdata3 = explode(",", $gdata2[0]);
                        
                        // // $data2 = explode("]", $data1[1]);
                        // // GET LATITUDE
                        // echo "<br>Latitude: ".$gdata3[0];
                        $lat = $gdata3[0];
                        // echo "<br>";
                        
                        // // GET LONGITUDE
                        // echo "Longitude: ".trim($gdata3[1]);
                        $long = $gdata3[1];
                    }else{
                        // echo "<br>Latitude: 33.9369454";
                        $lat = 33.9369454;
                        // echo "<br>";
                        
                        // // GET LONGITUDE
                        // echo "Longitude: -6.940104";
                        $long = -6.940104;
                    }

                array_push($pharmacies, $PhaName);
                $MyPha_Flag = false;
                
                // ******************
                // DATABASE INSERTION
                // $PhaName = "";
                // $Address = "";
                // $PostalCode = "";
                // $Ville  = "";
                // $country= "Maroc";
                // $Fix    = "";
                // $lat    = 0;
                // $long   = 0;
                // $PhaName2 = call_user_func_array('mb_convert_encoding', array($PhaName,'HTML-ENTITIES','UTF-8'));
                    $dbh->exec("INSERT INTO h20_pharmacies (PHID, PH_NAME, PH_FIX, PH_ADDRESS, PH_CODEPOSTAL, PH_CITY, PH_COUNTRY, PH_LATITUDE, PH_LONGITUDE)
                    VALUES (NULL, '$PhaName', '$Fix', '$Address', '$PostalCode', '$Ville', '$country', '$lat', '$long')");
                // ******************
                if(sizeof($pharmacies) <= 165){
                    $ii     = 1;
                    // $stop   = false;
                }
            }
        }
    
    }
    // ***********************************


    // DATABASE COMMIT
       $dbh->commit();
    // ****************

    // $MyPharmacies = array();
    // var_dump($pharmacies);
    echo json_encode($pharmacies,JSON_UNESCAPED_UNICODE);
    // echo "<hr> Size: ".sizeof($pharmacies);
    


    // echo "<hr>";
    // $data1 = explode('temara.php', $data[$i]);
    // // echo "Explode return: ".sizeof(explode('postalCode">',$data[$i]));
    // echo "<br>";
    // echo(trim(explode('</',explode('fa-phone"></i>',$data[$i])[2])[0]));

    
    

    // echo "Phamacie: ".explode('</a>',explode('temara.php">',$data)[])[0];
    
    //-------------------------
    //temara.php">Pharmacie  </a>
    //temara.php"> Islah</a>
    //<span itemprop="address">25, ElHachmiya , Rte. Principal km. 13</span>
    //<span itemprop="postalCode"> 12050</span> 
    //<span class="match">TEMARA</span>
    // <i class="fa fa-phone"></i>  05 37 64 30 36 </div>
    
    // $dom  = new DOMDocument();
    // print_r($dom);
    //     // ***
    //         $elements = $dom->getElementsByTagName('article');
    //         var_dump($elements);
    //     // ***


    // libxml_use_internal_errors( 1 );
    // $dom->loadHTML( $html );
    // $xpath = new DOMXpath( $dom );
    // $jsonScripts = $xpath->query( '//article' );
    // echo($jsonScripts->item(2)->nodeValue);
    // $json = trim( $jsonScripts->item(0)->nodeValue );
    // $data = json_decode( $json );
    // var_dump($jsonScripts->item(0));


    //

    // $elements = $xpath->query("//article");
    // var_dump($elements);
    // if (!is_null($elements->item(1)->nodeValue)) {
    // foreach ($elements as $element) {
    //     echo "<br/>[". $element->nodeName. "]";
    //     // echo "<br/>[". $element->nodeName. "]";

    //     $nodes = $element->childNodes;

    //     var_dump($elements->item(0)->nodeValue);

    //     // $xpath2 = $nodes->query("//*");

    //     foreach ($nodes as $node) {

    //     echo $node->nodeValue. "\n";
    //     echo $node->localName. "\n";
    //     echo $node->textContent. "\n";
    //     echo "<hr>";
    //     // var_dump(explode(" ",$node->nodeValue));

    //     }
    // }
    // }
?>