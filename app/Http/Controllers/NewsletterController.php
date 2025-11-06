<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('newsletter_status', 'error');
        }

        try {
            NewsletterSubscriber::create([
                'email' => $request->email,
                'ip_address' => $request->ip(),
            ]);

            return back()->with('newsletter_status', 'success');
        } catch (\Exception $e) {
            \Log::error('Newsletter subscription error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('newsletter_status', 'error');
        }
    }
}
