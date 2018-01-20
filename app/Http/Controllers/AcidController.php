<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAcidRequest;
use App\Http\Requests\UpdateAcidRequest;
use App\Repositories\AcidRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AcidController extends AppBaseController
{
    /** @var  AcidRepository */
    private $acidRepository;

    public function __construct(AcidRepository $acidRepo)
    {
        $this->acidRepository = $acidRepo;
    }

    /**
     * Display a listing of the Acid.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->acidRepository->pushCriteria(new RequestCriteria($request));
        $acids = $this->acidRepository->all();

        return view('acids.index')
            ->with('acids', $acids);
    }

    /**
     * Show the form for creating a new Acid.
     *
     * @return Response
     */
    public function create()
    {
        return view('acids.create');
    }

    /**
     * Store a newly created Acid in storage.
     *
     * @param CreateAcidRequest $request
     *
     * @return Response
     */
    public function store(CreateAcidRequest $request)
    {
        $input = $request->all();

        $acid = $this->acidRepository->create($input);

        Flash::success('Acid saved successfully.');

        return redirect(route('acids.index'));
    }

    /**
     * Display the specified Acid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            Flash::error('Acid not found');

            return redirect(route('acids.index'));
        }

        return view('acids.show')->with('acid', $acid);
    }

    /**
     * Show the form for editing the specified Acid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            Flash::error('Acid not found');

            return redirect(route('acids.index'));
        }

        return view('acids.edit')->with('acid', $acid);
    }

    /**
     * Update the specified Acid in storage.
     *
     * @param  int              $id
     * @param UpdateAcidRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAcidRequest $request)
    {
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            Flash::error('Acid not found');

            return redirect(route('acids.index'));
        }

        $acid = $this->acidRepository->update($request->all(), $id);

        Flash::success('Acid updated successfully.');

        return redirect(route('acids.index'));
    }

    /**
     * Remove the specified Acid from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $acid = $this->acidRepository->findWithoutFail($id);

        if (empty($acid)) {
            Flash::error('Acid not found');

            return redirect(route('acids.index'));
        }

        $this->acidRepository->delete($id);

        Flash::success('Acid deleted successfully.');

        return redirect(route('acids.index'));
    }
}
