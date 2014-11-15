<?php

namespace Test\UserBundle\Tests\Form\Type;

use Test\UserBundle\Entity\User;
use Test\UserBundle\Form\UserType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class TestedTypeTest
 * @package Test\UserBundle\Tests\Form\Type
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
 */
class TestedTypeTest extends TypeTestCase
{

    /**
     * @dataProvider getValidTestData
     * @param $data
     * @return array
     */
    public function getValidTestData($data)
    {
        return array(
            array(
                'email' => 'pick@test.ru',
                'nick'  => 'Alexander'
            ),
            array(
                'email' => 'slava@mail.ru',
                'nick'  => 'Slava Mikle'
            )
        );
    }

    public function testSubmitValidData()
    {
        $data = $this->getValidTestData();

        $type = new UserType();
        $form = $this->factory->create($type);

        $object = new User();
        $object->fromArray($data);

        // submit the data to the form directly
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}