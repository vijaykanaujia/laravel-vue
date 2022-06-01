<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\EditUserRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* @var UserService */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     * @return void
     */

    public function __construnct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new User();
        $props = [
            'page' => $request->get('page', 0),
            'pageSize' => $request->get('pageSize', 10),
            'cols' => $request->get('cols', []),
            'filter' => $request->get('filter', ''),
            'orderField' => $request->get('orderField', 'id'),
            'orderBy' => $request->get('orderBy', 'desc'),
            'displayedColumns' => $model->getDisplayedColumns(),
            'title' => 'Permission',
            // 'with' => ['menu']
        ];
        $model = $model->selectCols($props['cols'])->applyFilter($props['filter'])->sortOrder($props['orderField'], $props['orderBy']);
        // $model = $model->handleWith($props['with']);
        $model = $model->getBuilder();
        $props['dataSource'] = $model->paginate($props['pageSize'], ['*'], 'page', $props['page']);
        return Inertia::render('Settings/User/Read', $props);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $props = [
            'title' => 'Create User',
            'token' => csrf_token()
        ];
        return Inertia::render('Settings/User/Create', $props);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $props = [
            'title' => 'Permission Details: #' . $user->id,
            'permissions' => $user
        ];
        return Inertia::render('Settings/User/Show', $props);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $props = [
            'title' => "Update User : #" . $user->id,
            'user' => $user,
            'menuList' => getAllSelectInputMenu(),
            'token' => csrf_token()
        ];
        // dd($props);
        return Inertia::render('Settings/User/Edit', $props);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        $data = Arr::whereNotNull($request->validated());
        if (Arr::has($data, 'password')) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = new User();
        if ($request->action_type == 'multi-delete') {
            $user->whereIn('id', $request->ids)->delete();
        }
        if ($request->user) {
            $user->find($request->user)->delete();
        }
        return Redirect::back();
    }

    /**
     * @param Request $request
     */

     public function postAssignRole(Request $request)
     {
         $this->userService->assignRole($request->user, $request->role);
         return Redirect::back();
     }
}
