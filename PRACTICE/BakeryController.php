<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Controller\Bakery_modelController;

class BakeryController extends AbstractController
{
    
	private $session;
	private $bakery_model;
	private $validator;
	
	public function __construct(SessionInterface $session, Bakery_modelController $bakery_model, ValidatorInterface $validator)
    {
		$this->session = $session;
		$this->bakery_model = $bakery_model;
        $this->validator = $validator;
    }
	
		
	/**
     * @Route("/bakery", name="bakery")
     */
    public function index(): Response
    {
        return $this->render('bakery/home.html.twig', [
            'controller_name' => 'BakeryController',
        ]);
    }

    /**
     * @Route("/menu/{cat_id?}", name="menu")
     */
    public function menu($cat_id = false): Response
    {
        $data['categories'] = $this->bakery_model->get_categories();
        if ($cat_id){
            $data['products'] = $this->bakery_model->get_products_by_category($cat_id);
            $data['cat_id'] = $cat_id;
        }    
        else {
            $data['products'] = $this->bakery_model->get_products_by_category(1);
            $data['cat_id'] = 1;
        }
            
        return $this->render('bakery/menu.html.twig', $data);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(){
        return 0;
    }

     /**
     * @Route("/login", name="login")
     */
    public function login(){
        return 0;
    }

}
