<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDataAPIRequest;
use App\Http\Requests\API\UpdateDataAPIRequest;
use App\Models\Data;
use App\Repositories\DataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DataController
 * @package App\Http\Controllers\API
 */

class DataAPIController extends AppBaseController
{
    /** @var  DataRepository */
    private $dataRepository;

    public function __construct(DataRepository $dataRepo)
    {
        $this->dataRepository = $dataRepo;
    }

    /**
     * Display a listing of the Data.
     * GET|HEAD /data
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dataRepository->pushCriteria(new RequestCriteria($request));
        $this->dataRepository->pushCriteria(new LimitOffsetCriteria($request));
        $data = $this->dataRepository->all();

        return $this->sendResponse($data->toArray(), 'Data retrieved successfully');
    }

    /**
     * Store a newly created Data in storage.
     * POST /data
     *
     * @param CreateDataAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDataAPIRequest $request)
    {
        $input = $request->all();

        $data = $this->dataRepository->create($input);

        return $this->sendResponse($data->toArray(), 'Data saved successfully');
    }

    /**
     * Display the specified Data.
     * GET|HEAD /data/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Data $data */
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            return $this->sendError('Data not found');
        }

        return $this->sendResponse($data->toArray(), 'Data retrieved successfully');
    }

    /**
     * Update the specified Data in storage.
     * PUT/PATCH /data/{id}
     *
     * @param  int $id
     * @param UpdateDataAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDataAPIRequest $request)
    {
        $input = $request->all();

        /** @var Data $data */
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            return $this->sendError('Data not found');
        }

        $data = $this->dataRepository->update($input, $id);

        return $this->sendResponse($data->toArray(), 'Data updated successfully');
    }

    /**
     * Remove the specified Data from storage.
     * DELETE /data/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Data $data */
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            return $this->sendError('Data not found');
        }

        $data->delete();

        return $this->sendResponse($id, 'Data deleted successfully');
    }

    public function GetData($data_id)
    {
        $Data = Data::where('id', '=', $data_id)->with('heat', 'acid', 'food')->get();

        if (empty($Data)) {
            return $this->sendError('data not found');
        }

        return $this->sendResponse($Data->toArray(), 'Get Data based on DataId');
    }

}
