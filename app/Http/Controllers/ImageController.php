<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Homecarousels;
use File;
use Image;

class ImageController extends Controller
{
    /****
    Haalt de geklikte Carousel op om te edite.
    ****/
    public function editHomeCarousel($id)
    {
    	if(Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5"){
    		$currentCarousel = Homecarousels::findOrFail($id);
    		return view("carousels/homecarouseledit", array("currentCarousel" => $currentCarousel));
    	}else{
    		return redirect()->route('home');
    	}
    }

    /****
    Een title en description is required om de carousel te updaten, waarnaar er word gekeken of er een image bij de request zit, zodat deze geresized en geupload kan worden.
    ****/
    public function updateHomeCarousel($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
            ]);

    	$carouselToUpdate = Homecarousels::find($id);

    if($request->hasFile('slideimage'))
    {
        $slideimage = $request->file('slideimage');
        $filename = "carousel".$id . ".jpg";
        $path = '/uploads/carousel/';

        File::Delete(public_path("/uploads/carousel/" . $filename ));

        Image::make($slideimage)->fit(1920,1080)->save(public_path("/uploads/carousel/" . $filename ));

    }

    	$carouselToUpdate->title = $request->title;
    	$carouselToUpdate->description = $request->description;
    	$carouselToUpdate->link = $request->link;
    	$carouselToUpdate->linkName = $request->linkName;
    	$carouselToUpdate->save();

    	return redirect()->route('home');
    }
}
