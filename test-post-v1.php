<?php

    require("uniwersal_import_xml.class.php");

   $import_xml = new uniwersal_import_xml($_FILES);
   $import_xml->save_xml();
   
    //$_POST['ZBIOR'] = "storeItems&&storeItem"; // tytuł
   // $_POST['MARKA'] = "name"; // tytuł
   // $_POST['MODEL'] = "name";
   // $_POST['CENA'] = "price";
   // $_POST['CENA_NETTO']= "price";
   // $_POST['VAT'] = "vat";
   // $_POST['URL_IMG'] = "image";
   // $_POST['URL_PROD'];
   // $_POST['OPIS'] = "description";
   // echo key($_POST).'<br>';
       
    if($import_xml->select_tag_xml() === true)
    {
          $ff = $import_xml->wybierz_plik_obcy($_POST['ZBIOR']);
         
          for($i=0; $i < count($ff); $i++)
          {
            if(!empty($ff[$_POST['MARKA']][$i]) && !empty($ff[$_POST['MODEL']][$i]))
            {
               echo @$ff[strip_tags($_POST['MARKA'])][$i]." MARKA <br>";
               echo @$ff[strip_tags($_POST['MODEL'])][$i]." MODEL <br>";
               echo @$ff[strip_tags($_POST['CENA'])][$i]." CENA <br>";
               echo @$ff[strip_tags($_POST['URL_IMG'])][$i]." IMG <br>";
               echo @$ff[strip_tags($_POST['OPIS'])][$i]." OPIS <br>";
            }
         }
    }else{
              $fff = $import_xml->wybierz_plik();
              for($i=0; $i < count($fff['ID']); $i++) 
              {
                echo @$fff['MARKA'][$i]." MARKA <br>";
              }
          }
          ## ile ##
          echo $import_xml->count_xml();
