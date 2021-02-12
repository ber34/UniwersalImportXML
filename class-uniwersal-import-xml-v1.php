<?php
#The MIT License
###############################
#Copyright (c) 2014 Adam Berger
###############################
#Permission is hereby granted, free of charge, to any person obtaining a copy
#of this software and associated documentation files (the "Software"), to deal
#in the Software without restriction, including without limitation the rights
#to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
#copies of the Software, and to permit persons to whom the Software is
#furnished to do so, subject to the following conditions:
###############################
#The above copyright notice and this permission notice shall be included in
#all copies or substantial portions of the Software.
###############################
#THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
#IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
#FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
#AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
#LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
#OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
#THE SOFTWARE.
##############################

/**
 * PHP 5.1
 */
 
/**
 * @version 1.00
 * @author Adam Berger <ber34#o2.pl-->
 * Class allows you to import a variety of files.
 * Xml assigning appropriate tags that you want to read.
 * We read the same data from different files.
 * The structure of the document must remain the same in each of them.
 * Tags that you want to display the message given in the table.
 *
 * Klasa pozwala na import rÃ³Å¼nych plikÃ³w .xml z przypisaniem odpowiednich tagÃ³w,
 * ktÃ³re chcemy odczytaÄ‡.
 * MoÅ¼emy odczytaÄ‡ te same dane z rÃ³Å¼nych plikÃ³w.
 * Struktura dokumentu musi pozostaÄ‡ taka sama w kaÅ¼dym z nich.
 * Tagi ktÃ³re chcemy wyÅ›wietliÄ‡ podajemy w tablicy post.
 */
 
class uniwersal_import_xml {
 
     public $file = array();
     public $type;
     public $xml_name;
     public $types;
     public $ile_xml;
     public $kk;
     public $ww;
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
          $this->post;
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
          $xml= new DOMDocument('1.0', 'utf-8');// iso-8859-1
          $xml->preserveWhiteSpace=false;
          $xml->loadXML(file_get_contents("xml/".basename($this->files_name_xml()))); // $this->xml_name
           return $xml;
          }else{
           return $this->error;
         }
      }
    }
    ### zilicz ile ###
    public function count_xml(){
        
     if($xml = $this->load_xml()){
       if(!empty($this->post[0])){
            $nody1 = $xml->getElementsByTagName($this->post[0]);
          }else{
            $nody1 = $xml->getElementsByTagName('PRODUKTY');
          }
            $nod2 = $nody1->item(0);
            $NodList1 = $nod2->childNodes;
            $this->ile_xml= $NodList1->length;
       }
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
 ### wybierz obcy ###
    public function wybierz_plik_obcy($post1){
           
      if(!empty($post1)){
            $this->post = explode('&&', strip_tags($post1));
      if($xml = $this->load_xml()){
            $no1 = $xml->getElementsByTagName($this->post[0]);
            $nod1 = $no1->item(0);
            $List1 = $nod1->childNodes;
            $this->ile_xml= $List1->length;
     for( $j=0; $j < $List1->length; $j++ ){
            $n = $xml->getElementsByTagName($this->post[1]);
            $nod = $n->item($j);
            $NList = $nod->childNodes;
     for( $i=0; $i < $NList->length; $i++ ){
            $nods = $NList->item($i);
            $List11 = $nods->childNodes;
            for( $k=0; $k<$List11->length; $k++ ){
            $ng = $xml->getElementsByTagName($nods->nodeName);
            $ns = $ng->item($k);
            $nk = $List11->item($k);
            @$this->t[$ns->tagName][] = $nods->nodeValue;
            @$this->t[$nk->tagName][] = $nk->nodeValue;
              }
            }
        }
      }
    }
         return $this->t;
  }
    ### wybierz plik ###
    public function wybierz_plik(){
         if($xml = $this->load_xml()){
          $n1 = $xml->getElementsByTagName('PRODUKTY');
          $nod1 = $n1->item(0);
          $dList1 = $nod1->childNodes;
          $this->ile_xml= $dList1->length;
     for( $j=0; $j < $dList1->length; $j++ ){
          $y = $xml->getElementsByTagName('PRODUKT');
          $d = $y->item($j);
          $List = $d->childNodes;
     for( $i=0; $i < $List->length; $i++ ){
          $w = $List->item($i);
          $this->t[$w->tagName][] = $w->nodeValue;
         }
      }
    }
         return $this->t;
  }
}
