<?php
   include("uniwersal_import_xml.class.php");

   $import_xml = new uniwersal_import_xml($_FILES);
   $import_xml->save_xml();
   $import_xml->wczytaj_post($_POST['MARKA'], $_POST['MODEL'], $_POST['CENA'], $_POST['ID'], $_POST['VAT'], $_POST['URL_IMG'], $_POST['URL_PROD'], $_POST['OPIS']);
              
               ### nasze aukcje ###
          $ff = $import_xml->uniwersal_plik_xml();
           //// print_r($ff);
          for($i=0; $i < count($ff['MARKA']); $i++){
             // print_r($ff);
               ### wy&#347;wietlamy ###
             if(!empty($ff['MARKA'])){
                echo "<br>".$i."ID ".$ff['ID'][$i]."<br>";
                echo "<br>".$i."marka ".$ff['MARKA'][$i]."<br>";
                echo "<br>"."model ".$ff['MODEL'][$i]."<br>";
                echo "<br>".$i."cena ".$ff['CENA'][$i]."<br>";
         // echo $ff['CENA_NETTO'][$i]."<br>";
                echo "<br>".$i.$ff['VAT'][$i]."<br>";
                echo "<br>".$i.$ff['URL_IMG'][$i]."<br>";
                echo "<br>".$i.$ff['URL_PROD'][$i]."<br>";
                echo "<br>".$i."opis ".$ff['OPIS'][$i]."<br>";
             }
         }
