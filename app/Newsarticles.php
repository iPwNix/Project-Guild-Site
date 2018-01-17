<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsarticles extends Model
{
    public function getCatagory(){
    	return Newscategories::where('id', $this->catagory)->first()->name;
    }
    public function getPostedBy(){
    	return User::where('id', $this->postedBy)->first()->username;
    }
    public function getPostedByAvatar(){
    	return User::where('id', $this->postedBy)->first()->useravatar;
    }
}
