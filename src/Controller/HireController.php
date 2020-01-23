<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HireController extends AbstractController
{
    /**
     * @Route("/hire/standards", name="inc_hire_standards")
     */
    public function hire_standards_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('hire/hire-standards.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
    /**
     * @Route("/hire/", name="inc_hire")
     */
    public function hire_page()
    {
        require '../lib/php/functions.php';
        $genericParts = genericParts();
        return $this->render('hire/hire.html.twig',[
            'genericParts' => $genericParts,
        ]);
    }
}