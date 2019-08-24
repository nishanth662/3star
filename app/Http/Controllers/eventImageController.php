<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateeventImageRequest;
use App\Http\Requests\UpdateeventImageRequest;
use App\Repositories\eventImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class eventImageController extends AppBaseController
{
    /** @var  eventImageRepository */
    private $eventImageRepository;

    public function __construct(eventImageRepository $eventImageRepo)
    {
        $this->eventImageRepository = $eventImageRepo;
    }

    /**
     * Display a listing of the eventImage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $eventImages = $this->eventImageRepository->all();

        return view('event_images.index')
            ->with('eventImages', $eventImages);
    }

    /**
     * Show the form for creating a new eventImage.
     *
     * @return Response
     */
    public function create()
    {
        return view('event_images.create');
    }

    /**
     * Store a newly created eventImage in storage.
     *
     * @param CreateeventImageRequest $request
     *
     * @return Response
     */
    public function store(CreateeventImageRequest $request)
    {
        $input = $request->all();

        $eventImage = $this->eventImageRepository->create($input);

        Flash::success('Event Image saved successfully.');

        return redirect(route('eventImages.index'));
    }

    /**
     * Display the specified eventImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $eventImage = $this->eventImageRepository->find($id);

        if (empty($eventImage)) {
            Flash::error('Event Image not found');

            return redirect(route('eventImages.index'));
        }

        return view('event_images.show')->with('eventImage', $eventImage);
    }

    /**
     * Show the form for editing the specified eventImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $eventImage = $this->eventImageRepository->find($id);

        if (empty($eventImage)) {
            Flash::error('Event Image not found');

            return redirect(route('eventImages.index'));
        }

        return view('event_images.edit')->with('eventImage', $eventImage);
    }

    /**
     * Update the specified eventImage in storage.
     *
     * @param int $id
     * @param UpdateeventImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateeventImageRequest $request)
    {
        $eventImage = $this->eventImageRepository->find($id);

        if (empty($eventImage)) {
            Flash::error('Event Image not found');

            return redirect(route('eventImages.index'));
        }

        $eventImage = $this->eventImageRepository->update($request->all(), $id);

        Flash::success('Event Image updated successfully.');

        return redirect(route('eventImages.index'));
    }

    /**
     * Remove the specified eventImage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $eventImage = $this->eventImageRepository->find($id);

        if (empty($eventImage)) {
            Flash::error('Event Image not found');

            return redirect(route('eventImages.index'));
        }

        $this->eventImageRepository->delete($id);

        Flash::success('Event Image deleted successfully.');

        return redirect(route('eventImages.index'));
    }
}
