<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ViewFactory;
use App\Service\TokenService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\View\ViewHandlerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TokenController extends AbstractFOSRestController
{
    /** @var ViewHandlerInterface $viewHandler */
    private $viewHandler;

    /** @var ViewFactory $view */
    private $view;

    /** @var TokenService $tokenService */
    private $tokenService;

    /** @var LoggerInterface $logger */
    private $logger;

    /**
     * @param ViewHandlerInterface $viewHandler
     * @param ViewFactory $view
     * @param TokenService $tokenService
     * @param LoggerInterface $logger
     */
    public function __construct(
        ViewHandlerInterface $viewHandler,
        ViewFactory $view,
        TokenService $tokenService,
        LoggerInterface $logger
    ) {
        $this->viewHandler = $viewHandler;
        $this->view = $view;
        $this->tokenService = $tokenService;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @Post("/token/access", name="access_token")
     * @return Response
     */
    public function accessTokenAction(Request $request)
    {
        $refreshToken = $request->request->get('refresh_token');
        try {
            $tokenDto = $this->tokenService->getAccessTokenFromRefreshToken($refreshToken);
            $view = $this->view->ok($tokenDto);
        } catch (Throwable $e) {
            $this->logger->critical($e->getMessage(), $e->getTrace());
            $view = $this->view->badRequest();
        }
        return $this->viewHandler->handle($view);
    }
}
