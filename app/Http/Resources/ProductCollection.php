<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed id
 * @property mixed code
 * @property mixed title
 * @property mixed category
 * @property mixed description
 * @property mixed created_at
 * @property mixed view_count
 */
class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->id,
            'product_code' => $this->code,
            'product_title' => $this->title,
            'product_category_name' => $this->category?$this->category->name:"uncategorized",
            'product_description' => $this->description,
            'product_view_count' => $this->view_count,
            'created_at' => Carbon::parse($this->created_at)->toDateString()
        ];
    }
}
