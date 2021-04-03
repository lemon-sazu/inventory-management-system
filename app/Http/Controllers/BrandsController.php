<?php

namespace App\Http\Controllers;

use App\Models\brands;

use Illuminate\Http\Request;

use Illuminate\Http\Response;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brands::orderby('created_at', 'DESC')->get();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|min:3|max:50|unique:brands'
        ]);
        $brands = new Brands();
        $name = $request->name;
        $brands->name =  $name;
        $brands->save();
        flash('Brand '. $name .' Created Successfully.')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $brand = Brands::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' =>'required|min:3|max:50|unique:brands,name,' . $id
        ]);

        $brands = Brands::findOrFail($id);
        
        $brands->name = $request->name;
        $brands->save();
        flash('Brands Update Successfully.')->success();
        return redirect()->route('brands.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brands::findOrFail($id);
        $brand->delete();

        flash('Brand Delete Successfully.')->success();
        return redirect()->route('brands.index');
    }



      // HANDLE AJAX REQUEST 
    public function getBrandsJson(){
        $brands = Brands::all();

        return response()->json([
            'success' => true,
            'data'    => $brands
        ], Response::HTTP_OK);
    }
}
