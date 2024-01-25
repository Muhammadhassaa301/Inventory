<?php

use App\Models\History;
use Illuminate\Support\Facades\Auth;

function navActive($url)
{
    $class = '';
    if (url()->full() == $url) {
        $class = 'active';
    }
    return $class;
}

function createHistory($model, $type)
{

    $history = new History();

    $history->model_type = get_class($model);
    $history->model_id = $model->id;
    $history->type = $type;
    $history->user_id = Auth::id();
    $history->payload = $model->toArray();
    $history->save();
}






