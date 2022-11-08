<?php
use App\Repository\MenuRepository;
use App\Models\Menu;
use Illuminate\Support\Facades\Lang;

function getSelectInputMenu(){
    return (new MenuRepository())->getMenu(auth()->user())->pluck('title', 'id')->map(function($v, $k){ return ['id' => $k ,'text' => $v]; })->toArray();
}

function getAllSelectInputMenu(){
    return collect(Menu::all())->map(function($v){ return ['id' => $v->id ,'text' => $v->title]; })->toArray();
}

function getLanguageArray()
{
    $path = base_path('lang/'. app()->getLocale());
    $files = array_diff(scandir($path), array('.', '..'));
    $languages = [];
    if(count($files)){
        foreach($files as $file){
            $ext = pathinfo($file);
            $languages[$ext['filename']] = Lang::get($ext['filename']);
        }
    }
    return $languages;
}