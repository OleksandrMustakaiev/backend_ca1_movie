<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionCompanyRequest;
use App\Http\Requests\UpdateProductionCompanyRequest;
use App\Http\Resources\ProductionCompanyCollection;
use App\Http\Resources\ProductionCompanyResource;
use App\Models\ProductionCompany;
use Illuminate\Http\Request;

class ProductionCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductionCompanyCollection(ProductionCompany::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     *
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
     *
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionCompany $productionCompany)
    {
        return new ProductionCompanyResource($productionCompany);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductionCompanyRequest $request, ProductionCompany $productionCompany)
    {
        $productionCompany->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionCompany  $productionCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionCompany $productionCompany)
    {
        $productionCompany->delete();
    }
}
