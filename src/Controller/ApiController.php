<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ApiClientEnrich;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(Request $request, ApiClientEnrich $clientEnrich): Response
    {
        $result = null;

        if ($request->isMethod('POST')) {

            $query = $request->request->get('query');
            $action = $request->request->get('action');

            if ($action === 'company') {
                $result = $clientEnrich->searchCompanies($query);
            }

            if ($action === 'people') {
                $result = $clientEnrich->searchPeopleByDomain([$query]);
            }
        }

        return $this->render('api/index.html.twig', [
            'result' => $result,
        ]);
    }
}
