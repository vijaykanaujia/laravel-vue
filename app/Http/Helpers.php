<?php
use App\Repository\MenuRepository;

function getSelectInputMenu(){
    return (new MenuRepository())->getMenu(auth()->user())->pluck('title', 'id')->map(function($v, $k){ return ['id' => $k ,'text' => $v]; })->toArray();
}