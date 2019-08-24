<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateadminRequest;
use App\Http\Requests\UpdateadminRequest;
use App\Models\sports;
use App\Repositories\adminRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;

class adminController extends AppBaseController
{
    /** @var  adminRepository */
    private $adminRepository;

    public function __construct(adminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $admins = User::where('super_admin',0)->where('admin',1)->get();

        return view('admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Response
     */
    public function create()
    {
        $sports = sports::get();

        return view('admins.create',compact('sports'));
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param CreateadminRequest $request
     *
     * @return Response
     */
    public function store(CreateadminRequest $request)
    {
        if (User::where('email',$request->email)->exists())
        {
            Flash::error("User Exists");
            return redirect(route('admins.index'));
        }
        $input = $request->except('_token','password');
        $input['admin'] = 1;

        $input['password'] = Hash::make($request->password);
        User::create($input);
        Flash::success('Admin saved successfully.');

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(route('admins.index'));
        }

        return view('admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sports = sports::get();

        $admin = User::whereId($id)->first;

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(route('admins.index'));
        }

        return view('admins.edit',compact('sports'))->with('admin', $admin);
    }

    /**
     * Update the specified admin in storage.
     *
     * @param int $id
     * @param UpdateadminRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateadminRequest $request)
    {
        $input = $request->except('_token');
        $admin = User::whereId($id)->first();

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(route('admins.index'));
        }

        $admin->update($input);

        Flash::success('Admin updated successfully.');

        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admin = User::whereId($id)->first();

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(route('admins.index'));
        }

        User::whereId($id)->forcedelete();

        Flash::success('Admin deleted successfully.');

        return redirect(route('admins.index'));
    }

    public function search_sports(Request $request)
    {
        $sports = sports::where('name','like','%'.$request->q.'%')->get(['id','name']);
        return $sports;
    }
}
