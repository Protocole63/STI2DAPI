<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHeatAPIRequest;
use App\Http\Requests\API\UpdateHeatAPIRequest;
use App\Models\Heat;
use App\Repositories\HeatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HeatController
 * @package App\Http\Controllers\API
 */

class HeatAPIController extends AppBaseController
{
    /** @var  HeatRepository */
    private $heatRepository;

    public function __construct(HeatRepository $heatRepo)
    {
        $this->heatRepository = $heatRepo;
    }

    /**
     * Display a listing of the Heat.
     * GET|HEAD /heats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->heatRepository->pushCriteria(new RequestCriteria($request));
        $this->heatRepository->pushCriteria(new LimitOffsetCriteria($request));
        $heats = $this->heatRepository->all();

        return $this->sendResponse($heats->toArray(), 'Heats retrieved successfully');
    }

    /**
     * Store a newly created Heat in storage.
     * POST /heats
     *
     * @param CreateHeatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHeatAPIRequest $request)
    {
        $input = $request->all();

        $heats = $this->heatRepository->create($input);

        return $this->sendResponse($heats->toArray(), 'Heat saved successfully');
    }

    /**
     * Display the specified Heat.
     * GET|HEAD /heats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Heat $heat */
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            return $this->sendError('Heat not found');
        }

        return $this->sendResponse($heat->toArray(), 'Heat retrieved successfully');
    }

    /**
     * Update the specified Heat in storage.
     * PUT/PATCH /heats/{id}
     *
     * @param  int $id
     * @param UpdateHeatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHeatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Heat $heat */
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            return $this->sendError('Heat not found');
        }

        $heat = $this->heatRepository->update($input, $id);

        return $this->sendResponse($heat->toArray(), 'Heat updated successfully');
    }

    /**
     * Remove the specified Heat from storage.
     * DELETE /heats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Heat $heat */
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            return $this->sendError('Heat not found');
        }

        $heat->delete();

        return $this->sendResponse($id, 'Heat deleted successfully');
    }
}
