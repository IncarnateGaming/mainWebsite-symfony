<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends BaseController
{

    /**
     * @var array
     */
    private $genericParts;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        require_once '../lib/php/functions.php';
        $this->genericParts = genericParts();
    }

    /**
     * @Route("/account", name="inc_account_new")
     */
    public function newAccount()
    {
        return $this->render('account/new.html.twig', [
            'genericParts'=>$this->genericParts,
        ]);
    }

    /**
     * @Route("/account/manage", name="inc_account_manage")
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function manageAccount()
    {
        $this->getUser();
        return $this->render('account/manage.html.twig',[
            'genericParts'=>$this->genericParts,
        ]);
    }
    /**
     * @Route("/account/password",name="inc_account_password")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function changePassword(){
        return $this->render('account/password.html.twig',[
            'genericParts'=>$this->genericParts,
        ]);
    }
}
