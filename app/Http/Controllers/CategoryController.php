<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a list of all products.
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = Category::all();
        return Response(CategoryCollection::collection($categories),"200");
    }
    /**
     * create new category
     *
     * @param Request $request
     * @return Response
     */
    public function store(PostCategoryRequest $request): Response
    {
        $product = Category::create($request->all());
        return Response($product,"200");

    }
    /**
     * Remove the specified category from database.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Category::destroy($id);
        return Response("Successfully deleted",200);
    }
}
