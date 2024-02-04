<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};
use Framework\Exceptions\ValidationException;

class AuthController
{
    public function __construct(private TemplateEngine $view, private ValidatorService $validatorService, private UserService $userService)
    {
    }
    public function registerView()
    {
        echo $this->view->render("register.php");
    }
    public function register()
    {
        $this->validatorService->validateRegister($_POST);

        if ($this->userService->isEmailTaken($_POST["email"])) {
            throw new ValidationException(["email" => "email is already taken"]);
        };

        $this->userService->registerUser($_POST);

        redirectTo('/');
    }
    public function loginView()
    {
        echo $this->view->render("login.php");
    }

    public function login()
    {
        $this->validatorService->validateLogin($_POST);


        $this->userService->login($_POST);



        redirectTo('/');
    }

    public function logout()
    {
        $this->userService->logout();

        redirectTo("/login");
    }
}
