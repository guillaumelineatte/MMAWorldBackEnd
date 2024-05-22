<?php

namespace Controllers;

use Cloth;
use Doctrine\ORM\Query\ResultSetMapping;

class ClothController extends Controller {

    public function clothList($params) {
        $entityManager = $params["em"];
        $clothRepository = $entityManager->getRepository('Cloth');
        $cloths = $clothRepository->findAll();

        echo $this->twig->render('cloth/clothList.html', ['cloths' => $cloths, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('cloth/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newCloth= new Cloth();
            $newCloth->setTitle($title);
            $newCloth->setDescription($description);
            $newCloth->setImage($image);

            $em->persist($newCloth);
            $em->flush();

            header('Location: start.php?c=cloth&t=clothList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $cloths = $em->find('Cloth', $id);

        echo $this->twig->render('cloth/edit.html', ['cloths' => $cloths]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $cloth = $em->find('Cloth', $id);

        $cloth->setTitle($params['post']['title']);
        $cloth->setDescription($params['post']['description']);
        $cloth->setImage($params['post']['image']);

        $em->flush();

        header('Location: start.php?c=cloth&t=clothList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $cloth=$em->find('Cloth',$id);

        $em->remove($cloth);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=cloth&t=clothList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function clothData($params) {
        $entityManager = $params["em"];
        $clothRepository = $entityManager->getRepository('Cloth');
        $cloths = $clothRepository->findAll();

        $result = array();
        foreach ($cloths as $cloth) {
            $clothData = array(
                "title" => $cloth->getTitle(),
                "description" => $cloth->getDescription(),
                "image" => $cloth->getImage()
            );
            array_push($result, $clothData);
        }
        echo json_encode($result);
    }
}
