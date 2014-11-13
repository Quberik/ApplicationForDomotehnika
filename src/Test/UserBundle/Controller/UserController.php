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
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package Test\UserBundle\Controller
 */
class UserController extends Controller
{

    /**
     * Get users list by @param
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $finder = $this->container->get('fos_elastica.finder.search.user');

        $query = new \Elastica\Query();
        $facet = new \Elastica\Facet\Terms('tags');
        $facet->setField('email');
        $query->addFacet($facet);

        $results = $finder->find($query);

//        $users = $repository->findAny(
//            array(
//                'email' => $request->query->get('email'),
//                'username' => $request->query->get('login'),
//                'nick' => $request->query->get('nick')
//            )
//        );

        return $this->render('::User/list.html.twig', array(
            'users' => $results
        ));
    }

    /**
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
        var_dump($result);
        return new Response($result);
    }

}