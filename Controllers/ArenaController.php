<?php

namespace Controllers;

use Arena;
use Doctrine\ORM\Query\ResultSetMapping;

class ArenaController extends Controller {

    public function arenaList($params) {
        $entityManager = $params["em"];
        $arenaRepository = $entityManager->getRepository('Arena');
        $arenas = $arenaRepository->findAll();

        echo $this->twig->render('arena/arenaList.html', ['arenas' => $arenas, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('arena/create.html');
    }

    public function insert($params) {
            $em = $params['em'];
            $name = $_POST['name'];
            $city = $_POST['city'];
            $place = $_POST['place'];
            $icon = file_get_contents($_FILES['icon']['tmp_name']);

            $newArena = new Arena();
            $newArena->setName($name);
            $newArena->setCity($city);
            $newArena->setPlace($place);
            $newArena->setIcon($icon);

            $em->persist($newArena);
            $em->flush();

            header('Location: start.php?c=arena&t=arenaList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $arenas = $em->find('Arena', $id);

        echo $this->twig->render('arena/edit.html', ['arenas' => $arenas]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $arena = $em->find('Arena', $id);

        $arena->setName($params['post']['name']);
        $arena->setCity($params['post']['city']);
        $arena->setPlace($params['post']['place']);

        $em->flush();

        header('Location: start.php?c=arena&t=arenaList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $arena=$em->find('Arena',$id);

        $em->remove($arena);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=arena&t=arenaList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }
}
