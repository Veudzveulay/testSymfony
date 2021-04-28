<?php

namespace App\Controller;

use ContainerXToRHs0\getAjaxControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use public/ajax;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax" methods = {"POST"})
     */
    public function index(ajax)
    {
        return 'test ajax';

    }
}
