<?php

namespace App\Http\Controllers;

use App\Events\NewProductAddedEvent;
use App\Http\Requests\PostActivityRequest;
use App\Http\Requests\PostProductRequest;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Activity;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(): Response
    {
        $activities = Activity::all();
        return Response(ActivityCollection::collection($activities),"200");
    }

    /**
     * Save a new product into database.
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
        return Response($activity, "200");
    }

    public function show($id): Response
    {
        $activity = Activity::findOrFail($id);
        return Response(new ActivityCollection($activity),"200");
    }

    public function update(PostActivityRequest $request, $id): Response
    {
        $validatedData = $request->validated();
        $activity = Activity::findOrFail($id);
        $activity->update($validatedData);
        return Response(new ActivityCollection($activity),"200");
    }

    public function destroy($id): Response
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return Response('Activity deleted.', 200);
    }


}
