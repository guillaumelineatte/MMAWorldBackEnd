<?php

namespace Controllers;

use Image;
use Doctrine\ORM\Query\ResultSetMapping;

class CarouselController extends Controller {

    public function imageList($params) {
        $entityManager = $params["em"];
        $imageRepository = $entityManager->getRepository('Image');
        $images = $imageRepository->findAll();

        echo $this->twig->render('image/imageList.html', ['images' => $images, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('image/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $nom = $_POST['nom'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $newImage= new Image();
            $newImage->setNom($nom);
            $newImage->setImage($image);

            $em->persist($newImage);
            $em->flush();

            header('Location: start.php?c=image&t=imageList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $images = $em->find('Image', $id);

        echo $this->twig->render('image/edit.html', ['images' => $images]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $image = $em->find('Image', $id);

        $image->setNom($params['post']['nom']);
        $image->setImage($params['post']['image']);

        $em->flush();

        header('Location: start.php?c=image&t=imageList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $image=$em->find('Image',$id);

        $em->remove($image);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=image&t=imageList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function imageData($params) {
        $entityManager = $params["em"];
        $imageRepository = $entityManager->getRepository('Image');
        $images = $imageRepository->findAll();

        $result = array();
        foreach ($images as $image) {
            $imageData = array(
                "nom" => $image->getNom(),
                "image" => $image->getImage()
            );
            array_push($result, $imageData);
        }
        echo json_encode($result);
    }
}
