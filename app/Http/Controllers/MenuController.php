<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\EditMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new Menu();
        $props = [
            'page' => $request->get('page', 0),
            'pageSize' => $request->get('pageSize', 10),
            'cols' => $request->get('cols', []),
            'filter' => $request->get('filter', ''),
            'orderField' => $request->get('orderField', 'id'),
            'orderBy' => $request->get('orderBy', 'desc'),
            'displayedColumns' => $model->getDisplayedColumns(),
            'title' => 'Menu'
        ];
        $model = $model->selectCols($props['cols'])->applyFilter($props['filter'])->sortOrder($props['orderField'], $props['orderBy']);
        $model = $model->getBuilder();
        $props['dataSource'] = $model->paginate($props['pageSize'], ['*'], 'page', $props['page']);
        return Inertia::render('Settings/Menu/Read', $props);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $props = [
            'title' => 'Create Menu',
            'parent_menu' => getSelectInputMenu(),
            'token' => csrf_token()
        ];
        return Inertia::render('Settings/Menu/Create', $props);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Menu\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        Menu::create($request->validated());
        return Redirect::route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $props = [
            'title' => 'Menu Details: #'. $menu->id,
            'menu' => $menu
        ];
        return Inertia::render('Settings/Menu/Show', $props);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $props = [
            'title' => "Update Menu : #". $menu->id,
            'menu' => $menu,
            'parent_menu' => getSelectInputMenu(),
            'token' => csrf_token()
        ];
        return Inertia::render('Settings/Menu/Edit', $props);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Menu\EditMenuRequest  $request
     * @param  Object  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(EditMenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $menu = new Menu();
        if($request->action_type == 'multi-delete'){
            $menu->whereIn('id', $request->ids)->delete();
        }
        if($request->menu){
            $menu->find($request->menu)->delete();
        }
        return Redirect::back();
    }
}
