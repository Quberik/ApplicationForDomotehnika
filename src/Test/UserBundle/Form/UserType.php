<?php

/**
 * Создано при помощи PhpStorm.
 * Разработчик: Подлужный Владимир aka Quber
 * Контактные данные: quber.one@gmail.com
 * Дата и время создания: 14.11.2014 / 18:33
 * Название файла: UserType.php
 * Назначение:
 */

namespace Test\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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