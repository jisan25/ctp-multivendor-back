<?php

namespace App\Http\Controllers;

use App\Traits\LogTrait;
use App\Traits\ResponseTrait;
use App\Traits\FilterSortSearch;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseTrait, FilterSortSearch, LogTrait;
}
