<?php

namespace CeisSurvey\Bundle\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CeisSurvey\Bundle\UsersBundle\Entity\User;
use CeisSurvey\Bundle\UsersBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CeisSurveyDefaultController extends Controller {

    public function indexAction(Request $request) {
        $form = $this->get("ceis_survey.usersbundle.services.users")->index($request);
        
        return $this->render('CeisSurveyUsersBundle:CeisSurveyDefault:index.html.twig', array('myForm' => $form->createView()));
    }

    public function createUserAction() {
        
        return $this->redirect($this->generateUrl('survey_homepage'));
        
        /*$newUser = new User();
        $newUser->setFname('Girish');
        $newUser->setLname('Taware');
        $newUser->setFunction('Consultant');
        $newUser->setEmail('girish.taware1987@gmail.com');
        $newUser->setUsername('gtaware');
        $newUser->setPassword('admingtaware');
        $newUser->setIsAdmin('Yes');

        $em = $this->getDoctrine()->getManager();
        $em->persist($newUser);
        $em->flush();

        return new Response('Added a new user ' . $newUser->getId());
         * 
         */
    }

    public function getUserAction($id) {
        $userInfo = $this->getDoctrine()
                ->getRepository('CeisSurveyUsersBundle:User')
                ->find($id);

        if ($userInfo) {
            return new Response('Valid user.');
        } else {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }
    }
    
     public function updateUserAction($id) {
        $em = $this->getDoctrine()->getManager(); 
        
        $userInfo = $em->getRepository('CeisSurveyUsersBundle:User')
                ->find($id);

        if (!$userInfo) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }

        $userInfo->setUsername('UpdateCall');
         $em->persist($userInfo);
        $em->flush();
        
        return new Response('The user is updated successfully.');
    }
    
     public function deleteUserAction($id) {
        $em = $this->getDoctrine()->getManager(); 
        
        $userInfo = $em->getRepository('CeisSurveyUsersBundle:User')
                ->find($id);

        if (!$userInfo) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }
        $fname = $userInfo->getFname();
        $lname = $userInfo->getLname();

        $em->remove($userInfo);
        $em->flush();
        
        return new Response("The user <b>$fname $lname</b> is deleted successfully.");
    }

}
