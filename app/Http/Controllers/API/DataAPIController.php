<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDataAPIRequest;
use App\Http\Requests\API\UpdateDataAPIRequest;
use App\Models\Data;
use App\Models\Heat;
use App\Models\Acid;
use App\Models\Food;
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

        $data = Data::with('heat', 'acid', 'food')->orderby('id', 'DESC')->get();

        return $this->sendResponse($data->toArray(), 'Data retrieved successfullys');
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


    public function getDatas($howmany, Request $request)
    {

        $data = Data::with('heat', 'acid', 'food')->orderBy('id', 'DESC')->limit($howmany)->get();
        return $this->sendResponse($data->toArray(), 'Data retrieved successfullys');
    }

    public function NewData(Request $request){
        $heat = $request->input('heat');
        $acid = $request->input('acid');
        $food = $request->input('food');
        if(empty($heat) || empty($acid) || empty($food)) return $this->sendError('Un probleme est survenu au niveau des donnees (Heat, Acid, Food)');

        if(!$data = $this->dataRepository->create([])) return $this->sendError('Un probleme est survenu !');
        if(!Heat::insert(
                                    ['data_id' => $data->id, 'level' => $heat]
        )) return $this->sendError('Un probleme est survenu au niveau de la temperature');
        if(!Acid::insert(
                                    ['data_id' => $data->id, 'level' => $acid]
        )) return $this->sendError('Un probleme est survenu au niveau de la l\'acidite! ');
        if(!Food::insert(
                                     ['data_id' => $data->id, 'level' => $food]
        )) return $this->sendError('Un probleme est survenu au niveau de la nourriture');
        return $this->sendResponse($data->toArray(), 'Data put succesfully');


        

    }

}
