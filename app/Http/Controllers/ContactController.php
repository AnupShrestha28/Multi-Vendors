<?php

namespace App\Http\Controllers;

use App\Mail\sendMailAllSubscriber;
use App\Models\Contact;
use App\Models\QuickReply;
use App\Models\ContactReply;
use App\Models\User;
use App\Notifications\contactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
            $user = User::where('role', 'admin')->get();

            $notification = array(
                'alert-type' => 'success',
                'message' => 'Message Sent Successfully'
            );
            Notification::send($user, new contactNotification($request->subject));



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
        $quickreply = QuickReply::get();

        QuickReply::findOrFail($request->id)->update([
            'quickreplytext' => $request->quickreplytext
        ]);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Quick Reply Edited Successfully'
        );
        return view('frontend.contact.managequickreply', compact('quickreply'))->with($notification);
    }

    public function deleteQuickReply($id)
    {
        $quickreply = QuickReply::get();
        QuickReply::destroy($id);

        return view('frontend.contact.managequickreply', compact('quickreply'));
    }

    public function replySend(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();

            ContactReply::create([
                'contact_id' => $data['contactid'],
                'reply_text' => $data['quickreplytext']
            ]);
            $useremail = Contact::where('id', $data['contactid'])->first();

            Mail::to($useremail->user->email)->send(new sendMailAllSubscriber('Reply To TicketID ' . $useremail->ticketid, $data['quickreplytext']));

            return 'sent';
        }
        ContactReply::create([
            'contact_id' => $request->contactid,
            'reply_text' => $request->replyText
        ]);
        $useremail = Contact::where('id', $request->contactid)->first();

        Mail::to($useremail->user->email)->send(new sendMailAllSubscriber('Reply To TicketID ' . $useremail->ticketid, $request->replyText));



        $notification = array(
            'message' => 'Reply Sent Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
