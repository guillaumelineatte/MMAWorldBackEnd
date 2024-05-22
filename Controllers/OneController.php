<?php

namespace Controllers;

use Doctrine\ORM\Query\ResultSetMapping;
use One;

class OneController extends Controller {

    public function oneList($params) {
        $entityManager = $params["em"];
        $oneRepository = $entityManager->getRepository('One');
        $ones = $oneRepository->findAll();

        echo $this->twig->render('one/oneList.html', ['ones' => $ones, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('one/create.html');
    }

    public function insert($params) {
            $em = $params['em'];

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newOne = new One();
            $newOne->setTitle($title);
            $newOne->setDescription($description);
            $newOne->setImage($image);

            $em->persist($newOne);
            $em->flush();

            header('Location: start.php?c=one&t=oneList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $ones = $em->find('One', $id);

        echo $this->twig->render('one/edit.html', ['ones' => $ones]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $one = $em->find('One', $id);

        $one->setTitle($params['post']['title']);
        $one->setDescription($params['post']['description']);
        $one->setImage($params['post']['image']);


        $em->flush();

        header('Location: start.php?c=one&t=oneList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $one=$em->find('One',$id);

        $em->remove($one);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=one&t=oneList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function oneData($params) {
        $entityManager = $params["em"];
        $oneRepository = $entityManager->getRepository('One');
        $ones = $oneRepository->findAll();

        $result = array();
        foreach ($ones as $one) {
            $oneData = array(
                "title" => $one->getTitle(),
                "description" => $one->getDescription(),
                "image" => $one->getImage(),
            );
            array_push($result, $oneData);
        }
        echo json_encode($result);
    }
}
