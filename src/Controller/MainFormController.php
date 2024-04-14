<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
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

    private $logger;

    public function __construct(
        ApiService $apiService,
        ResturantRepository $resturantRepository,
        CategoryToResturantRepository $categoryToResturantRepository,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
        )
    {
        $this->apiService = $apiService;
        $this->resturantRepository = $resturantRepository;
        $this->categoryToResturantRepository = $categoryToResturantRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    #[Route('/save_choices', name: 'save_choices')]
    public function saveChoices(Request $request): Response
    {
        try {

            if ($request->isMethod('POST')) {
                $selectedResturantNames = $request->request->get('selectedResturantIds');
                
                if (empty($selectedResturantNames)) {
                    $this->logger->error('selectedResturantNames can not be empty!');
    
                    return $this->redirectToRoute('app_error');
                }

                $selectedResturant = new SelectedResturant();

                $selectedResturant->setTimestamp(new \DateTime());

                $selectedResturant->setResturant($selectedResturantNames);

                // Persist the entity
                $this->entityManager->persist($selectedResturant);

                // Flush changes to the database
                $this->entityManager->flush();
            }

            return $this->redirectToRoute('app_main');
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());

            return $this->redirectToRoute('app_error');
        }
    }
    
    #[Route('/get-resturant', name: 'get_resturant')]
    public function getResturant(Request $request): Response
    {
        try {

            $data = $this->apiService->fetchData();
            
            if (empty($data)) {
                $this->logger->error('Temperature can not be empty!');

                return $this->redirectToRoute('app_error');
            }

            if ($request->isMethod('POST')) {
                $selectedCategoryIds = $request->request->get('selectedCategoryIds');
                
                if (empty($selectedCategoryIds)) {
                    $this->logger->error('selectedCategoryIds can not be empty!');
    
                    return $this->redirectToRoute('app_error');
                }
                $selectedCategoryIdsArray = explode(',', $selectedCategoryIds);

                $resturantIds = $this->categoryToResturantRepository->findResturantIdsByCategoryIds($selectedCategoryIdsArray);
                if (empty($resturantIds)) {
                    $this->logger->error('resturantIds can not be empty!');
    
                    return $this->redirectToRoute('app_error');
                }

                $resturants = $this->resturantRepository->findByResturantIds($resturantIds);
                if (empty($resturants)) {
                    $this->logger->error('resturants can not be empty!');
    
                    return $this->redirectToRoute('app_error');
                }
                return $this->render('main/choices.html.twig', [
                    'controller_name' => 'MainFormController',
                    'temp' => $data['main']['temp'],
                    'resturants' => $resturants
                ]);
            }

            return $this->render('main/choices.html.twig');
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());

            return $this->redirectToRoute('app_error');
        }
    }
}
