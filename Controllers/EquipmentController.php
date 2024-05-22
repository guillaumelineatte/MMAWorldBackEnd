<?php

namespace Controllers;

use Equipment;
use Doctrine\ORM\Query\ResultSetMapping;

class EquipmentController extends Controller {

    public function equipmentList($params) {
        $entityManager = $params["em"];
        $equipmentRepository = $entityManager->getRepository('Equipment');
        $equipments = $equipmentRepository->findAll();

        echo $this->twig->render('equipment/equipmentList.html', ['equipments' => $equipments, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('image/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $title = $_POST['title'];
            $description = $_POST['nom'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newEquipment= new Equipment();
            $newEquipment->setTitle($title);
            $newEquipment->setDescription($description);
            $newEquipment->setImage($image);

            $em->persist($newEquipment);
            $em->flush();

            header('Location: start.php?c=equipment&t=equipmentList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $equipments = $em->find('Equipment', $id);

        echo $this->twig->render('equipment/edit.html', ['equipments' => $equipments]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $equipment = $em->find('Equipment', $id);

        $equipment->setTitle($params['post']['title']);
        $equipment->setDescription($params['post']['description']);
        $equipment->setImage($params['post']['image']);

        $em->flush();

        header('Location: start.php?c=equipment&t=equipmentList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $equipment=$em->find('Equipment',$id);

        $em->remove($equipment);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=equipment&t=equipmentList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function equipmentData($params) {
        $entityManager = $params["em"];
        $equipmentRepository = $entityManager->getRepository('Equipment');
        $equipments = $equipmentRepository->findAll();

        $result = array();
        foreach ($equipments as $equipment) {
            $equipmentData = array(
                "title" => $equipment->getTitle(),
                "nom" => $equipment->getDescription(),
                "image" => $equipment->getImage()
            );
            array_push($result, $equipmentData);
        }
        echo json_encode($result);
    }
}
