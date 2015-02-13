<?php

namespace CeisSurvey\Bundle\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CeisSurvey\Bundle\UsersBundle\Entity\User;
use CeisSurvey\Bundle\UsersBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CeisSurveyDefaultController extends Controller {

    public function indexAction(Request $request) {   
        return $this->get('ceissurvey.usersbundle.services.userservice')->index($request);      
        
        //return $this->render('CeisSurveyUsersBundle:CeisSurveyDefault:index.html.twig', array('myForm' => $form->createView()));
    }

    public function createUserAction() {
        return $this->redirect($this->generateUrl('survey_homepage'));
        /*
        $newUser = new User();
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
        return $this->get('ceissurvey.usersbundle.services.userservice')->serviceGetUser($id);
    }
    
     public function updateUserAction($id) {
         return $this->get('ceissurvey.usersbundle.services.userservice')->serviceUpdateUser($id);
    }
    
     public function deleteUserAction($id) {
      return $this->get('ceissurvey.usersbundle.services.userservice')->serviceDeleteUser($id);
    }

}
