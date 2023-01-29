<?php

namespace App\Http\Controllers;

use App\Events\NewProductAddedEvent;
use App\Http\Requests\PostActivityRequest;
use App\Http\Requests\PostProductRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Activity;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{

    /**
     * Save a new Activity into database.
     *
     * @param Request $request
     * @return Response
     */
    public function store(PostActivityRequest $request): Response
    {
        $validatedData = $request->validated();
        $validatedData['user'] = Auth::user()->id;
        $activity = Activity::create($validatedData);
//        event(new NewActivityAddedEvent($activity));
        return Response($activity,"200");
    }

}
