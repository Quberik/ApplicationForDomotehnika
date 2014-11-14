<?php

/**
 * Author: Podluzhnyy Vladimir aka Quber
 * Contact: quber.one@gmail.com
 * Date & Time: 12.11.2014 / 18:05
 * Filename: UserController.php
 * Notes: Special for Domotehnika
 */

namespace Test\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package Test\UserBundle\Controller
 */
class UserController extends Controller
{

    /**
     * Get users list by criteria
     *
     * @param Request $request
     * @param $_format
     * @param int $limit
     * @return Response
     */
    public function listAction(Request $request, $_format)
    {
        $finder = $this->container->get('fos_elastica.finder.api.user');

        $users = $finder->find(
            $request->query->get("search")
        );

        if($users) {
            $result = $this->container->get('serializer')->serialize($users, $_format);
            return new Response($result);
        }
        else throw $this->createNotFoundException('No user found');
    }

    /**
     * Get one user by ID
     *
     * @param $id
     * @param $_format
     * @return Response json|xml
     */
    public function showAction($id, $_format)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TestUserBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $result = $this->container->get('serializer')->serialize($user, $_format);
        return new Response($result);
    }

}