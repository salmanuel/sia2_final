<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() {
        return inertia('Admin/Email');
    }

    public function sendEmailToAll(Request $request)
    {
        $bookings = Booking::select('email', 'last_name', 'arrival_date', 'departure_date')->distinct()->get();

        if ($request->message != null && $request->subject != null) {
            $subject = $request->subject;
            $content = $request->message;

            foreach ($bookings as $booking) {
                $email = $booking->email;
                $last_name = $booking->last_name;
                $arrival_date = $booking->arrival_date;
                $departure_date = $booking->departure_date;

                Mail::send('emails.bulk-mail', ['content' => $content, 'user' => $last_name, 'arrival_date' => $arrival_date, 'departure_date' => $departure_date], function ($message) use ($booking, $email, $last_name, $arrival_date, $departure_date, $subject) {
                    $message->to($email, $last_name, $arrival_date, $departure_date);
                    $message->subject($subject);
                    // You can add any additional content to the email here.
                });
            }
        } else {
            $request->session()->flash('flash.banner', 'A field should not be empty');
            $request->session()->flash('flash.bannerStyle', 'danger');

            return back()->with('error', 'A field should not be empty');
        }

        $request->session()->flash('flash.banner', 'Emails sent successfully');
        $request->session()->flash('flash.bannerStyle', 'success');

        return back();
    }
}
