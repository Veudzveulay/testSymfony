<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax", methods = {"POST"} )
     */

      public function index() : JsonResponse {
          $cat = $_POST["dog"]["cat"];
         // $name = $_POST["username"];
          var_dump($cat);
          return new JsonResponse($cat, 200);
    }


}
