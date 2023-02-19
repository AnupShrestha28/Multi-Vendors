<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function contactPage()
    {
        return view('frontend.contact.contact');
    }

    public function contactInbox()
    {
        return view('frontend.contact.contactinbox');
    }

    public function contactRead()
    {
        return view('frontend.contact.contactread');
    }
}
