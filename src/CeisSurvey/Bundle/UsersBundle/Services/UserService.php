<?php
namespace CeisSurvey\Bundle\UsersBundle\Services;

use CeisSurvey\Bundle\UsersBundle\Entity\User;
use CeisSurvey\Bundle\UsersBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private $container;
    
    public function __construct($container) {
        $this->container = $container;
    }
    
    public function index($request) {
        $user = new User();
        $form = $this->container->get('form.factory')->create(new UserType(),$user);   
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newUser = $form->getData();
            $newUser->setIsAdmin('No');
            $em = $this->container->get('doctrine')->getManager();
            $em->persist($newUser);
            $em->flush();
            //return new Response('Added a new user ');
            $this->container->get('router')->generate('survey_createUser');
        }
        return $this->container->get('templating')->renderResponse('CeisSurveyUsersBundle:CeisSurveyDefault:index.html.twig', array('myForm' => $form->createView()));
    }
    
    public function serviceGetUser($id) {
            
            $userInfo = $this->container->get('doctrine')
                    ->getManager()->getRepository('CeisSurveyUsersBundle:User')
                    ->find($id);

        if ($userInfo) {
            return new Response('Valid user.');
        } else {
            return new Response('No user found for id ' . $id);
        }       
    }
    
    public function serviceUpdateUser($id) {
        //
        $em = $this->container->get('doctrine')
                    ->getManager();      
        
        $userInfo = $em->getRepository('CeisSurveyUsersBundle:User')
                ->find($id);

        if (!$userInfo) {
            return new Response('No user found for id ' . $id);
        }

        $userInfo->setUsername('UpdateCall');
         $em->persist($userInfo);
        $em->flush();
        
        return new Response('The user is updated successfully.');
    }
    
    public function serviceDeleteUser($id) {
        
        $em = $this->container->get('doctrine')
                    ->getManager();   
        
        $userInfo = $em->getRepository('CeisSurveyUsersBundle:User')
                ->find($id);

        if (!$userInfo) {
            return new Response('No user found for id ' . $id);
        }
        
        $fname = $userInfo->getFname();
        $lname = $userInfo->getLname();

        $em->remove($userInfo);
        $em->flush();
        
        return new Response("The user <b>$fname $lname</b> is deleted successfully.");
    }
    
}
