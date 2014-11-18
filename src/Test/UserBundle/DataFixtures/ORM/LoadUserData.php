<?php

namespace Test\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Test\UserBundle\Entity\User;
use Faker\Factory;

/**
 * Class LoadUserData
 * @package Test\UserBundle\DataFixtures\ORM
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
 */
class LoadUserData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 100; $i++)
        {
            $entity = new User();
            $entity->setEmail($faker->freeEmail);
            $entity->setNick($faker->name);
            $entity->setUsername($faker->userName);

            // Password generation
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($entity);
            $entity->setPassword(
                $encoder->encodePassword(
                    $faker->password, $entity->getSalt()
                )
            );

            $manager->persist($entity);
        }

        $manager->flush();

    }

}