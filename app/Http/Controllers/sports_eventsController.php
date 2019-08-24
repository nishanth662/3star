<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createsports_eventsRequest;
use App\Http\Requests\Updatesports_eventsRequest;
use App\Models\eventImage;
use App\Models\sports;
use App\Models\sports_events;
use App\Models\sportsImage;
use App\Repositories\sports_eventsRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class sports_eventsController extends AppBaseController
{
    /** @var  sports_eventsRepository */
    private $sportsEventsRepository;

    public function __construct(sports_eventsRepository $sportsEventsRepo)
    {
        $this->sportsEventsRepository = $sportsEventsRepo;
    }

    /**
     * Display a listing of the sports_events.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->admin == 0)
        {
            return redirect('home');
        }
        if(Auth::user()->super_admin == 1)
        {
            $sportsEvents = $this->sportsEventsRepository->all();
        }
        else
        {
            $sportsEvents = sports_events::where('ground',Auth::user()->sports_id)->get();
        }


        return view('sports_events.index')
            ->with('sportsEvents', $sportsEvents);
    }

    /**
     * Show the form for creating a new sports_events.
     *
     * @return Response
     */
    public function create()
    {
        $sports = sports::get();
        return view('sports_events.create',compact('sports'));
    }

    /**
     * Store a newly created sports_events in storage.
     *
     * @param Createsports_eventsRequest $request
     *
     * @return Response
     */
    public function store(Createsports_eventsRequest $request)
    {
        if (sports_events::where('ground',$request->ground)->whereDate('date_time',new Carbon($request->end_date))->exists())
        {
            Flash::error("Event is aready exists on that date");
            return redirect(route('sportsEvents.index'));
        }
        $input = $request->except('image');
        $input['date_time'] = new \DateTime($request->end_date);
        $sportsEvents = $this->sportsEventsRepository->create($input);
        if ($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $photoName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('avatars'), $photoName);
                eventImage::create(['event_id'=>$sportsEvents->id,'image'=>$photoName]);
            }
        }
        Flash::success('Sports Events saved successfully.');

        return redirect(route('sportsEvents.index'));
    }

    /**
     * Display the specified sports_events.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sportsEvents = $this->sportsEventsRepository->find($id);

        if (empty($sportsEvents)) {
            Flash::error('Sports Events not found');

            return redirect(route('sportsEvents.index'));
        }

        return view('sports_events.show')->with('sportsEvents', $sportsEvents);
    }

    /**
     * Show the form for editing the specified sports_events.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sports = sports::get();
        $sportsEvents = $this->sportsEventsRepository->find($id);

        if (empty($sportsEvents)) {
            Flash::error('Sports Events not found');

            return redirect(route('sportsEvents.index'));
        }

        return view('sports_events.edit',compact('sports'))->with('sportsEvents', $sportsEvents);
    }

    /**
     * Update the specified sports_events in storage.
     *
     * @param int $id
     * @param Updatesports_eventsRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesports_eventsRequest $request)
    {
        if (sports_events::where('ground',$request->ground)->whereDate('date_time',new Carbon($request->end_date))->where('id','!='.$id)->exists()) {
            Flash::error("Event is aready exists on that date");
            return redirect(route('sportsEvents.index'));
        }

        $sportsEvents = $this->sportsEventsRepository->find($id);

        if (empty($sportsEvents)) {
            Flash::error('Sports Events not found');

            return redirect(route('sportsEvents.index'));
        }
        $input = $request->except('image');
        $date = new \DateTime($request->end_date);
        $input['date_time'] = $date->format('Y-m-d H:i:s');
        $sportsEvents->update($input);
        if ($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $photoName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('avatars'), $photoName);
                eventImage::create(['event_id'=>$id,'image'=>$photoName]);
            }
        }

        Flash::success('Sports Events updated successfully.');

        return redirect(route('sportsEvents.index'));
    }

    /**
     * Remove the specified sports_events from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sportsEvents = $this->sportsEventsRepository->find($id);

        if (empty($sportsEvents)) {
            Flash::error('Sports Events not found');

            return redirect(route('sportsEvents.index'));
        }

        $this->sportsEventsRepository->delete($id);

        Flash::success('Sports Events deleted successfully.');

        return redirect(route('sportsEvents.index'));
    }
}
