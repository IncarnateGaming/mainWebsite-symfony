<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
//    public function getFunctions(): array
//    {
//        return [
//            new TwigFunction('arrayConvert', [$this, 'arrayConvert']),
//        ];
//    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('array_convert', [$this, 'processArrayConvert'], ['is_safe' => ['html']]),
            new TwigFilter('array_convert_simple', [$this, 'processArrayConvertSimple']),
            new TwigFilter('p_stripper', [$this, 'pStripper']),
            new TwigFilter('index_stripper', [$this, 'indexStripper']),
            new TwigFilter('email_space_sanitizer', [$this, 'emailSpaceSanitizer']),
        ];
    }
    public function emailSpaceSanitizer(string $string):string{
        return str_replace(' ','%20',$string);
    }
    public function assembleCrossReference(array $value, int $target){
        return '<span type="crossReference" data-fid="' . $value[$target]['fid'] . '" data-UGFLinkReference="' . $value[$target]['ugf'] . '">' . $value[$target]['name'] . '</span>';
    }
    public function processArrayConvert($value){
        $result = "";
        if(count($value) > 0){
            if ($value[0]['fid'] && $value[0]['name'] && $value[0]['ugf']){
                $result .= $this->assembleCrossReference($value,0);
            }
        }
        if(count($value) > 1){
            for ($b = 1; $b < count($value); $b++){
                if ($value[$b]['fid'] && $value[$b]['name'] && $value[$b]['ugf']) {
                    $result .= ', ' . $this->assembleCrossReference($value, $b);
                }
            }
        }
        return $result;
    }
    public function processArrayConvertSimple($value){
        $result = "";
        if(count($value) > 0){
            $result .= $value[0];
        }
        if(count($value) > 1){
            for ($b = 1; $b < count($value); $b++){
                $result .= ', ' . $value[$b];
            }
        }
        return $result;
    }
    public function pStripper($value){
        return str_replace(['<p>','</p>'],'',$value);
    }
    public function indexStripper($value){
        return str_replace('/index.php','',$value);
    }

//    public function getFilters(): array
//    {
//        return [
//            // If your filter generates SAFE HTML, you should add a third
//            // parameter: ['is_safe' => ['html']]
//            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
//            new TwigFilter('filter_name', [$this, 'doSomething']),
//        ];
//    }
//
//    public function getFunctions(): array
//    {
//        return [
//            new TwigFunction('function_name', [$this, 'doSomething']),
//        ];
//    }
//
//    public function doSomething($value)
//    {
//        // ...
//    }
}
