<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesportsRequest;
use App\Http\Requests\UpdatesportsRequest;
use App\Models\sports;
use App\Models\sportsImage;
use App\Repositories\sportsRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;

class sportsController extends AppBaseController
{
    /** @var  sportsRepository */
    private $sportsRepository;

    public function __construct(sportsRepository $sportsRepo)
    {
        $this->sportsRepository = $sportsRepo;
    }

    /**
     * Display a listing of the sports.
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
            $sports = $this->sportsRepository->all();
        }
        else
        {
            $sports = sports::whereId(Auth::user()->sports_id)->get();
        }
        return view('sports.index')
            ->with('sports', $sports);
    }

    /**
     * Show the form for creating a new sports.
     *
     * @return Response
     */
    public function create()
    {
        return view('sports.create');
    }

    /**
     * Store a newly created sports in storage.
     *
     * @param CreatesportsRequest $request
     *
     * @return Response
     */
    public function store(CreatesportsRequest $request)
    {
        if (User::where('email',$request->email)->exists())
        {
            Flash::error("Admin Exists");
            return redirect(route('utilities.index'));
        }
        $input = $request->except('image','email','password');
        $sports = $this->sportsRepository->create($input);
        User::create(['name'=>$sports->name,'email'=>$request->email,'admin'=>1,'password'=>Hash::make($request->password),'sports_id'=>$sports->id]);
        if ($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $photoName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('avatars'), $photoName);
                sportsImage::create(['sports_id'=>$sports->id,'image'=>$photoName]);
            }
        }

        Flash::success('Sports saved successfully.');

        return redirect(route('utilities.index'));
    }

    /**
     * Display the specified sports.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sports = $this->sportsRepository->find($id);

        if (empty($sports)) {
            Flash::error('Sports not found');

            return redirect(route('sports.index'));
        }

        return view('sports.show')->with('sports', $sports);
    }

    /**
     * Show the form for editing the specified sports.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sports = $this->sportsRepository->find($id);

        if (empty($sports)) {
            Flash::error('Sports not found');

            return redirect(route('utilities.index'));
        }

        return view('sports.edit')->with('sports', $sports);
    }

    /**
     * Update the specified sports in storage.
     *
     * @param int $id
     * @param UpdatesportsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesportsRequest $request)
    {
        $sports = $this->sportsRepository->find($id);

        if (empty($sports)) {
            Flash::error('Sports not found');

            return redirect(route('utilities.index'));
        }
        $input = $request->except('image');
        $sports = $this->sportsRepository->update($input, $id);
        if ($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $photoName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('avatars'), $photoName);
                sportsImage::create(['sports_id'=>$id,'image'=>$photoName]);
            }
        }

        Flash::success('Sports updated successfully.');

        return redirect(route('utilities.index'));
    }

    /**
     * Remove the specified sports from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sports = $this->sportsRepository->find($id);

        if (empty($sports)) {
            Flash::error('Sports not found');

            return redirect(route('utilities.index'));
        }

        $this->sportsRepository->delete($id);

        Flash::success('Sports deleted successfully.');

        return redirect(route('utilities.index'));
    }
}
