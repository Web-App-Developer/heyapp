<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineRegistration extends Model
{
   use SoftDeletes;
   protected $fillable = [
   		'request_id',
         'register_type',
   		'full_name',
         'you_are',
   		'degree',
   		'learning_stream',
   		'master_name',
   		'year',
   		'group',
   		'email',
   		'telephone',
   		'request_type',
   		'request_file',
   		'message'
   ];

   public function get_transfer_by(){
      return $this->belongsTo('App\User', 'transfer_by', 'id')->withTrashed();
   }
}
