<?php

namespace App\Http\Controllers;

use App\CommodityCategory;
use Illuminate\Http\Request;

class CommodityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommodityCategory  $commodityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CommodityCategory $commodityCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommodityCategory  $commodityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CommodityCategory $commodityCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommodityCategory  $commodityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommodityCategory $commodityCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommodityCategory  $commodityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommodityCategory $commodityCategory)
    {
        //
    }

    public static function CommodityCategory()
    {
        return CommodityCategory::orderBy('ten', 'asc')->get();
    }

    public static function CommodityCategoryByID($id)
    {
        return CommodityCategory::find($id);
    }
}
