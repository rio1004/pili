<?php

namespace App\Http\Controllers;

use App\Models\LocationTag;
use Illuminate\Http\Request;


class LocationTagController extends Controller
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
        $validatedTags = request()->validate([
            'brgy'=>'required',
            'municipality'=>'required',
            'trees'=>'required',
            'farmers'=>'required',
            'retailers'=>'required',
            'processors'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'pili_image'=>'required|image'
            
        ]);
        if($request->hasFile('pili_image'))
        {
            $fileNameWithExt = $request->file('pili_image')->getClientOriginalName();
            $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            $extension = $request->file('pili_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('pili_image')->storeAs('public/location_images',$fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpeg';
        }
        LocationTag::create([
            'brgy'=>$validatedTags['brgy'],
            'municipality'=>$validatedTags['municipality'],
            'trees'=>$validatedTags['trees'],
            'farmers'=>$validatedTags['farmers'],
            'retailers'=>$validatedTags['retailers'],
            'processors'=>$validatedTags['processors'],
            'latitude'=>$validatedTags['latitude'],
            'longitude'=>$validatedTags['longitude'],
            'pili_image'=>$fileNameToStore 
        ]);
        return redirect(route('home.mapping'))->with('message','successfully added Location Tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationTag  $locationTag
     * @return \Illuminate\Http\Response
     */
    public function show(LocationTag $locationTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationTag  $locationTag
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationTag $locationTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationTag  $locationTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationTag $locationTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationTag  $locationTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationTag $locationTag)
    {
        //
    }
}
