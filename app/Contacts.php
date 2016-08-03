<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model {

    //
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'phonetic_name',
        'nick_name',
        'photo',
        'mobile_no',
        'type',
        'phone',
        'email',
        'address',
        'date',
        'birthdate',
        'company',
        'title',
        'notes',
        'im',
        'sip',
        'group_name',
        'website',
        'relationship',
    ];

}
