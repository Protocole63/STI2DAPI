<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHeatRequest;
use App\Http\Requests\UpdateHeatRequest;
use App\Repositories\HeatRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HeatController extends AppBaseController
{
    /** @var  HeatRepository */
    private $heatRepository;

    public function __construct(HeatRepository $heatRepo)
    {
        $this->heatRepository = $heatRepo;
    }

    /**
     * Display a listing of the Heat.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->heatRepository->pushCriteria(new RequestCriteria($request));
        $heats = $this->heatRepository->all();

        return view('heats.index')
            ->with('heats', $heats);
    }

    /**
     * Show the form for creating a new Heat.
     *
     * @return Response
     */
    public function create()
    {
        return view('heats.create');
    }

    /**
     * Store a newly created Heat in storage.
     *
     * @param CreateHeatRequest $request
     *
     * @return Response
     */
    public function store(CreateHeatRequest $request)
    {
        $input = $request->all();

        $heat = $this->heatRepository->create($input);

        Flash::success('Heat saved successfully.');

        return redirect(route('heats.index'));
    }

    /**
     * Display the specified Heat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            Flash::error('Heat not found');

            return redirect(route('heats.index'));
        }

        return view('heats.show')->with('heat', $heat);
    }

    /**
     * Show the form for editing the specified Heat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            Flash::error('Heat not found');

            return redirect(route('heats.index'));
        }

        return view('heats.edit')->with('heat', $heat);
    }

    /**
     * Update the specified Heat in storage.
     *
     * @param  int              $id
     * @param UpdateHeatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHeatRequest $request)
    {
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            Flash::error('Heat not found');

            return redirect(route('heats.index'));
        }

        $heat = $this->heatRepository->update($request->all(), $id);

        Flash::success('Heat updated successfully.');

        return redirect(route('heats.index'));
    }

    /**
     * Remove the specified Heat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $heat = $this->heatRepository->findWithoutFail($id);

        if (empty($heat)) {
            Flash::error('Heat not found');

            return redirect(route('heats.index'));
        }

        $this->heatRepository->delete($id);

        Flash::success('Heat deleted successfully.');

        return redirect(route('heats.index'));
    }
}
