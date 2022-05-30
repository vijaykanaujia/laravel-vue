<?php
use App\Repository\MenuRepository;
use App\Models\Menu;

function getSelectInputMenu(){
    return (new MenuRepository())->getMenu(auth()->user())->pluck('title', 'id')->map(function($v, $k){ return ['id' => $k ,'text' => $v]; })->toArray();
}

function getAllSelectInputMenu(){
    return collect(Menu::all())->map(function($v){ return ['id' => $v->id ,'text' => $v->title]; })->toArray();
}