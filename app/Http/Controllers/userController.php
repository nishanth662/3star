<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;

class userController extends AppBaseController
{
    /** @var  userRepository */
    private $userRepository;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::where('admin','!=',1)->get();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateuserRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (User::where('email',$request->email)->exists())
        {
            Flash::error("User Exists");
            return redirect(route('users.index'));
        }
        $input = $request->except('password');
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::whereId($id)->first();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::whereId($id)->first();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param UpdateuserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        if (User::where('email',$request->email)->exists())
        {
            Flash::error("User Exists");
            return redirect(route('users.index'));
        }
        $user = User::whereId($id)->first();
        $input = $request->except('password');
        $input['password'] = Hash::make($request->password);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $user ->update($input);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->first();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        User::whereId($id)->forcedelete();

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
