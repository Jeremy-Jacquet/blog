<?php

namespace App\src\blogFram;

use Exception;
use App\src\controller\FrontController;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\LogController;

/**
 * Router
 */
class Router
{    
    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var FrontController
     */
    private $frontController;

    /**
     * @var BackController
     */
    private $backController;

    /**
     * @var ErrorController
     */
    private $errorController;

    /**
     * @var LogController
     */
    private $logController;
    
    /**
     * Construct Router
     *
     * @return void
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
        $this->logController = new LogController();
    }
    
    /**
     * Launch router
     *
     * @return void
     */
    public function run()
    {
        $route = $this->request->getGet()->get('route');
        $action = $this->request->getGet()->get('action');
        $category = $this->request->getGet()->get('categorie');
        $id = $this->request->getGet()->get('id');
        $post = $this->request->getPost();
        $token = $this->request->getGet()->get('token');
        $email = $this->request->getGet()->get('email');
        
        try {
            if(isset($route)) {
                if($route === 'accueil') {
                    $this->frontController->home();
                } 
                elseif($route === 'categories') {
                    $this->frontController->categories();
                }
                elseif($route === 'articles') {
                    if($category) {
                        $this->frontController->articlesByCategory($category);
                    } elseif($id) {
                        $this->frontController->single($id, $post);
                    } else {
                        $this->frontController->articles();
                    }
                }
                elseif($route === 'inscription') {
                    if($action === 'confirmation' AND $email AND $token) {
                        $this->frontController->confirmRegister($email, $token);
                    } else {
                        $this->frontController->displayRegister($post);
                    }
                }
                elseif($route === 'connexion') {
                    $this->frontController->login($post);
                }
                elseif($route === 'deconnexion') {
                    $this->logController->logout();
                }
                elseif($route === 'profil') {
                    $this->backController->profile($post);
                }
                elseif($route === 'admin') {
                    if($category === 'membres') {
                        $this->backController->displayUsers($post);
                    } elseif($category === 'categories') {
                        $this->backController->displayCategories();
                    } else {
                        $this->backController->dashboard($post);
                    }
                }
                else {
                    $this->errorController->errorNotFound();
                }
            } 
            else {
                $this->frontController->home();
            }
        }
        catch (Exception $e) {
        }
    }
}