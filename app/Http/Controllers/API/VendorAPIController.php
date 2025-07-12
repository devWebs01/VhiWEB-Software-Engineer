<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateVendorAPIRequest;
use App\Http\Requests\API\UpdateVendorAPIRequest;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class VendorController
 */
class VendorAPIController extends AppBaseController
{
    private VendorRepository $vendorRepository;

    public function __construct(VendorRepository $vendorRepo)
    {
        $this->middleware('auth:sanctum');
        $this->vendorRepository = $vendorRepo;

    }

    /**
     * @OA\Get(
     *      path="/api/vendors",
     *      summary="getVendorList",
     *      tags={"Vendor"},
     *      description="Get all Vendors",
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *
     *                  @OA\Items(ref="#/components/schemas/Vendor")
     *              ),
     *
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $vendors = $this->vendorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($vendors->toArray(), 'Vendors retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/vendors",
     *      summary="createVendor",
     *      tags={"Vendor"},
     *      description="Create Vendor",
     *
     *      @OA\RequestBody(
     *        required=true,
     *
     *        @OA\JsonContent(ref="#/components/schemas/Vendor")
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Vendor"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVendorAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $vendor = $this->vendorRepository->create($input);

        return $this->sendResponse($vendor->toArray(), 'Vendor saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/api/vendors/{id}",
     *      summary="getVendorItem",
     *      tags={"Vendor"},
     *      description="Get Vendor",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Vendor",
     *
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Vendor"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        return $this->sendResponse($vendor->toArray(), 'Vendor retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/api/vendors/{id}",
     *      summary="updateVendor",
     *      tags={"Vendor"},
     *      description="Update Vendor",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Vendor",
     *
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *
     *      @OA\RequestBody(
     *        required=true,
     *
     *        @OA\JsonContent(ref="#/components/schemas/Vendor")
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Vendor"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVendorAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        $vendor = $this->vendorRepository->update($input, $id);

        return $this->sendResponse($vendor->toArray(), 'Vendor updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/api/vendors/{id}",
     *      summary="deleteVendor",
     *      tags={"Vendor"},
     *      description="Delete Vendor",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Vendor",
     *
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        $vendor->delete();

        return $this->sendSuccess('Vendor deleted successfully');
    }
}
