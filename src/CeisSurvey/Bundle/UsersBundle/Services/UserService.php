<?php
namespace CeisSurvey\Bundle\UsersBundle\Services;

use CeisSurvey\Bundle\UsersBundle\Entity\User;
use CeisSurvey\Bundle\UsersBundle\Form\Type\UserType;

class UserService{
    
    private $container;
    
    public function __construct($container) {
        $this->container = $container;
    }
    
    public function index($request){
        $user = new User();
        //Temparary data
        //$user->setUsername('gtaware');    
        
       $form = $this->container->get('form.factory')->create(new UserType(), $user);
       $form->handleRequest($request);

        if ($form->isValid()) {
            $newUser = $form->getData();
            $newUser->setIsAdmin('No');
            
            /*echo "<pre>";
            print_r($newUser);
            die; 
             * 
             */
            $em = $this->getDoctrine()->getManager();
            $em->persist($newUser);
            $em->flush();
            return new Response("Added a new user. <br> id = " . $newUser->getId());
            die;
            return $this->redirect($this->generateUrl('survey_createUser'));
        }
       return $form;
       
    }
    
}
?>
