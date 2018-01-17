<?php

namespace DevDojo\Chatter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use Auth;

class ChatterController extends Controller
{
    public function index($slug = ''){
    if (Auth::check()) 
        {
            if(Auth::user()->siteRole == "1" || Auth::user()->siteRole == "8" || Auth::user()->siteRole == "9")
            {
                return redirect('/home')->withErrors('Please wait for your application to be reviewed');
            }
            else{

        $pagination_results = config('chatter.paginate.num_of_results');

    	$discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);

    	if(isset($slug)){
    		$category = Category::where('slug', '=', $slug)->first();
    /***Deny Non Officer/Admin Access to Officer Posts ***/
        if(Auth::user()->siteRole !== "5" && Auth::user()->siteRole !== "6" && Auth::user()->siteRole !== "7"){
          if($slug == "gmc"){
          return redirect( config('chatter.routes.home') );
          }
        }
    		if(isset($category->id)){
    			$discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->where('chatter_category_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate($pagination_results);
    		} 
    		
    	}

    	$categories = Category::all();
    	return view('chatter::home', compact('discussions', 'categories'));
        }//END INNER ELSE
    }//ENDIF
    else{
        return redirect('/login')->withErrors('Please Login or Register first');
    }

    }

    public function login(){
    	if (!Auth::check())
		{
			return \Redirect::to('/' . config('chatter.routes.login') . '?redirect=' . config('chatter.routes.home'))->with('flash_message', 'Please create an account before posting.');
		}
    }

    public function register(){
        if (!Auth::check())
        {
            return \Redirect::to('/' . config('chatter.routes.register') . '?redirect=' . config('chatter.routes.home'))->with('flash_message', 'Please register for an account.');
        }
    }
}
