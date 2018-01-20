<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAcidAPIRequest;
use App\Http\Requests\API\UpdateAcidAPIRequest;
use App\Models\Acid;
use App\Repositories\AcidRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AcidController
 * @package App\Http\Controllers\API
 */

class AcidAPIController extends AppBaseController
{
    /** @var  AcidRepository */
    private $acidRepository;

    public function __construct(AcidRepository $acidRepo)
    {
        $this->acidRepository = $acidRepo;
    }

    /**
     * Display a listing of the Acid.
     * GET|HEAD /acids
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->acidRepository->pushCriteria(new RequestCriteria($request));
        $this->acidRepository->pushCriteria(new LimitOffsetCriteria($request));
        $acids = $this->acidRepository->all();

        return $this->sendResponse($acids->toArray(), 'Acids retrieved successfully');
    }

    /**
     * Store a newly created Acid in storage.
     * POST /acids
     *
     * @param CreateAcidAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAcidAPIRequest $request)
    {
        $input = $request->all();

        $acids = $this->acidRepository->create($input);

        return $this->sendResponse($acids->toArray(), 'Acid saved successfully');
    }

    /**
     * Display the specified Acid.
     * GET|HEAD /acids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Acid $acid */
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            return $this->sendError('Acid not found');
        }

        return $this->sendResponse($acid->toArray(), 'Acid retrieved successfully');
    }

    /**
     * Update the specified Acid in storage.
     * PUT/PATCH /acids/{id}
     *
     * @param  int $id
     * @param UpdateAcidAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAcidAPIRequest $request)
    {
        $input = $request->all();

        /** @var Acid $acid */
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            return $this->sendError('Acid not found');
        }

        $acid = $this->acidRepository->update($input, $id);

        return $this->sendResponse($acid->toArray(), 'Acid updated successfully');
    }

    /**
     * Remove the specified Acid from storage.
     * DELETE /acids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Acid $acid */
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            return $this->sendError('Acid not found');
        }

        $acid->delete();

        return $this->sendResponse($id, 'Acid deleted successfully');
    }
}
