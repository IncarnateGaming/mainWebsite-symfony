<?php


namespace App\Service\ImportUGF;


class UGFImportFunctions
{
    public function wrapInInternalHyperlink(string $string, string $fid){
        return '<a href="#'.$fid.'">'.$string.'</a>';
    }
    public function heading1(\SimpleXMLElement $xml,string $fid=''):string{
        $string = $this->headingText(str_replace(['<heading1>','</heading1>'],'',$xml->asXML()));
        if(''!==$fid){
            $string=$this->wrapInInternalHyperlink($string,$fid);
        }
        return $string;
    }
    public function heading2(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading2>','</heading2>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading3(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading3>','</heading3>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading4(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading4>','</heading4>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading5(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading5>','</heading5>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function heading6(\SimpleXMLElement $xml,string $fid):string{
        $string = $this->headingText(str_replace(['<heading6>','</heading6>'],'',$xml->asXML()));
        return $this->wrapInInternalHyperlink($string,$fid);
    }
    public function headingText(string $string):string{
        $string = str_replace('<quoMark/>','"',$string);
        $string = str_replace('<generate','<span class="generate"',$string);
        $string = str_replace(' FID="',' data-FID="',$string);
        $string = str_replace(' UGFLinkReference="',' data-UGFLinkReference="',$string);
        $string = str_replace(' FIDparent="',' data-FIDparent="',$string);
        $string = str_replace(' UGFparent="',' data-UGFparent="',$string);
        $string = str_replace(' recurrance="',' data-recurrance="',$string);
        $string = str_replace(' quantity="',' data-quantity="',$string);
        $string = str_replace('</generate>','</span>',$string);
        return $string;
    }
    //Takes either a string or a description simple xml element
    public function richText($string):string{
        if (is_string($string)){
            $result = $string;
        }elseif ( is_a($string,'SimpleXMLElement') ){
            $result = $string->asXML();
            $result = str_replace('<description>','',$result);
            $result = str_replace('</description>','',$result);
        }
        //TODO: handle sound
        $result = str_replace('<quoMark/>','"',$result);
        $result = str_replace('<calculate>','<span class="calculate">',$result);
        $result = str_replace('</calculate>','</span>',$result);
        $result = str_replace('<crossReference','<span class="crossReference"',$result);
        $result = str_replace(' FID="',' data-FID="',$result);
        $result = str_replace(' UGFLinkReference="',' data-UGFLinkReference="',$result);
        $result = str_replace(' FIDparent="',' data-FIDparent="',$result);
        $result = str_replace(' UGFparent="',' data-UGFparent="',$result);
        $result = str_replace('</crossReference>','</span>',$result);
        $result = str_replace('<generate','<span class="generate"',$result);
        $result = str_replace(' recurrance="',' data-recurrance="',$result);
        $result = str_replace(' quantity="',' data-quantity="',$result);
        $result = str_replace('</generate>','</span>',$result);
        $result = str_replace('<hyperlink uri="','<a href="',$result);
        $result = str_replace('</hyperlink>','</a>',$result);
        return $result;
    }
    public function formatParagraphs(\SimpleXMLElement $xml):string {
        $result = "";
        $children = $xml->children();
        foreach ($children as $child){
            $result .= $child->asXML();
        }
        $result = str_replace('<centeredText>','<p class="text-center">',$result);
        $result = str_replace('</centeredText>','</p>',$result);
        $result = str_replace('<empahaticParagraph>','<p class="border border-primary rounded bg-dark">',$result);
        $result = str_replace('</emphaticParagraph>','</p>',$result);
        $headers = array('<h>','<h sublevel="1">','<h sublevel="2">','<h sublevel="3">','<h sublevel="4">','<h sublevel="5">','<h sublevel="6">');
        $result = str_replace($headers, '<h3>',$result);
        $result = str_replace('</h>','</h3>',$result);
        //TODO: handle image
        //TODO: handle private Paragraph
        //TODO: handle speech bubble
        //TODO: confirm normal tables work
        $result = str_replace('<table>','<table class="table table-striped">',$result);
        $result = $this->richText($result);
        return $result;
    }
}