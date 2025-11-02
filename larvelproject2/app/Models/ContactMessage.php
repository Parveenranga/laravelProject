<?php

// app/Models/ContactMessage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages'; // explicitly name the table
    protected $fillable = ['name', 'email', 'message'];
    public $timestamps = true; // true if table has created_at & updated_at
}
