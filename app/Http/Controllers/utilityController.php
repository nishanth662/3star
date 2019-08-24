<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateutilityRequest;
use App\Http\Requests\UpdateutilityRequest;
use App\Repositories\utilityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class utilityController extends AppBaseController
{
    /** @var  utilityRepository */
    private $utilityRepository;

    public function __construct(utilityRepository $utilityRepo)
    {
        $this->utilityRepository = $utilityRepo;
    }

    /**
     * Display a listing of the utility.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $utilities = $this->utilityRepository->all();

        return view('utilities.index')
            ->with('utilities', $utilities);
    }

    /**
     * Show the form for creating a new utility.
     *
     * @return Response
     */
    public function create()
    {
        return view('utilities.create');
    }

    /**
     * Store a newly created utility in storage.
     *
     * @param CreateutilityRequest $request
     *
     * @return Response
     */
    public function store(CreateutilityRequest $request)
    {
        $input = $request->all();

        $utility = $this->utilityRepository->create($input);

        Flash::success('Utility saved successfully.');

        return redirect(route('utilities.index'));
    }

    /**
     * Display the specified utility.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $utility = $this->utilityRepository->find($id);

        if (empty($utility)) {
            Flash::error('Utility not found');

            return redirect(route('utilities.index'));
        }

        return view('utilities.show')->with('utility', $utility);
    }

    /**
     * Show the form for editing the specified utility.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $utility = $this->utilityRepository->find($id);

        if (empty($utility)) {
            Flash::error('Utility not found');

            return redirect(route('utilities.index'));
        }

        return view('utilities.edit')->with('utility', $utility);
    }

    /**
     * Update the specified utility in storage.
     *
     * @param int $id
     * @param UpdateutilityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateutilityRequest $request)
    {
        $utility = $this->utilityRepository->find($id);

        if (empty($utility)) {
            Flash::error('Utility not found');

            return redirect(route('utilities.index'));
        }

        $utility = $this->utilityRepository->update($request->all(), $id);

        Flash::success('Utility updated successfully.');

        return redirect(route('utilities.index'));
    }

    /**
     * Remove the specified utility from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $utility = $this->utilityRepository->find($id);

        if (empty($utility)) {
            Flash::error('Utility not found');

            return redirect(route('utilities.index'));
        }

        $this->utilityRepository->delete($id);

        Flash::success('Utility deleted successfully.');

        return redirect(route('utilities.index'));
    }
}
