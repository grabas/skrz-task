<?php
declare(strict_types=1);

namespace App\Factory;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ViewFactory
{
    /**
     * @param mixed $data
     * @return View
     */
    public function ok($data = null): View
    {
        return $this->createView(Response::HTTP_OK, $data);
    }

    /**
     * @param mixed $data
     * @return View
     */
    public function created($data = null): View
    {
        return $this->createView(Response::HTTP_CREATED, $data);
    }

    /**
     * @param mixed $data
     * @return View
     */
    public function badRequest($data = null): View
    {
        return $this->createView(Response::HTTP_BAD_REQUEST, $data);
    }

    /**
     * @param mixed $data
     * @return View
     */
    public function forbidden($data = null): View
    {
        return $this->createView(Response::HTTP_FORBIDDEN, $data);
    }

    /**
     * @param mixed $data
     * @return View
     */
    public function notFound($data = null): View
    {
        return $this->createView(Response::HTTP_NOT_FOUND, $data);
    }

    /**
     * @param mixed $data
     * @return View
     */
    public function serverError($data = null): View
    {
        return $this->createView(Response::HTTP_INTERNAL_SERVER_ERROR, $data);
    }

    /**
     * @param int $code
     * @param mixed $jsonData
     * @return View
     */
    private function createView(int $code, $jsonData = null): View
    {
        $headers = ['Access-Control-Allow-Origin' => '*'];

        $data = [];

        if ($jsonData !== null) {
            $data = $jsonData;
        }

        return View::create($data, $code, $headers);
    }
}
