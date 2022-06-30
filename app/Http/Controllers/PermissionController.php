<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Permission\StorePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        $model = new Permission();
        $props = [
            'page' => $request->get('page', 0),
            'pageSize' => $request->get('pageSize', 10),
            'cols' => $request->get('cols', []),
            'filter' => $request->get('filter', ''),
            'orderField' => $request->get('orderField', 'id'),
            'orderBy' => $request->get('orderBy', 'desc'),
            'displayedColumns' => $model->getDisplayedColumns(),
            'title' => 'Permission',
            'with' => ['menu']
        ];
        $model = $model->selectCols($props['cols'])->applyFilter($props['filter'])->sortOrder($props['orderField'], $props['orderBy']);
        $model = $model->handleWith($props['with']);
        $model = $model->getBuilder();
        $props['dataSource'] = $model->paginate($props['pageSize'], ['*'], 'page', $props['page']);
        return Inertia::render('Settings/Permission/Read', $props);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Permission::class);
        $props = [
            'title' => 'Create Permission',
            'menuList' => getAllSelectInputMenu(),
            'token' => csrf_token()
        ];
        return Inertia::render('Settings/Permission/Create', $props);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $this->authorize('create', Permission::class);
        Permission::create($request->validated());
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $this->authorize('view', Permission::class);
        $props = [
            'title' => 'Permission Details: #'. $permission->id,
            'permissions' => $permission->toArray()
        ];
        return Inertia::render('Settings/Permission/Show', $props);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authorize('update', Permission::class);
        $props = [
            'title' => "Update Permission : #". $permission->id,
            'permission' => $permission,
            'menuList' => getAllSelectInputMenu(),
            'token' => csrf_token()
        ];
        return Inertia::render('Settings/Permission/Edit', $props);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        $this->authorize('update', Permission::class);
        $permission->update($request->validated());
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Permission::class);
        $permission = new Permission();
        if($request->action_type == 'multi-delete'){
            $permission->whereIn('id', $request->ids)->delete();
        }
        if($request->permission){
            $permission->find($request->permission)->delete();
        }
        return Redirect::back();
    }
}
