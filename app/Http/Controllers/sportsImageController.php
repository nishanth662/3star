<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesportsImageRequest;
use App\Http\Requests\UpdatesportsImageRequest;
use App\Repositories\sportsImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class sportsImageController extends AppBaseController
{
    /** @var  sportsImageRepository */
    private $sportsImageRepository;

    public function __construct(sportsImageRepository $sportsImageRepo)
    {
        $this->sportsImageRepository = $sportsImageRepo;
    }

    /**
     * Display a listing of the sportsImage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sportsImages = $this->sportsImageRepository->all();

        return view('sports_images.index')
            ->with('sportsImages', $sportsImages);
    }

    /**
     * Show the form for creating a new sportsImage.
     *
     * @return Response
     */
    public function create()
    {
        return view('sports_images.create');
    }

    /**
     * Store a newly created sportsImage in storage.
     *
     * @param CreatesportsImageRequest $request
     *
     * @return Response
     */
    public function store(CreatesportsImageRequest $request)
    {
        $input = $request->all();

        $sportsImage = $this->sportsImageRepository->create($input);

        Flash::success('Sports Image saved successfully.');

        return redirect(route('sportsImages.index'));
    }

    /**
     * Display the specified sportsImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sportsImage = $this->sportsImageRepository->find($id);

        if (empty($sportsImage)) {
            Flash::error('Sports Image not found');

            return redirect(route('sportsImages.index'));
        }

        return view('sports_images.show')->with('sportsImage', $sportsImage);
    }

    /**
     * Show the form for editing the specified sportsImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sportsImage = $this->sportsImageRepository->find($id);

        if (empty($sportsImage)) {
            Flash::error('Sports Image not found');

            return redirect(route('sportsImages.index'));
        }

        return view('sports_images.edit')->with('sportsImage', $sportsImage);
    }

    /**
     * Update the specified sportsImage in storage.
     *
     * @param int $id
     * @param UpdatesportsImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesportsImageRequest $request)
    {
        $sportsImage = $this->sportsImageRepository->find($id);

        if (empty($sportsImage)) {
            Flash::error('Sports Image not found');

            return redirect(route('sportsImages.index'));
        }

        $sportsImage = $this->sportsImageRepository->update($request->all(), $id);

        Flash::success('Sports Image updated successfully.');

        return redirect(route('sportsImages.index'));
    }

    /**
     * Remove the specified sportsImage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sportsImage = $this->sportsImageRepository->find($id);

        if (empty($sportsImage)) {
            Flash::error('Sports Image not found');

            return redirect(route('sportsImages.index'));
        }

        $this->sportsImageRepository->delete($id);

        Flash::success('Sports Image deleted successfully.');

        return redirect(route('sportsImages.index'));
    }
}
