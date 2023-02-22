<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //

    public function contactPage()
    {
        return view('frontend.contact.contact');
    }

    public function contactInbox()
    {
        $contact = Contact::latest()->simplePaginate(2);
        $contacts = Contact::get();
        return view('frontend.contact.contactinbox', compact('contact', 'contacts'));
    }

    public function contactRead($id)
    {
        $contactread = Contact::find($id);

        $contactread->update([
            'readstatus' => 1,
        ]);
        return view('frontend.contact.contactread', compact('contactread'));
    }

    public function contactMessageSend(Request $request)
    {
        if (Auth::check()) {
            Contact::create([
                'user_id' => auth()->user()->id,
                'subject' => $request->subject,
                'priority' => $request->priority,
                'message' => $request->message
            ]);

            $notification = array(
                'message' => 'Message Sent Successfully',
                'alert-type' => 'success'
            );

            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Please login to send message',
                'alert-type' => 'info'
            );

            return redirect('login')->with($notification);
        }
    }

    public function deleteSelected(Request $request)
    {
        Contact::whereIn('id', $request->get('selected'))->delete();

        return response("Selected messages deleted successfully.", 200);
    }
}
