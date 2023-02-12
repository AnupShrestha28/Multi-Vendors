<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{

    public function subscription(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            $subscriberCount = Subscription::where('email', $data['subscriber_email'])->count();
            if ($subscriberCount > 0) {
                return "exists";
            } else {
                //
                $subscribe = new Subscription;
                $subscribe->email = $data['subscriber_email'];
                $subscribe->status = 1;
                $subscribe->save();
                $this->emailsend($data['subscriber_email']);
                return "saved";
            }
        }
    }

    private function emailsend($email)
    {
        Mail::to($email)->send(new SubscriptionMail);
    }
}
