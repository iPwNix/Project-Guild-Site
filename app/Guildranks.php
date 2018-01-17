<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guildranks extends Model
{
    public function getGuildRank(){
    	return GuildRanks::where('id', $this->catagory)->first()->rank;
    }

    protected $fillable = [
        'rank', 'description',
    ];
}
