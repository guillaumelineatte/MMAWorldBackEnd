<?php
require_once 'vendor/autoload.php';

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=BTS_Guillaume;charset=utf8',
        'guillaume',
        'plop'
    );
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

$loader = new \Twig\Loader\FilesystemLoader('Vues/');
$twig = new \Twig\Environment($loader);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'home':
        $dataStatut = $db->prepare('SELECT * FROM users');
        $dataStatut->execute();
        $datas = $dataStatut->fetchAll();

        echo $twig->render('index.html.twig', [
            'the' => 'variables',
            'go' => 'here',
            'users' => $datas
        ]);
        break;

    case 'combattants':
        $combattantsStatut = $db->prepare('SELECT * FROM combattants');
        $combattantsStatut->execute();
        $combattants = $combattantsStatut->fetchAll();

        echo $twig->render('combattant.html.twig', [
            'combattants' => $combattants
        ]);
        break;

        case 'showUser':
            $userController = new \Controllers\UserController();
            $userId = $_GET['userId'] ?? null;
            $userController->showUser(['em' => $entityManager, 'userId' => $userId]);
            break;

    }
