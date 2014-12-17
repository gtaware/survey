<?php

namespace Girish\Bundle\CrudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GirishCrudBundle:Default:index.html.twig', array('name' => $name));
    }
}
