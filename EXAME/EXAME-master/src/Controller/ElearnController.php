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
use App\Controller\Elearn_modelController;

class ElearnController extends AbstractController
{
    
	private $session;
	private $elearn_model;
	private $validator;
	
	public function __construct(SessionInterface $session, Elearn_modelController $elearn_model, ValidatorInterface $validator)
    {
		$this->session = $session;
		$this->elearn_model = $elearn_model;
        $this->validator = $validator;
    }
	
		
	/**
     * @Route("/elearn", name="elearn")
     */
    public function index(): Response
    {
        return $this->render('elearn/home.html.twig', [
            'controller_name' => 'ElearnController',
        ]);
    }

    /**
     * @Route("/courses", name="courses")
     */
     public function courses(){
        if ($this->session->get('user_id')) {
            $data['user_name'] = $this->session->get('user_name');
            $data['user_id'] = $this->session->get('user_id');
        }
        $courses = $this->elearn_model->get_courses();
        $data['courses'] = $courses;

        return $this->render('elearn/courses.html.twig',$data);
     }


    /**
    * @Route("/enroll/{course_id}", name="enroll")
    */
     public function enroll($course_id): Response
     {
        $user_id = $this->session->get('user_id');
        if($user_id){
            $result = $this->elearn_model->create_enroll($user_id, $course_id);
            if($result) return $this->redirectToRoute('courses');
            else{
                $response = new Response('An unexpected error occured trying to enroll.', Response::HTTP_BAD_REQUEST);
                $response->send();
            }
        }else{
            return $this->redirectToRoute('login');
        }
     }

    /**
    * @Route("/myCourses", name="myCourses")
    */
    public function myCourses(): Response
    {
        $user_id = $this->session->get('user_id');
        if ($user_id) {
            $data['user_name'] = $this->session->get('user_name');
            $data['user_id'] = $this->session->get('user_id');
            $result = $this->elearn_model->get_enrolls($user_id);
            $data['enrolls'] = $result;
            return $this->render('elearn/myCourses.html.twig', $data);
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
    * @Route("/login", name="login")
    */
    public function login(): Response
    {
        if ($this->session->get('user_id')) return $this->redirectToRoute('courses');
        if ($this->session->get('errors') > 0) {
            $data['errors'] = $this->session->get('errors');
            $data['email'] = $this->session->get('email');
            $data['name'] = $this->session->get('name');
            $data['errorMessages'] = $this->session->get('errorMessages');
            $this->session->set('errors', 0);
        } else {
            $data['errors'] = 0;
            $data['email'] = '';
            $data['name'] = '';
        }
        return $this->render('elearn/login.html.twig', $data);
    }

    /**
    * @Route("/login_action", name="login_action")
    */
    public function login_action(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $password_digest = substr(md5($password), 0, 32);

        $user = $this->elearn_model->login($email, $password_digest);

        if ($user == false) $value = '';
        else $value = $password;

        $input = ['password' => $password,  'email' => $email];

        $constraints = new Assert\Collection([
            'email' => [new Assert\NotBlank(['message' => "Email is empty!"])],
            'password' => [
                new Assert\notBlank(['message' => "Password is empty!"]),
                new Assert\EqualTo(['value' => $value, 'message' => "Wrong username or password"])
            ],
        ]);

        $data = $this->requestValidation($input, $constraints);

        if ($data['errors'] > 0) {
            $this->session->set('email', $email);
            $this->session->set('errors', $data['errors']);
            $this->session->set('errorMessages', $data['errorMessages']);
            return $this->redirectToRoute('login');
        }

        $this->session->set('user_name', $user["name"]);
        $this->session->set('user_id', $user['id']);

        return $this->redirectToRoute('courses');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        $this->session->remove('user_name');
        $this->session->remove('user_id');
        return $this->redirectToRoute('elearn');
    }

    /**
    * @Route("/register", name="register")
    */
    public function register(): Response
    {
        if ($this->session->get('user_id')) return $this->redirectToRoute('courses');
        if ($this->session->get('errors') > 0) {
            $data['errors'] = $this->session->get('errors');
            $data['email'] = $this->session->get('email');
            $data['name'] = $this->session->get('name');
            $data['errorMessages'] = $this->session->get('errorMessages');
            $this->session->set('errors', 0);
        } else {
            $data['errors'] = 0;
            $data['email'] = '';
            $data['name'] = '';
        }
        return $this->render('elearn/register.html.twig', $data);
    }

    /**
    * @Route("/register_action", name="register_action")
    */
    public function register_action(Request $request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $passconf = $request->request->get('password_confirm');
        $password_digest = substr(md5($password), 0, 32);

        $email_query = $this->elearn_model->get_email($email);

        if ($email_query == false)
            $value = 'error';
        else
            $value = $email_query['email'];

        $input = ['password' => $password, 'passconf' => $passconf, 'email' => $email, 'name' => $name];

        $constraints = new Assert\Collection([
            'name' => [
                new Assert\NotBlank(['message' => "Name can't be empty!"])
            ],
            'email' => [
                new Assert\NotBlank(['message' => "Email is empty!"]),
                new Assert\NotEqualTo(['value' => $value, 'message' => "This email already exists!"])
            ],
            'passconf' => [new Assert\NotBlank(['message' => "Password Confirmation must not be blank"])],
            'password' => [
                new Assert\NotBlank(['message' => "Password is empty!"]),
                new Assert\EqualTo(['value' => $passconf, 'message' => "Passwords don't match!"])
            ],
        ]);

        $data = $this->requestValidation($input, $constraints);
        
        if ($data['errors'] > 0) {
            $this->session->set('email', $email);
            $this->session->set('name', $name);
            $this->session->set('errors', $data['errors']);
            $this->session->set('errorMessages', $data['errorMessages']);
            return $this->redirectToRoute('register');
        }

        $result = $this->elearn_model->register($email, $name, $password_digest);

        if ($result) {
            return $this->redirectToRoute('login');
        } else {
            return $this->redirectToRoute('register');
        }
    }

    private function requestValidation($input, $constraints)
    {
        $violations = $this->validator->validate($input, $constraints);

        $errorMessages = [];

        if (count($violations) > 0) {

            $accessor = PropertyAccess::createPropertyAccessor();

            foreach ($violations as $violation) {
                $accessor->setValue(
                    $errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage()
                );
            }
        }
        $data['errors'] = count($violations);
        $data['errorMessages'] = $errorMessages;

        return $data;
    }
}
