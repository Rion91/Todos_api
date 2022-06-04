<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TodosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'note' => $this->note,
            'username' => auth()->user()->name,
            'isComplete' => $this->isComplete,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-y h:m:i')
            // 12-01-2001 01:01:
        ];
    }
}
