<?php

namespace App\Http\Controllers;

use App\Events\NewProductAddedEvent;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a list of all products.
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = Product::with("category")->get();
        return Response(ProductCollection::collection($products),"200");
    }

    /**
     * Save a new product into database.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(),[
            "code" => "required|string",
            "title" => "required|string",
            "category_id" => 'nullable|numeric|exists:Categories,id',
            "description" => "required|string",
        ]);
        if ($validator->fails()) {
            $errorText = $validator->messages()->first('*');
            return Response($errorText,"422");
        }
        $product = Product::create($request->all());
        event(new NewProductAddedEvent($product));
        return Response($product,"200");
    }

    /**
     * Display the product specified by id.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return Response(new ProductCollection(Product::with("category")->find($id)),"200");
    }

    /**
     * Update the product based on given data.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {

        $product = Product::find($id);
        if (!$product){
            return Response("Not found","404");
        }
        $product->update($request->all());
        return Response(new ProductCollection($product),"200");
    }

    /**
     * Remove the specified product from database.
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
