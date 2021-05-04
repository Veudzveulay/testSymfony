<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogType;
use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;


/**
 * @Route("/dog")
 */
class DogController extends AbstractController
{
    /**
     * @Route("/", name="dog_index", methods={"GET"})
     */
    public function index(DogRepository $dogRepository): Response
    {
        return $this->render('dog/index.html.twig', [
            'dogs' => $dogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dog_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dog = new Dog();
        $form = $this->createForm(DogType::class, $dog);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $_POST["dog"]["cat"];
            $monkey = $_POST["dog"]["monkey"];

            if ($cat === "" && $monkey === "") {
                echo "erreur" . "<br>";
            }
            if (preg_match("/^([a-zA-Z' ]+)$/", $cat)) {
                echo "good1" . "<br>";
                $regex_cat = 1;
            }
            if (preg_match("/^([a-zA-Z' ]+)$/", $monkey)) {
                echo "good2" . "<br>";
                $regex_monkey = 1;
            }
            if (filter_var($monkey, FILTER_VALIDATE_EMAIL)) {
                echo "good3" . "<br>";
                $filtered_monkey = 1;
            }
            if (filter_var($cat, FILTER_SANITIZE_STRING)) {
                echo "good4" . "<br>";
                $filtered_cat = 1;
            }
            if ($filtered_monkey === 1 && $filtered_cat === 1 && $regex_monkey === 1 && $regex_cat === 1) {
                $repository = $this->getDoctrine()
                    ->getRepository(Dog::class);

                $dog_cat = $repository->findOneBy(array('cat' => $cat)); // on va cherche dans le repository tout les noms qui sont
                $dog_monkey = $repository->findOneBy(array('monkey' => $monkey));

                if (empty($dog_cat) && empty($dog_monkey)) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($dog);
                    $entityManager->flush();
                    return $this->redirectToRoute('dog_index');
                }
            } else {
                echo "";
            }
        }
        return $this->render('dog/new.html.twig', [
            'dog' => $dog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dog_show", methods={"GET"})
     */
    public function show(Dog $dog): Response
    {
        return $this->render('dog/show.html.twig', [
            'dog' => $dog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dog $dog): Response
    {
        $form = $this->createForm(DogType::class, $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dog_index');
        }

        return $this->render('dog/edit.html.twig', [
            'dog' => $dog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dog_delete", methods={"POST"})
     */
    public function delete(Request $request, Dog $dog): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dog_index');
    }

}
