<?php

namespace Controllers;


class Controller {
    protected $twig;
    protected $db;

    function __construct() {
        $this->initializeTwig();
        $this->initializeDatabase();
    }

    protected function initializeTwig() {
        $loader = new \Twig\Loader\FilesystemLoader('./views');
        $this->twig = new \Twig\Environment($loader, array(
            'cache' => false,
            'debug' => true,
        ));
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    protected function initializeDatabase() {
        $this->db = new \PDO(
            'mysql:host=localhost;dbname=BTS_Guillaume;charset=utf8',
            'guillaume',
            'plop'
        );
    }

    public function base($params) {
        echo $this->twig->render('base.html', ['params' => $params]);
    }

    protected function hasSpecificEmail() {
        $allowedEmail = 'gibbale@gmail.com';

        return isset($_SESSION['user_email']) && $_SESSION['user_email'] === $allowedEmail;
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}
