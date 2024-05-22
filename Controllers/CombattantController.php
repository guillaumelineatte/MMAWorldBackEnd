<?php

namespace Controllers;

use Combattant;
use Doctrine\ORM\Query\ResultSetMapping;

class CombattantController extends Controller {

    public function combattantList($params) {
        $entityManager = $params["em"];
        $combattantRepository = $entityManager->getRepository('Combattant');
        $combattants = $combattantRepository->findAll();

        echo $this->twig->render('combattant/combattantList.html', ['combattants' => $combattants, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('combattant/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $pseudo = $_POST['pseudo'];
            $age = $_POST['age'];
            $poids = $_POST['poids'];
            $taille = $_POST['taille'];
            $allonge = $_POST['allonge'];
            $photo = file_get_contents($_FILES['photo']['tmp_name']);
            $victoire = $_POST['victoire'];
            $defaite = $_POST['defaite'];
            $egalite = $_POST['egalite'];
            $nationaliteName = $_POST['nationalite'];

            $nationalite = $em->getRepository('Nationalite')->findOneBy(['name' => $nationaliteName]);
    if (!$nationalite) {
        // Gérer le cas où la nationalité n'est pas trouvée
        throw new \Exception("Nationalité non trouvée");
    }

            $newCombattant = new Combattant();
            $newCombattant->setName($name);
            $newCombattant->setSurname($surname);
            $newCombattant->setPseudo($pseudo);
            $newCombattant->setAge($age);
            $newCombattant->setPoids($poids);
            $newCombattant->setTaille($taille);
            $newCombattant->setAllonge($allonge);
            $newCombattant->setPhoto($photo);
            $newCombattant->setVictoire($victoire);
            $newCombattant->setDefaite($defaite);
            $newCombattant->setEgalite($egalite);
            $newCombattant->setNationalite($nationalite);

            $em->persist($newCombattant);
            $em->flush();

            header('Location: start.php?c=combattant&t=combattantList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $combattants = $em->find('Combattant', $id);

        echo $this->twig->render('combattant/edit.html', ['combattants' => $combattants]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $combattant = $em->find('Combattant', $id);

        $combattant->setName($params['post']['name']);
        $combattant->setSurname($params['post']['surname']);
        $combattant->setPseudo($params['post']['pseudo']);
        $combattant->setAge($params['post']['age']);
        $combattant->setPoids($params['post']['poids']);
        $combattant->setTaille($params['post']['taille']);
        $combattant->setAllonge($params['post']['allonge']);
        $combattant->setVictoire($params['post']['victoire']);
        $combattant->setDefaite($params['post']['defaite']);
        $combattant->setEgalite($params['post']['egalite']);
        $combattant->setNationalite($params['post']['nationalite']);
        $combattant->setPhoto($params['post']['photo']);


        $em->flush();

        header('Location: start.php?c=combattant&t=combattantList');
    }

    public function delete($params) {
        $id = $params['get']['id'];
        echo "ID: $id"; // Debugging: Vérifiez l'ID récupéré

        $em = $params['em'];
        $combattant = $em->find('Combattant', $id);
        var_dump($combattant); // Debugging: Vérifiez si une entité Combattant est récupérée

        $em->remove($combattant);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=combattant&t=combattantList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }
}
