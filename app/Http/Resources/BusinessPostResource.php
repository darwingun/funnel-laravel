<?php

namespace App\Http\Resources;

class BusinessPostResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
            return parent::toArray($request);
    }
}
