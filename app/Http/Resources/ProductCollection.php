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
 * @property mixed description
 * @property mixed created_at
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
            'Product ID' => $this->id,
            'Product code' => $this->code,
            'Product title' => $this->title,
            'Description of product' => $this->description,
            'Creation date' => Carbon::parse($this->created_at)->toDateString()
        ];
    }
}
