<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewAccountFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function newAccount(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(NewAccountFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
//            dd($form->getData());
//            $data = $form->getData();
//            $new = new User();

//            $new->setDiscordName($data['discordName']);
//            $new->setEmail($data['email']);
//            $new->setPassword($data['password']);

            /** @var User $newUser */
            $newUser = $form->getData();
            $newUser->setPassword($passwordEncoder->encodePassword($newUser,$newUser->getPassword()));
            $em->persist($newUser);
            $em->flush();

            $this->addFlash('success','Account Created!');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('account/new.html.twig', [
            'genericParts'=>$this->genericParts,
            'newAccountForm'=>$form->createView(),
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

    /**
     * @Route("/account/permissions",name="inc_account_permission")
     */
//     * @IsGranted("ROLE_ADMIN")
    public function adjustPermissions(){
        return $this->render('account/permissions.html.twig',[
            'genericParts'=>$this->genericParts,
        ]);
    }
}
