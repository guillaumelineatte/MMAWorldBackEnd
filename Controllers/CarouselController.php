<?php

namespace Controllers;

use Carousel;
use Doctrine\ORM\Query\ResultSetMapping;

class CarouselController extends Controller {

    public function carouselList($params) {
        $entityManager = $params["em"];
        $carouselRepository = $entityManager->getRepository('Carousel');
        $carousels = $carouselRepository->findAll();

        echo $this->twig->render('carousel/carouselList.html', ['carousels' => $carousels, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('carousel/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $banner = file_get_contents($_FILES['banner']['tmp_name']);

            $newCarousel = new Carousel();
            $newCarousel->setTitle($title);
            $newCarousel->setDescription($description);
            $newCarousel->setBanner($banner);

            $em->persist($newCarousel);
            $em->flush();

            header('Location: start.php?c=carousel&t=carouselList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $carousels = $em->find('Carousel', $id);

        echo $this->twig->render('carousel/edit.html', ['carousels' => $carousels]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $carousel = $em->find('Carousel', $id);

        $carousel->setTitle($params['post']['title']);
        $carousel->setDescription($params['post']['description']);
        $carousel->setBanner($params['post']['banner']);

        $em->flush();

        header('Location: start.php?c=carousel&t=carouselList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $carousel=$em->find('Carousel',$id);

        $em->remove($carousel);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=carousel&t=carouselList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function carouselData($params) {
        $entityManager = $params["em"];
        $carouselRepository = $entityManager->getRepository('Carousel');
        $carousels = $carouselRepository->findAll();

        $result = array();
        foreach ($carousels as $carousel) {
            $carouselData = array(
                "title" => $carousel->getTitle(),
                "description" => $carousel->getDescription(),
                "banner" => $carousel->getBanner()
            );
            array_push($result, $carouselData);
        }
        echo json_encode($result);
    }
}
