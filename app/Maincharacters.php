<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maincharacters extends Model
{
    public function getClass(){
    	return Classes::where('id', $this->classID)->first()->className;
    }
    public function getSpec(){
    	return Classspecs::where('id', $this->classSpecID)->first()->spec;
    }
    
    /**** ROLE ****/
    public function getRole(){
    	return Classroles::where('id', $this->classRoleID)->first()->classRole;
    }
    public function getRoleRGBAColorOne()
    {
        return Classroles::where('id', $this->classRoleID)->first()->RGBAColorOne;
    }
    public function getRoleRGBAColorTwo()
    {
        return Classroles::where('id', $this->classRoleID)->first()->RGBAColorTwo;
    }
    public function getRoleRGBAColorThree()
    {
        return Classroles::where('id', $this->classRoleID)->first()->RGBAColorThree;
    }
    public function getVertiRoleBanner()
    {
        return Classroles::where('id', $this->classRoleID)->first()->roleBannerVerti;
    }
    public function getHoriRoleBanner()
    {
        return Classroles::where('id', $this->classRoleID)->first()->roleBannerHori;
    }
    /**** ROLE ****/

    public function getClassColor(){
    	return Classes::where('id', $this->classID)->first()->classColor;
    }
    public function getClassRGBAColorOne()
    {
        return Classes::where('id', $this->classID)->first()->RGBAColorOne;
    }
    public function getClassRGBAColorTwo()
    {
        return Classes::where('id', $this->classID)->first()->RGBAColorTwo;
    }
    public function getClassRGBAColorThree()
    {
        return Classes::where('id', $this->classID)->first()->RGBAColorThree;
    }
    public function getVertiClassBanner()
    {
        return Classes::where('id', $this->classID)->first()->classBannerVerti;
    }
    public function getHoriClassBanner()
    {
        return Classes::where('id', $this->classID)->first()->classBannerHori;
    }
}
