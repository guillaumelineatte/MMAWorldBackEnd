<?php

namespace Controllers;

use Doctrine\ORM\Query\ResultSetMapping;
use Ufc;

class UfcController extends Controller {

    public function ufcList($params) {
        $entityManager = $params["em"];
        $ufcRepository = $entityManager->getRepository('Ufc');
        $ufcs = $ufcRepository->findAll();

        echo $this->twig->render('ufc/ufcList.html', ['ufcs' => $ufcs, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('ufc/create.html');
    }

    public function insert($params) {
            $em = $params['em'];

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newUfc = new Ufc();
            $newUfc->setTitle($title);
            $newUfc->setDescription($description);
            $newUfc->setImage($image);

            $em->persist($newUfc);
            $em->flush();

            header('Location: start.php?c=ufc&t=ufcList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $ufcs = $em->find('Ufc', $id);

        echo $this->twig->render('ufc/edit.html', ['ufcs' => $ufcs]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $ufc = $em->find('Ufc', $id);

        $ufc->setTitle($params['post']['title']);
        $ufc->setDescription($params['post']['description']);
        $ufc->setImage($params['post']['image']);


        $em->flush();

        header('Location: start.php?c=ufc&t=ufcList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $ufc=$em->find('Ufc',$id);

        $em->remove($ufc);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=ufc&t=ufcList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function ufcData($params) {
        $entityManager = $params["em"];
        $ufcRepository = $entityManager->getRepository('Ufc');
        $ufcs = $ufcRepository->findAll();

        $result = array();
        foreach ($ufcs as $ufc) {
            $ufcData = array(
                "title" => $ufc->getTitle(),
                "description" => $ufc->getDescription(),
                "image" => $ufc->getImage(),
            );
            array_push($result, $ufcData);
        }
        echo json_encode($result);
    }
}
