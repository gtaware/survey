<?php

// src/AppBundle/Form/Type/TaskType.php

namespace CeisSurvey\Bundle\UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
               'validation_groups' => array('registration'),
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('fname', 'text', array(
                'label' => 'First name',
                'attr' => array('maxlength' => 20)
            ))
            ->add('lname', 'text', array(
                'label' => 'Last name',
                'attr' => array('maxlength' => 20)
            ))
            ->add('gender', 'choice', array(
                'choices' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Others' => 'Others',
                    ),
            ))
            ->add('function', 'text', array(
                'attr' => array('maxlength' => 50)
            ))
            ->add('email', 'text', array(
                'attr' => array('maxlength' => 50)
            ))
            ->add('username', 'text', array(
                'attr' => array('maxlength' => 10)
            ))
            ->add('password', 'password',array(
                'attr' => array(
                                'maxlength' => 10,
                                ),
                ))
            ->add('Sign in', 'submit', array(
                    'attr' => array(
                                'class' => 'btn btn-success',
                     )
                    ));
    }

    public function getName() {
        return 'user';
    }

}

?>