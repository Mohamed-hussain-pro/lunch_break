<?php

namespace App\Controller;

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


    public function __construct(
        ApiService $apiService, 
        ResturantRepository $resturantRepository, 
        CategoryRepository $categoryRepository,
        SelectedResturantRepository $selectedResturantRepository
        )
    {
        $this->apiService = $apiService;
        $this->resturantRepository = $resturantRepository;
        $this->categoryRepository = $categoryRepository;
        $this->selectedResturantRepository = $selectedResturantRepository;
    }

    #[Route('/', name: 'app_main')]
    public function index(ParameterBagInterface $parameterBag): Response
    {

        $data = $this->apiService->fetchData();
        //$resturants = $this->resturantRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'temp' => $data['main']['temp'],
            'categories' => $categories
            //"resturants" => $resturants
        ]);
    }

    #[Route('/selected-choices-list', name: 'selected_choices_list')]
    public function showSelectedChoices(): Response
    {
        $data = $this->apiService->fetchData();

        $selectedChoices = $this->selectedResturantRepository->findAll();
        return $this->render('main/selected_choices_list.html.twig', 
        ['temp' => $data['main']['temp'],
        'selectedChoices' => $selectedChoices]
    );
    }
}
