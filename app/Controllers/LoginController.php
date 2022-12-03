<?php

namespace Controllers;

use Models\Services\SessionService;
use Models\Services\UserService;

class LoginController extends \Zephyrus\Security\Controller
{
    public function initializeRoutes()
    {
        $this->post("/login", "login");
        $this->post("/signup", "signup");
    }

    public function login()
    {
        $params = $this->request->getParameters();
        $user = UserService::login($params);
        $sessions = SessionService::findSessions($user->id);
        $user->sessions = $sessions;
        echo json_encode($user);
        die();
    }

    public function signup()
    {
        $params = $this->request->getParameters();
        $userID = UserService::createAccount($params);
        $test = json_encode($userID);
        echo $test;
    }
}