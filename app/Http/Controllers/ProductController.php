<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response(ProductCollection::collection(Product::all()),"200");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(),[
            "code" => "required|string",
            "title" => "required|string",
            "description" => "required|string",
        ]);
        if ($validator->fails()) {
            $errorText = $validator->messages()->first('*');
            return Response($errorText,"422");
        }
        return Response(Product::create($request->all()),"200");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return Response(new ProductCollection(Product::find($id)),"200");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $product = Product::find($id);
        $product->update($request->all());
        return Response(new ProductCollection($product),"200");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Product::destroy($id);
        return Response("Successfully deleted",200);
    }
}
