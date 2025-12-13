<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFormSubmition extends Model
{
    protected $table = 'contact_form_submissions';
      protected $fillable = [
        'fullname',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
