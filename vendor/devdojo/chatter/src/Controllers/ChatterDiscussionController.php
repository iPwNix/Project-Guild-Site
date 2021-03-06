<?php

namespace DevDojo\Chatter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use DevDojo\Chatter\Models\Post;
use Auth;
use Carbon\Carbon;
use Validator;

class ChatterDiscussionController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $total = 10;
        $offset = 0;
        if($request->total){
            $total = $request->total;
        }
        if($request->offset){
            $offset = $request->offset;
        }
        $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'ASC')->take($total)->offset($offset)->get();
        return response()->json($discussions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
    	return view('chatter::discussion.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(array('body_content' => strip_tags($request->body)));

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'body_content' => 'required|min:10',
            'chatter_category_id' => 'required',
        ]);

        if(function_exists('chatter_before_new_discussion')){
          chatter_before_new_discussion($request, $validator);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user_id = Auth::user()->id;

        if(config('chatter.security.limit_time_between_posts')){

            if($this->notEnoughTimeBetweenDiscussion()){
                $minute_copy = (config('chatter.security.time_between_posts') == 1) ? ' minute' : ' minutes';
                $chatter_alert = array(
                    'chatter_alert_type' => 'danger',
                    'chatter_alert' => 'In order to prevent spam, Please allow at least ' . config('chatter.security.time_between_posts') . $minute_copy . ' inbetween submitting content.'
                    );
                return redirect('/' . config('chatter.routes.home'))->with($chatter_alert)->withInput();
            }
        }

        // *** Let's gaurantee that we always have a generic slug *** //
        $slug = str_slug($request->title, '-');

        $discussion_exists = Discussion::where('slug', '=', $slug)->first();
        $incrementer = 1;
        $new_slug = $slug;
        while(isset($discussion_exists->id)){
            $new_slug = $slug . '-' . $incrementer;
            $discussion_exists = Discussion::where('slug', '=', $new_slug)->first();
            $incrementer += 1;
        }

        if($slug != $new_slug){
            $slug = $new_slug;
        }

        $new_discussion = array(
            'title' => $request->title,
            'chatter_category_id' => $request->chatter_category_id,
            'user_id' => $user_id,
            'slug' => $slug,
            'color' => $request->color
            );

        $category = Category::find($request->chatter_category_id);
        if(!isset($category->slug)){
          $category = Category::first();
        }

        $discussion = Discussion::create($new_discussion);

        $new_post = array(
            'chatter_discussion_id' => $discussion->id,
            'user_id' => $user_id,
            'body' => $request->body
            );

        $post = Post::create($new_post);

        if($post->id){
            if(function_exists('chatter_after_new_discussion')){
              chatter_after_new_discussion($request);
            }
            $chatter_alert = array(
                'chatter_alert_type' => 'success',
                'chatter_alert' => 'Successfully created new ' . config('chatter.titles.discussion') . '.'
                );
            return redirect('/' . config('chatter.routes.home') . '/' . config('chatter.routes.discussion') . '/' . $category->slug . '/' . $slug)->with($chatter_alert);
        } else {
            $chatter_alert = array(
                'chatter_alert_type' => 'danger',
                'chatter_alert' => 'Whoops :( There seems to be a problem creating your ' . config('chatter.titles.discussion') . '.'
                );
            return redirect('/' . config('chatter.routes.home') . '/' . config('chatter.routes.discussion') . '/' . $category->slug . '/' . $slug)->with($chatter_alert);
        }

    }

    private function notEnoughTimeBetweenDiscussion(){
        $user = Auth::user();

        $past = Carbon::now()->subMinutes(config('chatter.security.time_between_posts'));

        $last_discussion = Discussion::where('user_id', '=', $user->id)->where('created_at', '>=', $past)->first();

        if(isset($last_discussion)){
            return true;
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug = null)
    {
      if(Auth::check())
      {
        if(Auth::user()->siteRole == "1" || Auth::user()->siteRole == "8" || Auth::user()->siteRole == "9"){
          return redirect('/home')->withErrors('Please wait for your application to be reviewed');
        }
        else{

        if(!isset($category) || !isset($slug)){
            return redirect( config('chatter.routes.home') );
        }

        /***Deny Non Officer/Admin Access to Officer Posts ***/
        if(Auth::user()->siteRole !== "5" && Auth::user()->siteRole !== "6" && Auth::user()->siteRole !== "7"){
          if($category == "gmc"){
          return redirect( config('chatter.routes.home') );
          }
        }



        $discussion = Discussion::where('slug', '=', $slug)->first();
        $discussion_category = Category::find($discussion->chatter_category_id);
        if($category != $discussion_category->slug){
            return redirect( config('chatter.routes.home') . '/' . config('chatter.routes.discussion') . '/' . $discussion_category->slug . '/' . $discussion->slug );
        }
        $posts = Post::with('user')->where('chatter_discussion_id', '=', $discussion->id)->orderBy('created_at', 'ASC')->paginate(10);
        return view('chatter::discussion', compact('discussion', 'posts'));
      }//1st ELSE
     }//1st IF
     else{
      return redirect('/login');
     }
    }

    public function lockThread($threadid)
    {
      $threadToUnlock = Discussion::find($threadid);
      $threadToUnlock->locked = 1;
      $threadToUnlock->save();

      return redirect()->back();
    }

    public function unlockThread($threadid)
    {
      $threadToUnlock = Discussion::find($threadid);
      $threadToUnlock->locked = 0;
      $threadToUnlock->save();

      return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sanitizeContent($content){
        libxml_use_internal_errors(true);
        // create a new DomDocument object
        $doc = new \DOMDocument();

        // load the HTML into the DomDocument object (this would be your source HTML)
        $doc->loadHTML($content);

        $this->removeElementsByTagName('script', $doc);
        $this->removeElementsByTagName('style', $doc);
        $this->removeElementsByTagName('link', $doc);

        // output cleaned html
        return $doc->saveHtml();
    }

    private function removeElementsByTagName($tagName, $document) {
      $nodeList = $document->getElementsByTagName($tagName);
      for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
        $node = $nodeList->item($nodeIdx);
        $node->parentNode->removeChild($node);
      }
    }

}
