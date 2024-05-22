<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use Nationalite;
use Doctrine\ORM\Query\ResultSetMapping;

class NationaliteController extends Controller {

    public function create()
    {
        echo $this->twig->render('nationalite/nationalite.html');
    }

    public function insert($params) {

        $em = $params['em'];
        $name =($_POST['name']);

        $newNationalite = new Nationalite();
        $newNationalite-> setName($name);

        $em->persist($newNationalite);
        $em->flush();

        header('Location: start.php?c=user&t=nationaliteList');
    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $nationalites = $em->find('Nationalite', $id);
        echo $this->twig->render('edit.html', ['nationalites' => $nationalites]);

    }

    public function update($params) {
        $id = $params['get']['id'];
        $em = $params['em'];
        $user = $em->find('Nationalite', $id);

        $user->setNom = $params['post']['nom'];
        $user->setPrenom =$params['post']['prenom'];



        $em->flush();
        header('Location: start.php?c=nationalite&t=nationaliteList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $nationalite=$em->find('Nationalite',$id);

        $em->remove($nationalite);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=nationalite&t=nationaliteList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }
}
