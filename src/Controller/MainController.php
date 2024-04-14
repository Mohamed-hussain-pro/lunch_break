<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Service\ApiService;
use App\Repository\ResturantRepository;
use App\Repository\CategoryRepository;
use App\Repository\SelectedResturantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MainController extends AbstractController
{
    private $apiService;
    
    private $resturantRepository;

    private $categoryRepository;

    private $selectedResturantRepository;

    private $logger;

    public function __construct(
        ApiService $apiService, 
        ResturantRepository $resturantRepository, 
        CategoryRepository $categoryRepository,
        SelectedResturantRepository $selectedResturantRepository,
        LoggerInterface $logger
        )
    {
        $this->apiService = $apiService;
        $this->resturantRepository = $resturantRepository;
        $this->categoryRepository = $categoryRepository;
        $this->selectedResturantRepository = $selectedResturantRepository;
        $this->logger = $logger;
    }

    #[Route('/', name: 'app_main')]
    public function index(ParameterBagInterface $parameterBag): Response
        {
            try {

            $data = $this->apiService->fetchData();

            $categories = $this->categoryRepository->findAll();

            if (empty($categories)) {
                $this->logger->error('categories can not be empty!');

                return $this->redirectToRoute('app_error');
            }

            return $this->render('main/index.html.twig', [
                'controller_name' => 'MainController',
                'temp' => $data['main']['temp'],
                'categories' => $categories
                //"resturants" => $resturants
            ]);

        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());

            return $this->redirectToRoute('app_error');
        }
    }

    #[Route('/selected-choices-list', name: 'selected_choices_list')]
    public function showSelectedChoices(): Response
    {
        try {

            $data = $this->apiService->fetchData();

            $selectedChoices = $this->selectedResturantRepository->findAll();
            
            if (empty($selectedChoices)) {
                $this->logger->error('selectedChoices can not be empty!');

                return $this->redirectToRoute('app_error');
            }

            return $this->render('main/selected_choices_list.html.twig', 
            ['temp' => $data['main']['temp'],
            'selectedChoices' => $selectedChoices]
            );
            
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());

            return $this->redirectToRoute('app_error');
        }
    }
}
