<?php
/**
 * PHP 5.1
 */
 
/**
 * @version 2.00
 * @author Adam Berger <ber34#o2.pl-->
 * Class allows you to import a variety of files.
 * Xml assigning appropriate tags that you want to read.
 * We read the same data from different files.
 * The structure of the document must remain the same in each of them.
 * Tags that you want to display the message given in the table.
 *
 * Klasa pozwala na import różnych plikóww .xml z przypisaniem odpowiednich tagach,
 * które chcemy odczytać.
 * Możemy odczytać te same dane z różnych plików.
 * Struktura dokumentu musi pozostaÄ‡ taka sama w kaÅ¼dym z nich.
 * Tagi które chcemy wyświetlić podajemy w tablicy post.
 * Pełny uniwersalny kontapitybilny z ceneo, nokut, aukcyjny,
 */

class uniwersal_import_xml {
 
     public $file = array();
     public $type;
     public $xml_name;
     public $types;
     public $ile_xml;
     public $kk;
     public $ww;
     public $pp;
     public $bb;
     public $error = false;
     public $post = array();
     public $t = array();

    public function __construct($files) {
        if(!empty($files)){
            $this->file[]= $files;
            list($kkk, $this->ww)=each($this->file[0]);
          }
        if(array_key_exists($kkk, $this->file[0])){
              $this->kk = $kkk;
          }else{
              $this->kk = $this->error;
        }
          $this->error;
    }
     ### nazwa pliku. ###
    public function files_xml(){
      if(!empty($this->file)){
          return $this->kk;
        }else{
          return $this->error;
      }
    }
    ### nazwa pliku. ###
    public function files_name_xml(){
      if(!empty($this->file)){
            return $this->ww['name'];
        }else{
           return $this->error;
      }
    }
    ### temp nazwa pliku. ###
    public function files_temp_name_xml(){
      if(!empty($this->file)){
            return $this->ww['tmp_name'];
        }else{
           return $this->error;
      }
    }
    ### Typ pliku. ###
    public function files_types_xml(){
      if(!empty($this->file)){
          return $this->ww['type'];
        }else{
          return $this->error;
      }
    }
    ### BÅ‚Ä…d pliku. ###
    public function files_error_xml(){
      if(!empty($this->file)){
          return $this->ww['error'];
        }else{
          return $this->error;
      }
    }
    ### Rozmiar pliku. ###
    public function files_size_xml(){
      if(!empty($this->file)){
          return $this->ww['size'];
        }else{
          return $this->error;
      }
    }
    ### Typ pliku. ###
    public function is_typee(){
       $typee = array('text/xml');
      if(in_array(self::files_types_xml(), $typee)){
          return true;
        }else{
          return $this->error;
      }
    }
    ### wybierz ktÃ³ry import swÃ³j czy obcy. ###
    public function select_tag_xml(){
      if($this->kk == "fileimportxml"){
          return true;
        }else{
          return $this->error;
      }
    }
   
    ## zamienienie i rozdzielenie ##
    protected function load_xml(){
     if(file_exists("xml/".basename($this->files_name_xml()))){ // $this->xml_name
       if(self::files_name_xml()){
          $xml= new DOMDocument('1.0', 'utf-8');// iso-8859-2
          $xml->preserveWhiteSpace=false;
          $xml->loadXML(file_get_contents("xml/".basename($this->files_name_xml()))); // $this->xml_name
          if($xml){
             return $xml;
          }else{
             return $this->error;
          }
       
          }else{
           return $this->error;
         }
      }
    }
        #### pobieramy tablice post ####
    public function wczytaj_post(){
          if(func_num_args()>0){
             $this->post_a = func_get_args();
             foreach($_POST as $bb =>$pp){
                 if(in_array($pp,$this->post_a)){
                  $this->pp[] = strip_tags($pp);
          if(array_key_exists($bb, $_POST)){
               $this->bb[] = array($bb => strip_tags($pp));
        }
           }
             }
        }
    }
    ### zilicz ile ###
    public function count_xml(){
             //print_r($this->bb);
         //// $this->ile_xml = count($this->bb);
          return $this->ile_xml;
    }
  ### zapisz plik ###
    public function save_xml(){
            $error ="";
         if(!file_exists($this->files_name_xml())){
            if ($this->files_error_xml() == '0') {
                $scie = "xml/".basename($this->files_name_xml()); //// gdzie wgraÄ‡ plik
         //$scie = strtolower(strtr($scie, "Ä…Ä™Ä‡Å‚Å„Ã³Å›ÅºÅ¼Ä„Ä†Ä˜ÅÅƒÃ“ÅšÅ¹Å»", "aeclnoszzACELNOSZZ")); /// wyczyszczenie nazwy + ustawienie maÅ‚e litery
         if(is_uploaded_file($this->files_temp_name_xml())){
             if($this->files_size_xml() == '0' or $this->files_size_xml() > '4096000'){ /////SprawdÅº czy jest mniejszy od 4MB
                 @$this->error .= "<b style='color: #ff9601;'>Stop Plik wiÄ™kszy Od 4MB</b>";
              }elseif($this->is_typee() !== true){ /// sprawdz czy zdiÄ™cie - image
                 @$this->error .= "<b style='color: #ff9601;'>Stop Plik nie jest xml</b>";
              }else{
                 move_uploaded_file($this->files_temp_name_xml(), $scie); /// gdzie zapisac
                 @$this->error.= "<b style='color: #ff9601;'>Zapis Udany</b>";
             }
            }else{
                 @$this->error.= "<b style='color: #ff9601;'>Stop BÅ‚Ä…d Pliku</b>";
           }
          }
        }
                 return $this->error;
    }
  public function uniwersal_plik_xml(){
            $t=array();
         if($xml = $this->load_xml()){
             $domXPath = new DOMXPath($xml);
        foreach ($domXPath->query('//*') as $keyDOM) {
            foreach($this->bb as $sss){
                foreach($sss as $kkkkkkk => $ssssssss){
                    $s = explode('&&', $ssssssss);
                    if(!empty($s[1])){
                    $this->ile_xml = count($s[0]);
                        if($keyDOM->getAttribute($s[1]) && $keyDOM->tagName == $s[0]){
                       $MARKA = $keyDOM->getAttribute($s[1]);
                         @$t[$kkkkkkk][] = $MARKA; // for
                        // @$t[$kkkkkkk] = $MARKA; // foreach
                       }
                      }else if($keyDOM->tagName == $s[0]){
                              if(in_array($s[0],$this->pp)){
                       @$t[$kkkkkkk][] = $keyDOM->nodeValue;
                        //@$t[$kkkkkkk] = $keyDOM->nodeValue;
                               }
                            }
            }
        }
    }
  }
         return $t;
 }
}
