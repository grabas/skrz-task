<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ViewFactory;
use App\Service\ResortService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResortController extends AbstractFOSRestController
{
    /** @var ResortService  */
    public $resortService;

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ViewFactory */
    private $view;

    /**
     * @param ResortService $resortService
     * @param ViewHandlerInterface $viewHandler
     * @param ViewFactory $view
     */
    public function __construct(
        ResortService $resortService,
        ViewHandlerInterface $viewHandler,
        ViewFactory $view
    ) {
        $this->resortService = $resortService;
        $this->view = $view;
        $this->viewHandler = $viewHandler;
    }

    /**
     * @Get("/resort/{id}", name="api-resort-detail")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function detailAction(Request $request, int $id): Response
    {
        $transaction = $this->resortService->getForApi($id);
        $view = $this->view->ok($transaction);
        return $this->viewHandler->handle($view);
    }
}
