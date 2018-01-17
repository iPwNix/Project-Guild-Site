<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Http\Requests;
use Auth;
use Image;
use File;
use App\User;
use App\Roles;
use App\GuildRanks;
use App\Maincharacters;
use App\Classes;
use App\Classspecs;
use App\Classroles;
use App\Homecarousels;
use App\Newsarticles;
use App\Newscategories;

class NewsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    /****
    Lists alle news articles, de nieuwste eerst en drie per pagina.
    ****/
    public function index(){
        if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9"){
            $newsarticles = Newsarticles::orderBy("created_at", "desc")->paginate(3);
            return view('news/index', ['newsarticles' => $newsarticles]);            
        }else{
            return redirect('/home');
        }

    }

    /****
    Haalt het geklikte article op en stuur hem naar de view op.
    ****/
    public function showArticle($id){
        if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9"){
        	$showArticle = Newsarticles::findOrFail($id);
        	return view('news/showarticle', array('Newsarticle' => $showArticle));
        }else{
            return redirect('/home');
        }
    }

    /****
    Haalt alle Newscategories op, zodat ze gebruikt kunnen worden om een nieuw article te maken.
    ****/
    public function creatingNews(){
        if(Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
        {
    	   $newsCatagories = Newscategories::all();
    	   return view('news/create', array('catagories' => $newsCatagories));
        }else{
            return redirect('/home');
        }
    }

    /****
    Een title, catagory en content zijn required voor het maken van een article, als er images bij de request zit worden deze geresized en opgeslagen.
    ****/
    public function createNews(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'catagory' => 'required',
            'content' => 'required'
            ]);

    	$newNews = new Newsarticles;
    	$newNews->title = $request->title;
    	$newNews->content = $request->content;
    	$newNews->catagory = $request->catagory;
    	$newNews->postedBy = Auth::user()->id;
    	$newNews->created_at = Carbon::now();
    	$newNews->updated_at = Carbon::now();

        if($request->hasFile('newsSmallImage')){
        	$newsSmallImage = $request->file('newsSmallImage');

        	//Generates the file name {{ title + time + jpg/png/gif}}
        	$smallImageName = time() . "." . $newsSmallImage->getClientOriginalExtension();

        	//Resizes the image to the size with Image Intervention and save it
        	Image::make($newsSmallImage)->fit(700,460)
        	->save(public_path("/uploads/articles/imgnewssmallimages/" . $smallImageName ));

            //Saves the filename to the database.
            $newNews->newsSmallImage = $smallImageName;
        }

        if($request->hasFile('newsImage')){
        	$newsImage = $request->file('newsImage');
        	$newsImageName = time() . "." . $newsSmallImage->getClientOriginalExtension();
        	Image::make($newsImage)->fit(850,450)
        	->save(public_path("/uploads/articles/imgnewsimages/" . $newsImageName ));
            $newNews->newsImage = $newsImageName;
        }

        if($request->hasFile('newsCover')){
        	$newsCover = $request->file('newsCover');
        	$newsCoverName = time() . "." . $newsSmallImage->getClientOriginalExtension();
        	Image::make($newsCover)->fit(1920,700)
        	->save(public_path("/uploads/articles/imgnewscovers/" . $newsCoverName ));
            $newNews->newsCover = $newsCoverName;
        }

    	$newNews->save();
    	return redirect()->route('home');

    }


    /****
    Het article dat geedit moet worden word opgehaalt, samen met alle newscatagories
    ****/
    public function editArticle($id){
        if(Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
        {
            $articleToUpdate = Newsarticles::find($id);
            $articleCatagories = Newscategories::all();

            return view('news/edit', array('articleToUpdate' => $articleToUpdate,
                                           'articleCatagories' => $articleCatagories));
        }else{
            return redirect()->route('home');
        }
    }

    /****
    Een title, catagory en content is required om een article te updaten, als er images bij de request zit word er gekeken of de huidige image niet het standaard image is zodat deze niet gedelete word.
    ****/
    public function updateArticle($id, Request $request){

        $this->validate($request, [
            'title' => 'required',
            'catagory' => 'required',
            'content' => 'required'
            ]);

        $articleToUpdate = Newsarticles::find($id);

    if($request->hasFile('newsSmallImage'))
    {

        $newsSmallImage = $request->file('newsSmallImage');
        $newSmallImgName = time() . ".jpg";
        Image::make($newsSmallImage)->fit(700,460)->save(public_path("/uploads/articles/imgnewssmallimages/" . $newSmallImgName ));

        if ($articleToUpdate->newsSmallImage != "defaultSmallNewsImage.jpg") 
        {
             $path = '/uploads/imgnewssmallimages/';
             $currentSmallImgName = $articleToUpdate->newsSmallImage;
             File::Delete(public_path("/uploads/articles/imgnewssmallimages/" . $currentSmallImgName) );
        }
        $articleToUpdate->newsSmallImage = $newSmallImgName;
    }

    if($request->hasFile('newsImage'))
    {
        $newsImage = $request->file('newsImage');
        $newNewsImageName = time() . ".jpg";
        Image::make($newsImage)->fit(850,450)->save(public_path("/uploads/articles/imgnewsimages/" . $newNewsImageName ));

        if ($articleToUpdate->newsImage != "defaultNewsImage.jpg") 
        {
             $path = '/uploads/imgnewsimages/';
             $currentnewsImageName = $articleToUpdate->newsImage;
             File::Delete(public_path("/uploads/articles/imgnewsimages/" . $currentnewsImageName) );
        }
        $articleToUpdate->newsImage = $newNewsImageName;
    }

    if($request->hasFile('newsCover'))
    {
        $newsCover = $request->file('newsCover');
        $newNewsCoverName = time() . ".jpg";
        Image::make($newsCover)->fit(1920,700)->save(public_path("/uploads/articles/imgnewscovers/" . $newNewsCoverName ));

        if ($articleToUpdate->newsCover != "defaultNewsCover.jpg") 
        {
             $path = '/uploads/imgnewscovers/';
             $currentNewsCoverName = $articleToUpdate->newsCover;
             File::Delete(public_path("/uploads/articles/imgnewscovers/" . $currentNewsCoverName) );
        }
        $articleToUpdate->newsCover = $newNewsCoverName;
    }

        $articleToUpdate->title = $request->title;
        $articleToUpdate->catagory = $request->catagory;
        $articleToUpdate->content = $request->content;
        $articleToUpdate->updated_at = Carbon::now();

        $articleToUpdate->save();

        return redirect()->route('showArticle', ['id' => $id]);

    }

}
