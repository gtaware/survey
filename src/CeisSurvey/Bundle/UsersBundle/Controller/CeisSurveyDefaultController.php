<?php

namespace CeisSurvey\Bundle\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CeisSurvey\Bundle\UsersBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;

class CeisSurveyDefaultController extends Controller {

    public function indexAction(Request $request) {

        $person = new Person();

        $person->setUsername('Girish');
        $person->setPassword('123456');


        $form = $this->createFormBuilder($person)
                ->add('username', 'text')
                ->add('password', 'password')
                ->add('Sign in', 'submit', array(
                    'attr' => array(
                        'formnovalidate' => 'formnovalidate',
                        'class' => 'btn btn-success',
                    )
                ))
                ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {
            exit('Form was valid');
            return $this->redirect($this->generateUrl('survey_homepage'));
        }

        return $this->render('CeisSurveyUsersBundle:CeisSurveyDefault:index.html.twig', array('myForm' => $form->createView()));
    }

}
