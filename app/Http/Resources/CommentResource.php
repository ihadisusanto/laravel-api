<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    //define property
    public $status;
    public $message;
    public $resource;

    /**
     * __construct
     * @param mixed $status
     * @param mixed $message
     * @param mixed $resource
     */

    public function __construct($status, $message, $resource){
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     * @param mixed $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return[
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }
}
