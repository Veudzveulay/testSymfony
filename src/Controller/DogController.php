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
            $error = 0;

            if ($cat === "" && $monkey === "") {
                echo "erreur" . "<br>";
                $error++;
            }
            if (preg_match("/^([a-zA-Z' ]+)$/", $cat)) {

            } else {
                $error++;
            }
            if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $monkey)) {

            } else {
                $error++;
            }
            if ($filtered_monkey = filter_var($monkey, FILTER_VALIDATE_EMAIL)) {

            } else {
                $error++;
            }
            if ($filtered_cat = filter_var($cat, FILTER_SANITIZE_STRING)) {

            } else {
                $error++;
            }
            $repository = $this->getDoctrine()
                ->getRepository(Dog::class);

            $dog_cat = $repository->findOneBy(array('cat' => $filtered_cat)); // on va cherche dans le repository tout les noms qui sont
            $dog_monkey = $repository->findOneBy(array('monkey' => $filtered_monkey));

            if (empty($dog_cat) && empty($dog_monkey)) {

            } else {
                $error++;
            }
            if ($error > 0) {
                echo "Je dois faire TWIG en affichage";
            } else {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($dog);
                $entityManager->flush();
                return $this->redirectToRoute('dog_index');
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
    public
    function show(Dog $dog): Response
    {
        return $this->render('dog/show.html.twig', [
            'dog' => $dog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dog_edit", methods={"GET","POST"})
     */
    public
    function edit(Request $request, Dog $dog): Response
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
    public
    function delete(Request $request, Dog $dog): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dog_index');
    }

}
