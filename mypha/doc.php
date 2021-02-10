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
    $schema = "temaraguide";
    $user   = "root";
    $password = "";

    $dbh = new PDO($driver.":host=".$host.";dbname=".$schema.";charset=utf8", $user, $password);    
}catch (PDOException $e){
    echo "ERROR: ".$e->getMessage()."<br/>";
}

$dbh->beginTransaction();

// ********************
// echo __FILE__; die('die');

// $html = file_get_contents("https://www.doctori.ma/fr/medecin/chirurgien-dentiste/temara/chekkaf-fadwa#carte");
// $html = file_get_contents("https://www.dabadoc.com/doctors-temara/page/27");
// $html = file_get_contents("https://www.telecontact.ma/liens/DOCTEURs/temara.DOCp&page=9");
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

// DOCONE NUMBER



// ADDRESS
    // COUNTRY

    // CITY

    // CODE POSTAL

    // LOCATION ADDRESS

// GEOLOCALISATION
    // LATITUDE

    // LONGTITUDE

    $html = file_get_contents("https://www.telecontact.ma/trouver/index.php?nxo=moteur&nxs=process&string=medecins&ou=temara&page=1&produit=");
    
        //
            // $dom = new DOMDocument();
            // libxml_use_internal_errors( 1 );
            // $dom->loadHTML($html);
            // $articles = $dom->getElementsByTagName('article');
            // print_r($articles->item(0));
        //

    $data = explode('<article', $html);

    // DATA RETRIEVING
    $i = 0;
    // echo sizeof($data);die();
    $ii = 0;
    $exTrack = 0;

    //ARRAY
    $DOCTEURS = array("First-Line"=>"Empty");

    // VARIABLES
    $DOCaName = "";
    $Speciality = "";
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
    $exec = 0;
    $valid = false; 
    for($ii = 1; $ii <= 8;$ii++){
        $html = file_get_contents("https://www.telecontact.ma/trouver/index.php?nxo=moteur&nxs=process&string=medecins&ou=temara&page=".$ii."&produit=");
        $data = explode('<article', $html);
        for($i = 1; $i < sizeof($data); $i++){
            
        // while( sizeof($DOCTEURS)<= sizeof($data))
            // echo "<hr><b> --- DOCTEUR: ".$i." --- </b><hr>";
            // NOM DE DOCTEUR
            // echo "<hr>";
            
            //var_dump(explode('">',explode('href="',$data[$i])[1]));die();
            
            if(preg_match('/<span class="badge"/',trim(explode('</a>',explode('temara.php">',$data[$i])[1])[0])) != 1){
                $DOCaName = trim(explode('</a>',explode('temara.php">',$data[$i])[1])[0]);
            }else{
                $DOCaName = trim(explode('<span', explode('</a>',explode('temara.php">',$data[$i])[1])[0])[0]);
            }
            
            

            
            $MyDOCa_Flag = false;
            

            foreach($DOCTEURS as $val){
                // echo "<hr><p>val(".$val.") == DOCaName(".$DOCaName.") =".($val == $DOCaName)."</p><hr>";
                if($val == $DOCaName){
                    // echo "<hr> Duplication.... <hr>";
                    $MyDOCa_Flag = false;
                    break;
                }else $MyDOCa_Flag = true;
            }

            if($MyDOCa_Flag){
                // echo "RECORD: ".++$exTrack;
                // echo "<hr> No Duplication.... INSERTING...<hr>";
                // echo "<hr>";
                // echo "<hr><b> --- DOCTEUR: ".(++$exTrack)." --- </b><hr>";
                // echo "DOCTEUR: ".$DOCaName;
                
                // Speciality
                $profile_link = "https://www.telecontact.ma".explode('">',explode('href="',$data[$i])[1])[0];
                $profile = file_get_contents($profile_link);
                
                
                $Speciality = "";
                //var_dump(explode('<span itemprop="description">',$profile));

                if(preg_match('/information-annonceur/',$profile) == 1){
                    
                    // echo "<hr>Docteur: ".$DOCaName." Inform.Annonce<hr>";
                     $temp = explode('<',explode('<li style="font-size:18px;"   class=" ">', $profile)[1])[0];
                    //  var_dump($temp);
                    if(preg_match('/:/',$temp) == 1){
                        //echo "Got the ':' > ".$temp;
                         $Speciality = trim(explode(' Médecins :',$temp)[1]);
                    }else{
                        //echo "Does not have ':' > ".$temp;
                        $Speciality = trim(explode(' Médecins',$temp)[1]);
                    }

                }else{
                    //echo "<hr>Docteur: ".$DOCaName." Other Version<hr>";
                    $temp = explode('<', explode( '>', explode('/temara.php" class=""',$profile)[1])[1])[0];
                    if(preg_match('/:/',$temp) == 1){
                        //echo "Got the ':' > ".$temp;
                        var_dump($temp);
                        $Speciality = trim(explode('- Médecins :',$temp)[1]);
                    }else{
                        //echo "Does not have ':' > ".$temp;
                        $Speciality = trim(explode('- Médecins',$temp)[1]);
                    }
                }
                

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
                // echo "VILLE: ".(trim(explode('</',explode('class="match">',$data[$i])[1])[0]));
                 $Ville = (trim(explode('</',explode('class="match">',$data[$i])[1])[0]));

                // // DOCTEUR FIX NUMBER
                // echo "<hr>";
                // echo "Numero De Fix: ".(trim(explode('</',explode('fa-DOCone"></i>',$data[$i])[2])[0]));
                 $Fix = (trim(explode('</',explode('fa-phone"></i>',$data[$i])[2])[0]));

                // //URL GEOLOCALISATION
                    // // <a title="Plan d'acc�s" href="
                    if(preg_match('/changer-ma-position/', trim(explode('">',explode('href="',$data[$i])[3])[0])) != 1){
                        $geoUrl = "https://www.telecontact.ma".trim(explode('">',explode('href="',$data[$i])[3])[0]);
                        $geoData = file_get_contents($geoUrl);
                        // print_r($geoData);
                        // EXTRACT DOCTEURS ADDRESSES
                        
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
                        $valid = true;
                    }else{
                        // echo "<hr>NO LOCATION FOR THIS ONE  <hr>";
                        $valid = false;
                    }

                
                
                if($valid == true){
                    array_push($DOCTEURS, $DOCaName);
                    $MyDOCa_Flag = false;

                    // echo "<hr>Docteur Number: ".++$exec."<hr><br>";

                    // echo "Docteur: <b>";
                    // echo $DOCaName;
                    // echo "</b><hr>"; 
                    // echo "Speciality: <b>";
                    // echo $Speciality;
                    // echo "</b><hr>"; 
                    // echo "Address: <b>";
                    // echo $Address;
                    // echo "</b><hr>";
                    // echo "Code Postal: <b>";
                    // echo $PostalCode;
                    // echo "</b><hr>";
                    // echo "Ville <b>";
                    // echo $Ville;
                    // echo "</b><hr>";
                    // echo "Country: <b>";
                    // echo $country;
                    // echo "</b><hr>";
                    // echo "Fix: <b>";
                    // echo $Fix;
                    // echo "</b><hr>";
                    // echo "Latitude: <b>";
                    // echo $lat;
                    // echo "</b><hr>";
                    // echo "Longitude <b>";
                    // echo $long;
                    // echo "</b><hr></br></br>";    
                }
                // ******************
                // DATABASE INSERTION
                // $DOCaName = "";
                // $Speciality = "";
                // $Address = "";
                // $PostalCode = "";
                // $Ville  = "";
                // $country= "Maroc";
                // $Fix    = "";
                // $lat    = 0;
                // $long   = 0;
                $DOCaName2 = call_user_func_array('mb_convert_encoding', array($DOCaName,'HTML-ENTITIES','UTF-8'));
                    $dbh->exec("INSERT INTO tg_docteurs (DOCID, DOC_NAME, SPECIALITE, DOC_FIX, DOC_ADDRESS, DOC_CODEPOSTAL, DOC_CITY, DOC_COUNTRY, DOC_LATITUDE, DOC_LONGITUDE)
                    VALUES (NULL, '$DOCaName', '$Speciality', '$Fix', '$Address', '$PostalCode', '$Ville', '$country', '$lat', '$long')");
                // ******************
                // if(sizeof($DOCTEURS) <= 158){
                //     $ii     = 1;
                //     echo "<hr>Execution Number: ".++$exec."<hr>";
                //     // $stop   = false;
                // }
            }
        }
    
    }
    // ***********************************


    // DATABASE COMMIT
    //   $dbh->commit();
    // ****************

    // $MyDOCTEURs = array();
    // var_dump($DOCTEURS);
    echo json_encode($DOCTEURS,JSON_UNESCAPED_UNICODE);
    // echo "<hr> Size: ".sizeof($DOCTEURS);

?>