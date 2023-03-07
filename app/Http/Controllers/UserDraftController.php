<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\UserDraft;

class UserDraftController extends Controller
{
    //
    public function removeFromDraft($id)
    {
        $draft = UserDraft::where('product_id', $id)->first();
        $draft->update([
            'isdeleted' => 1
        ]);


        $notification = array(
            'message' => 'Successfully Removed From recommended',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
