<?php

namespace ProdutoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexControllerController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('ProdutoBundle:Produto')->findAllInOrder();

        /** @var  $paginator */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($produtos, $request->query->get('page', 1), 3);

        return [
            'pagination' => $pagination
        ];
    }

    /**
     * @Route("/show/{id}", name="show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository('ProdutoBundle:Produto')->find($id);

        if (!$produto) {
            throw $this->createNotFoundException('O produto não existe! Volte para home!');
        }

        return [
            'produto' => $produto,
        ];
    }

}
