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
        $error_msg = []; // créer un tableau error
        $cat = $_POST["dog"]["cat"]; // permet de récuperer ce qu'il y a dans l'input dog_cat
        $filtered_cat_name = filter_var($cat, FILTER_SANITIZE_STRING);
        $monkey = $_POST["dog"]["monkey"]; // permet de récuperer ce qu'il y a dans l'input dog_monkey
        $filtered_monkey_name = filter_var($monkey, FILTER_SANITIZE_STRING);

        $repository = $this->getDoctrine()
            ->getRepository(Dog::class);

        $dog_cat = $repository->findOneBy(array('cat' => $filtered_cat_name)); // on va cherche dans le repository tout les noms qui sont
        // comme $cat
        $dog_monkey = $repository->findOneBy(array('monkey' => $filtered_monkey_name)); // on va cherche dans le repository
        // tout les noms qui sont comme $monkey

        if (!empty($dog_cat)) {
            array_push($error_msg, 'Le nom inscrit dans cat existe déjà'."<br>");
            // permet de mettre dans le tableau error_msg une valeur
        }
        if (!empty($dog_monkey)) {
            array_push($error_msg, 'Le nom inscrit dans monkey existe déjà');
        }
        if (!empty($error_msg)) {
            $response = [
                'msg' => $error_msg,
                'error' => true
            ];
            return new JsonResponse($response);
        }
        else {
            return new JsonResponse(false);
        }
    }

}
