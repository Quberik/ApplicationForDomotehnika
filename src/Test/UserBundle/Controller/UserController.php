<?php

namespace Test\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Test\UserBundle\Form\UserType;

/**
 * Class UserController
 * @package Test\UserBundle\Controller
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
 */
class UserController extends Controller
{

    /**
     * Get users list by criteria
     *
     * @param Request $request
     * @param $_format
     * @return object Response json|xml
     */
    public function listAction(Request $request, $_format)
    {
        if($request->query->get("search"))
        {
            $finder = $this->container->get('fos_elastica.finder.api.user');

            $users = $finder->find(
                $request->query->get("search")
            );
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('TestUserBundle:User')->findAll();
        }

        if($users) {
            $result = $this->container->get('serializer')->serialize($users, $_format);
            return new Response($result);
        }
        else throw $this->createNotFoundException('No users found');
    }

    /**
     * Get one user by ID
     *
     * @param int $id
     * @param $_format
     * @return object Response json|xml
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

    /**
     * Update user by POST request
     *
     * @param Request $request
     * @param int $id
     * @return object Response json|xml
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TestUserBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            return new Response("User was updated", 200);
        }

        return new Response("Email is invalid or form is not submitted", 400);

    }

}