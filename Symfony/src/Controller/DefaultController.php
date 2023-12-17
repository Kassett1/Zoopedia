<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\HabitatRepository;
use App\Repository\RegimeAlimentaireRepository;
use App\Repository\AnimalRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AnimalType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Finder\Finder;


class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/ajouter/animal', name: 'app_add_animal')]
    public function ajoutAnimal(Request $request, AnimalRepository $ar, SessionInterface $session, CategorieRepository $cr, HabitatRepository $hr, RegimeAlimentaireRepository $rr) {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $animal->setImage($newFilename);
            }

            $animalExistant = $ar->findOneBy(['nom' => $animal->getNom()]);
            if ($animalExistant !== null) {
                // L'animal existe déjà dans la base de données
                $session->getFlashBag()->add('error', 'Cet animal existe déjà');
                return $this->redirectToRoute('app_default');
            }

            //ajout de l'animal à la base de données
            $ar->save($animal, true);
            $session->getFlashBag()->add('success', 'Animal ajouté avec succès');

            //ajout l'animal à sa catégorie
            if ($animal->getCategorie()!=null){
                $categorie = $animal->getCategorie();
                $categorie->addAnimal($animal);
                $cr->save($categorie, true);
            }

            //ajout l'animal à son habitat
            if ($animal->getHabitat()!=null){
                $habitat = $animal->getHabitat();
                $habitat->addAnimal($animal);
                $hr->save($habitat, true);
            }

            //ajout l'animal à son régime
            if ($animal->getRegime()!=null){
                $regime = $animal->getRegime();
                $regime->addAnimal($animal);
                $rr->save($regime, true);
            }

            return $this->redirectToRoute('app_default');
        }

        return $this->render('default/ajouterAnimal.html.twig', [
            'form_animal' => $form
        ]);
    }

    #[Route('/{nom}', name: 'app_animal')]
    public function animal(AnimalRepository $ar, String $nom): Response {

        $animal = $ar->findOneBy(array('nom'=>$nom));

        return $this->render('default/infosAnimal.html.twig',
            ['animal' => $animal,
                ]);
    }

    /**
     * @Route("/api/images", name="api_images", methods={"GET"})
     */
    public function getImages(): Response
    {
        $imageDir = $this->getParameter('kernel.project_dir') . '/public/images';

        $finder = new Finder();
        $finder->files()->in($imageDir);

        $images = [];

        foreach ($finder as $file) {
            $images[] = [
                'name' => $file->getFilename(),
                'data' => base64_encode(file_get_contents($file->getRealPath())),
            ];
        }

        return $this->json(['images' => $images]);
    }



}
