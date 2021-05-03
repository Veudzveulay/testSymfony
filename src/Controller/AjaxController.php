<?php

namespace App\Controller;

use App\Entity\Dog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax", methods = {"POST"} )
     */

    public function index(): JsonResponse
    {
        $cat = $_POST["dog"]["cat"]; // permet de récuperer ce qu'il y a dans l'input dog_cat
        $filtered_cat_name = filter_var($cat, FILTER_SANITIZE_STRING);
        $monkey = $_POST["dog"]["monkey"]; // permet de récuperer ce qu'il y a dans l'input dog_monkey
        $filtered_monkey_name = filter_var($monkey, FILTER_SANITIZE_STRING);

        $repository = $this->getDoctrine()
            ->getRepository(Dog::class);

        $dog_cat = $repository->findOneBy(array('cat' => $filtered_cat_name)); // on va cherche dans le repository tout les noms qui sont comme $cat
        $dog_monkey = $repository->findOneBy(array('monkey' => $filtered_monkey_name)); // on va cherche dans le repository
        // tout les noms qui sont comme $monkey

        $error_msg = [];

        if (!empty($dog_cat)) {
            array_push($error_msg, 'Cat exists');
        }
        if (!empty($dog_monkey)) {
            array_push($error_msg, 'Monkey exists.');
        }
        if (!empty($error_msg)) {
            $response = [
                'error' => true,
                'msg' => $error_msg
            ];
            return new JsonResponse($response);
        }

        if (empty($dog_cat)) {
            return new JsonResponse(false);
        } else {
            return new JsonResponse(true);
        }
    }

}
