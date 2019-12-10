<?php


namespace App\Service\ImportUGF;


use Doctrine\ORM\EntityManagerInterface;

class BaseUGFImporter
{

    public function __construct(EntityManagerInterface $em,UGFImportFunctions $functions)
    {
        $this->em = $em;
        $this->ugfFilePath = '../lib/xml/Incarnate-System.xml';
        $this->ugf = simplexml_load_file($this->ugfFilePath);
        $this->functions = $functions;
        $this->incImportType = $incImportType = require('ImportTypes.php');
    }
}