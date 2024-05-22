<?php

namespace Controllers;

use Complement;
use Doctrine\ORM\Query\ResultSetMapping;

class ComplementController extends Controller {

    public function complementList($params) {
        $entityManager = $params["em"];
        $complementRepository = $entityManager->getRepository('Complement');
        $complements = $complementRepository->findAll();

        echo $this->twig->render('complement/complementList.html', ['complements' => $complements, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('complement/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newComplement= new Complement();
            $newComplement->setTitle($title);
            $newComplement->setDescription($description);
            $newComplement->setImage($image);

            $em->persist($newComplement);
            $em->flush();

            header('Location: start.php?c=complement&t=complementList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $complements = $em->find('Complement', $id);

        echo $this->twig->render('complement/edit.html', ['complements' => $complements]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $complement = $em->find('Complement', $id);

        $complement->setTitle($params['post']['title']);
        $complement->setDescription($params['post']['description']);
        $complement->setImage($params['post']['image']);

        $em->flush();

        header('Location: start.php?c=complement&t=complementList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $complement=$em->find('Complement',$id);

        $em->remove($complement);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=complement&t=complementList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function complementData($params) {
        $entityManager = $params["em"];
        $complementRepository = $entityManager->getRepository('Complement');
        $complements = $complementRepository->findAll();

        $result = array();
        foreach ($complements as $complement) {
            $complementData = array(
                "title" => $complement->getTitle(),
                "description" => $complement->getDescription(),
                "image" => $complement->getImage()
            );
            array_push($result, $complementData);
        }
        echo json_encode($result);
    }
}
