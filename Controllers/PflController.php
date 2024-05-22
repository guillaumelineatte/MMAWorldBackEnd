<?php

namespace Controllers;

use Doctrine\ORM\Query\ResultSetMapping;
use Pfl;

class PflController extends Controller {

    public function PflList($params) {
        $entityManager = $params["em"];
        $pflRepository = $entityManager->getRepository('Pfl');
        $pfls = $pflRepository->findAll();

        echo $this->twig->render('pfl/pflList.html', ['pfls' => $pfls, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('pfl/create.html');
    }

    public function insert($params) {
            $em = $params['em'];

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newPfl = new Pfl();
            $newPfl->setTitle($title);
            $newPfl->setDescription($description);
            $newPfl->setImage($image);

            $em->persist($newPfl);
            $em->flush();

            header('Location: start.php?c=pfl&t=pflList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $pfls = $em->find('Pfl', $id);

        echo $this->twig->render('pfl/edit.html', ['pfls' => $pfls]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $pfl = $em->find('Pfl', $id);

        $pfl->setTitle($params['post']['title']);
        $pfl->setDescription($params['post']['description']);
        $pfl->setImage($params['post']['image']);


        $em->flush();

        header('Location: start.php?c=pfl&t=pflList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $pfl=$em->find('Pfl',$id);

        $em->remove($pfl);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=pfl&t=pflList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function pflData($params) {
        $entityManager = $params["em"];
        $pflRepository = $entityManager->getRepository('Pfl');
        $pfls = $pflRepository->findAll();

        $result = array();
        foreach ($pfls as $pfl) {
            $pflData = array(
                "title" => $pfl->getTitle(),
                "description" => $pfl->getDescription(),
                "image" => $pfl->getImage(),
            );
            array_push($result, $pflData);
        }
        echo json_encode($result);
    }
}
