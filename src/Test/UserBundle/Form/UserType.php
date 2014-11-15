<?php

namespace Test\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserType
 *
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
 * @package Test\UserBundle\Form
 */
class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
            ->add('nick', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Test\UserBundle\Entity\User',
            'intention'          => 'user',
            'translation_domain' => 'TestUserBundle'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}