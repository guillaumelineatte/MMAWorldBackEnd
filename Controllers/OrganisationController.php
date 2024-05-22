<?php

namespace Controllers;

use Doctrine\ORM\Query\ResultSetMapping;
use Organisation;

class OrganisationController extends Controller {

    public function organisationList($params) {
        $entityManager = $params["em"];
        $organisationRepository = $entityManager->getRepository('Organisation');
        $organisations = $organisationRepository->findAll();

        echo $this->twig->render('organisation/organisationList.html', ['organisations' => $organisations, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('organisation/create.html');
    }

    public function insert($params) {
            $em = $params['em'];

            $name = $_POST['name'];
            $country = $_POST['country'];
            $founder = $_POST['founder'];
            $roster = $_POST['roster'];
            $logo = file_get_contents($_FILES['logo']['tmp_name']);

            $newOrganisation = new Organisation();
            $newOrganisation->setName($name);
            $newOrganisation->setCountry($country);
            $newOrganisation->setFounder($founder);
            $newOrganisation->setRoster($roster);
            $newOrganisation->setLogo($logo);

            $em->persist($newOrganisation);
            $em->flush();

            header('Location: start.php?c=organisation&t=organisationList');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $organisations = $em->find('Organisation', $id);

        echo $this->twig->render('organisation/edit.html', ['organisations' => $organisations]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $organisation = $em->find('Organisation', $id);

        $organisation->setName($params['post']['name']);
        $organisation->setCountry($params['post']['country']);
        $organisation->setFounder($params['post']['founder']);
        $organisation->setRoster($params['post']['roster']);
        $organisation->setLogo($params['post']['logo']);


        $em->flush();

        header('Location: start.php?c=organisation&t=organisationList');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $organisation=$em->find('Organisation',$id);

        $em->remove($organisation);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=organisation&t=organisationList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }
}
