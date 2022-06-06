<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Services\UserService;
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

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
	 * @return UserService
	 */
	public function getUserService()
	{
		return $this->userService;
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
            'token' => csrf_token(),
            'roles' => collect(Role::all())->map(function($v){ return ['id' => $v->id ,'text' => $v->name]; })->toArray()
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
        $this->userService->store($request->validated());
        return Redirect::back();
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
            'token' => csrf_token(),
            'roles' => collect(Role::all())->map(function($v){ return ['id' => $v->id ,'text' => $v->name]; })->toArray()
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
    public function update(EditUserRequest $request, $user)
    {
        $this->userService->update($user, $request->validated());
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
        $this->userService->destroy($request);
        return Redirect::back();
    }
}
