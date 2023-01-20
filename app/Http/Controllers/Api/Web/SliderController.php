<?php

namespace App\Http\Controllers\Api\Web;

use App\Models\Slider;
use App\Http\Resources\SliderResource;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $sliders = Slider::latest()->get();

        //return with Api Resource
        return new SliderResource(true, 'List Data Sliders', $sliders);
    }
}
