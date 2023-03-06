<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\QuickReply;
use App\Models\ContactReply;
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
        $contact = Contact::latest()->simplePaginate(15);
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
                'ticketid' => '#' . rand(123456, 99999999),
                'user_id' => auth()->user()->id,
                'subject' => $request->subject,
                'priority' => $request->priority,
                'message' => $request->message
            ]);

            $notification = array(
                'alert-type' => 'success',
                'message' => 'Message Sent Successfully'
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

    public function addQuickReply(Request $request)
    {
        QuickReply::create([
            'quickreplytext' => $request->quickreplytext
        ]);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Quick Reply Added Successfully'
        );

        $quickreply = QuickReply::get();
        return view('frontend.contact.managequickreply', compact('quickreply'))->with($notification);
    }


    public function addQuickReplyView()
    {
        return view('frontend.contact.addquickreply');
    }


    public function manageQuickReply()
    {
        $quickreply = QuickReply::get();
        return view('frontend.contact.managequickreply', compact('quickreply'));
    }

    public function editQuickReply($id)
    {
        $quickreply = QuickReply::findOrFail($id);
        return view('frontend.contact.editQuickReply', compact('quickreply'));
    }

    public function updateQuickReply(Request $request)
    {
        QuickReply::findOrFail($request->id)->update([
            'quickreplytext' => $request->quickreplytext
        ]);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Quick Reply Edited Successfully'
        );
        return view('frontend.contact.managequickreply')->with($notification);
    }

    public function deleteQuickReply($id)
    {
        $quickreply = QuickReply::get();
        QuickReply::destroy($id);

        return view('frontend.contact.managequickreply', compact('quickreply'));
    }

    public function replySend(Request $request)
    {
        ContactReply::create([
            'contact_id' => $request->contactid,
            'reply_text' => $request->replyText
        ]);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Reply Sent Successfully'
        );
        return back()->with($notification);
    }
}
