<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Repositories\DataRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DataController extends AppBaseController
{
    /** @var  DataRepository */
    private $dataRepository;

    public function __construct(DataRepository $dataRepo)
    {
        $this->dataRepository = $dataRepo;
    }

    /**
     * Display a listing of the Data.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dataRepository->pushCriteria(new RequestCriteria($request));
        $data = $this->dataRepository->all();

        return view('data.index')
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new Data.
     *
     * @return Response
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created Data in storage.
     *
     * @param CreateDataRequest $request
     *
     * @return Response
     */
    public function store(CreateDataRequest $request)
    {
        $input = $request->all();

        $data = $this->dataRepository->create($input);

        Flash::success('Data saved successfully.');

        return redirect(route('data.index'));
    }

    /**
     * Display the specified Data.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        return view('data.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified Data.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        return view('data.edit')->with('data', $data);
    }

    /**
     * Update the specified Data in storage.
     *
     * @param  int              $id
     * @param UpdateDataRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDataRequest $request)
    {
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        $data = $this->dataRepository->update($request->all(), $id);

        Flash::success('Data updated successfully.');

        return redirect(route('data.index'));
    }

    /**
     * Remove the specified Data from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->dataRepository->findWithoutFail($id);

        if (empty($data)) {
            Flash::error('Data not found');

            return redirect(route('data.index'));
        }

        $this->dataRepository->delete($id);

        Flash::success('Data deleted successfully.');

        return redirect(route('data.index'));
    }
}
