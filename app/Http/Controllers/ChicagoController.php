<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Repository\ChicagoRepository;
use Illuminate\Http\JsonResponse;

class ChicagoController extends Controller
{

    /**
     * @var ChicagoRepository
     */
    private $repository;

    function __construct() {
        $this->repository = new ChicagoRepository();
    }

    /**
     * @return JsonResponse
     */
    public function getViolentCrimeCount(): JsonResponse
    {
        return response()->json($this->repository->getCrimeCategoryCount($this->repository::violentCategories));
    }

    /**
     * @return JsonResponse
     */
    public function getConsensualCrimeCount(): JsonResponse
    {
        return response()->json($this->repository->getCrimeCategoryCount($this->repository::consensualCategories));
    }

    /**
     * @return JsonResponse
     */
    public function getPropertyCrimeCount(): JsonResponse
    {
        return response()->json($this->repository->getCrimeCategoryCount($this->repository::propertyCategories));
    }

    /**
     * @return JsonResponse
     */
    public function getOrganisedCrimeCount(): JsonResponse
    {
        return response()->json($this->repository->getCrimeCategoryCount($this->repository::organisedCategories));
    }

    /**
     * @return JsonResponse
     */
    public function getDistrictRates(): JsonResponse
    {
        return response()->json($this->repository->getDistrictRates());
    }
}