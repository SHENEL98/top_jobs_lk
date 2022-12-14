<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Free;
use App\Models\Product;
use Illuminate\Http\Request;

class FreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status',"Active")->get();

        $free_issues = Free::get();
        return view('free_issue.free_issue_list')->with(['free_issues'=>$free_issues,'products'=>$products]);
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
     * @param  \App\Models\Free  $free
     * @return \Illuminate\Http\Response
     */
    public function show(Free $free)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Free  $free
     * @return \Illuminate\Http\Response
     */
    public function edit(Free $free)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Free  $free
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Free $free)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Free  $free
     * @return \Illuminate\Http\Response
     */
    public function destroy(Free $free)
    {
        //
    }
}
