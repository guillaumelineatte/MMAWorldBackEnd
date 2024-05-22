<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use User;
use Doctrine\ORM\Query\ResultSetMapping;

class UserController extends Controller {

    public function signin()
    {
        header('Location: start.php?c=user&t=create');
    }

    public function login() {

        echo $this->twig->render('login.html');
    }

    public function checkLogin($params) {
        $em = $params['em'];
        $name = ($_POST['name']);
        $password = ($_POST['password']);

        $qb=$em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
            ->where('u.name = :name1')
            ->andWhere('u.password = :password')
            ->setParameter('name1', $name)
            ->setParameter('password', $password);

        //echo $qb->getQuery()->getSQL();die;
        $query = $qb->getQuery();
        $user = $query->getOneOrNullResult();

        if ($user) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_password'] = $user->getPassword();

            header('Location: start.php?c=user&t=admindisplay');
        } else {
            echo $this->twig->render('login.html',['error' => 'Identifiants invalides']);
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: start.php?c=user&t=login');
        exit();
    }

        public function showUser($params)
        {
            $entityManager = $params["em"];
            $connectUser = "Un seul";

            $user = new User();

            //$user -> setNom("LINEATTE");

            //$user -> setPrenom("Guillaume");

            $user -> setAvatar($user);
            //var_dump($user);die;
            $entityManager -> persist($user);

            $entityManager -> flush();

            echo $this->twig->render('user/user.html', ['connectUser' => $connectUser, 'params' => $params]);
        }

        public function userList($params) {
            if ($this->isLoggedIn()) {
                $entityManager = $params["em"];
                $userRepository = $entityManager->getRepository('User');
                $users = $userRepository->findAll();


                    echo $this->twig->render('user/userList.html', ['users' => $users, 'params' => $params]);
            } else {
                header('Location: start.php?c=user&t=login');
                exit();
            }
        }

        public function create()
    {
        echo $this->twig->render('user/create.html');
    }

    public function insert($params) {

            $em = $params['em'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $age = $_POST['age'];
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
            $password = $_POST['password'];

            $newUser = new User();

            $newUser->setName($name);
            $newUser->setSurname($surname);
            $newUser->setAge($age);
            $newUser->setAvatar($avatar);
            $newUser->setPassword($password);

            $em->persist($newUser);
            $em->flush();

            header('Location: start.php?c=user&t=login');
        }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $users = $em->find('User', $id);

        echo $this->twig->render('user/edit.html', ['users' => $users]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $user = $em->find('User', $id);

        $user->setName($params['post']['name']);
        $user->setSurname($params['post']['surname']);
        $user->setAge($params['post']['age']);

        $em->flush();

        header('Location: start.php?c=user&t=login');
    }

    public function delete($params) {
        $id=($params['get']['id']);
        $em=$params['em'];
        $user=$em->find('User',$id);

        $em->remove($user);
        $em->flush();

        if ($this->isLoggedIn()) {
            header('Location: start.php?c=user&t=userList');
        } else {
            header('Location: start.php?c=user&t=login');
        }
    }

    public function admindisplay($params) {

        if ($this->isLoggedIn()) {
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];

            echo $this->twig->render('base.html', ['user_id' => $user_id,'user_name' => $user_name]);

        } else {
            header('Location: start.php?c=user&t=login');
        }
    }
}
