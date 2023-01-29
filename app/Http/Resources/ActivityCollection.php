<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**

 */
class ActivityCollection extends JsonResource
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
            'Activity_id' => $this->id,
            'Activity_code' => $this->code,
            'Activity_title' => $this->title,
            'Activity_description' => $this->description,
            'Activity_type' => $this->type,
            'Activity_user' => $this->user,
            'Activity_city' => $this->city,
            'Activity_location' => $this->location,
            'Activity_start' => $this->start,
            'Activity_end' => $this->end,
            'created_at' => Carbon::parse($this->created_at)->toDateString()
        ];
    }
}
