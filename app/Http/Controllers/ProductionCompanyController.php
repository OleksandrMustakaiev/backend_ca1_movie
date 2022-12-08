<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionCompany;
use Illuminate\Http\Response;
use App\Http\Resources\ProductionCompanyResource;
use App\Http\Resources\ProductionCompanyCollection;
use App\Http\Requests\StoreProductionCompanyRequest;
use App\Http\Requests\UpdateProductionCompanyRequest;

class ProductionCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
 * @OA\Get(
 *     path="/api/production_company",
 *     description="Displays all the production companies",
 *     summary="Show All Production Companies",
 *     tags={"Production Companies"},
 *      @OA\Response(
 *         response=200,
 *         description="Successful operation, Returns a list of Movies in JSON format"
 *       ),
 *      @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *         response=403,
 *         description="Forbidden"
 *      )
 * )
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductionCompanyCollection(ProductionCompany::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="/api/production_company",
     *      operationId="store_production_company",
     *      tags={"Production Companies"},
     *      summary="Create a new Production Company",
     *      description="Stores the production company in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "address"},
     *            @OA\Property(property="name", type="string", format="string", example="Admin Test"),
     *            @OA\Property(property="address", type="string", format="string", example="Address"),
     *            
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductionCompanyRequest $request)
    {
        $productionCompany = ProductionCompany::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return new ProductionCompanyResource($productionCompany);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/api/production_company/{id}",
     *     description="Gets a production company by ID",
     *     summary="View Production Company by ID",
     *     tags={"Production Companies"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Productin Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionCompany $productionCompany)
    {
        return new ProductionCompanyResource($productionCompany);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *      path="/api/production_company/{id}",
     *      operationId="edit_production_company",
     *      tags={"Production Companies"},
     *      summary="Edit a Production Company by ID",
     *      description="Edit the Production Company",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
        *          name="id",
        *          description="Production Company id",
        *          required=true,
        *          in="path",
        *          @OA\Schema(
        *              type="integer")
     *          ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "address"},
     *            @OA\Property(property="name", type="string", format="string", example="Admin Test"),
     *            @OA\Property(property="address", type="string", format="string", example="Address")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductionCompanyRequest $request, ProductionCompany $productionCompany)
    {
        $productionCompany->update($request->all());

        return new ProductionCompanyResource($productionCompany);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @OA\Delete(
     *    path="/api/production_company/{id}",
     *    operationId="destroy_production_company",
     *    tags={"Production Companies"},
     *    summary="Delete a Production Company by ID",
     *    description="Delete Production Company",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of a Production Company", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionCompany $productionCompany)
    {
        $productionCompany->delete();
    }
}
