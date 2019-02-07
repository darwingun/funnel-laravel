<?php

namespace App\Http\Controllers\API\v1;

use App\Rules\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Handlers\BusinessReviewHandler;
use App\Http\Resources\BusinessReviewResource;

class BusinessReviewsController extends Controller
{
    /**
     *  @OA\Post(
     *     path="/api/v1/business-reviews",
     *     summary="Create a business review",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="business_id",
     *                     description="id of business",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="code",
     *                     description="Score",
     *                     type="int"
     *                 ),
     *                 @OA\Property(
     *                     property="comment",
     *                     description="Review comment",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="photo",
     *                     description="base64 encoded review photo",
     *                     type="string"
     *                 ),
     *         ),
     *     ),
     * ),
     *     @OA\Response(response="201", description="BusinessPostResource"),
     *  )
     */
    public function store(Request $request, BusinessReviewHandler $reviewHandler) {
        $this->validate($request, [
            'business_id' => ['required', new Uuid],
            'code'        => 'required|integer',
            'comment'     => 'sometimes|string',
            'photo'       => 'sometimes|string'
        ]);

        $businessId = $request->business_id;
        $transformedReview = new BusinessReviewResource($reviewHandler->create($businessId, $request));

        return response($transformedReview, 201);
    }

}
