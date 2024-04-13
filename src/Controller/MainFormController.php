<?php

namespace App\Controller;

use App\Service\ApiService;
use App\Entity\SelectedResturant;
use App\Repository\ResturantRepository;
use App\Repository\CategoryToResturantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MainFormController extends AbstractController
{
    private $apiService;

    private $resturantRepository;

    private $categoryToResturantRepository;

    private $entityManager;

    public function __construct(
        ApiService $apiService,
        ResturantRepository $resturantRepository,
        CategoryToResturantRepository $categoryToResturantRepository,
        EntityManagerInterface $entityManager
        )
    {
        $this->apiService = $apiService;
        $this->resturantRepository = $resturantRepository;
        $this->categoryToResturantRepository = $categoryToResturantRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/save_choices', name: 'save_choices')]
    public function saveChoices(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $selectedResturantIds = $request->request->get('selectedResturantIds');
            //$selectedResturantIdsArray = explode(',', $selectedResturantIds);

            $selectedResturant = new SelectedResturant();

            $selectedResturant->setTimestamp(new \DateTime());

            $selectedResturant->setResturant($selectedResturantIds);

            // Persist the entity
            $this->entityManager->persist($selectedResturant);

            // Flush changes to the database
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_main');
    }
    
    #[Route('/get-resturant', name: 'get_resturant')]
    public function getResturant(Request $request): Response
    {
        $data = $this->apiService->fetchData();

        if ($request->isMethod('POST')) {
            $selectedCategoryIds = $request->request->get('selectedCategoryIds');
            $selectedCategoryIdsArray = explode(',', $selectedCategoryIds);
            //dd($selectedCategoryIdsArray);

            $resturantIds = $this->categoryToResturantRepository->findResturantIdsByCategoryIds($selectedCategoryIdsArray);
            //dd($resturantIds);

            $resturants = $this->resturantRepository->findByResturantIds($resturantIds);
            //dd($resturants);


            return $this->render('main/choices.html.twig', [
                'controller_name' => 'MainFormController',
                'temp' => $data['main']['temp'],
                'resturants' => $resturants
            ]);
        }

        return $this->render('main/choices.html.twig');
    }



}
