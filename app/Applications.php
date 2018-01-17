<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $fillable = ['questionOne', 
                           'questionTwo', 
                           'questionThree', 
                           'questionFour', 
                           'questionFive',
                           'questionSix', 
                           'questionSeven', 
                           'questionEight',
                           'questionNine', 
                           'questionTen', 
                           'questionEleven',
                           'questionTwelve', 
                           'questionThirteen', 
                           'questionFourteen',
                           'questionFifteen', 
                           'questionSixteen', 
                           'questionSeventeen',
                           'questionEighteen', 
                           'questionNineteen',
                           'questionTwenty'];

    public function getClass(){
    	return Classes::where('id', $this->questionThree)->first()->className;
    }
    public function getSpec(){
    	return Classspecs::where('id', $this->questionFour)->first()->spec;
    }
    public function getClassColor(){
        return Classes::where('id', $this->questionThree)->first()->classColor;
    }
    public function getStatus(){
    	return Applystat::where('id', $this->status)->first()->name;
    }
    public function getStatusColor(){
    	return Applystat::where('id', $this->status)->first()->statColor;
    }

    public function getUserName(){
        return User::where('id', $this->idUser)->first()->username;
    }

    public function getUserID(){
        return User::where('id', $this->idUser)->first()->id;
    }
}
