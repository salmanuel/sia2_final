<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::orderBy('bed_type')->get();

        return inertia('Rooms/Index', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Rooms/Create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'bed_type'         => 'string|required',
            'rate'              =>   'numeric|required',
            'rooms_available'      => 'integer|required'
        ]);

        $fileName = null;

        if ($request->photo) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/photo'), $fileName);
            $fields['photo'] = $fileName;
        }

        Rooms::create($fields);

        // return redirect()->route('rooms')->banner('room added successfully.');
        return redirect()->route('rooms');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rooms $room)
    {
        $room->load('bookings');
        return inertia('Rooms/Show',[
            'room' => $room
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $room)
    {
        return inertia('Rooms/Edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rooms $room)
    {
        $request->validate([
            'bed_type'         => 'string|required',
            'rate'     => 'numeric|required',
            'rooms_available'      => 'numeric|required'
        ]);

        $room->update($request->all());

        $request->session()->flash('flash.banner', 'Room details updated.');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect('/rooms/' . $room->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $room)
    {
        $room->delete();
        return redirect()->route('rooms')->dangerBanner('Room removed from the list.');
    }

    public function search($searchKey)
    {
        return inertia('Rooms/Index', [
            'rooms' => Rooms::where('bed_type', 'like', "%$searchKey%")->
            orWhere('rate', 'like', "%$searchKey%")
            ->get()
        ]);
    }

    public function toggleActive(Rooms $room)
    {
        $room->available = !$room->available;
        $room->save();

        return back();
    }

    // public function email(Client $client) {
    //     $pdf = Pdf::loadView('pdf.client',[
    //         'client' => $client
    //     ]);

    //     $filename = 'statements/' . $client->last_name . "_" .$client->id . ".pdf";
    //     $pdf->save($filename);

    //     Mail::send('email.soa', ['client' =>$client], function($message) use($client, $filename){
    //         $message->to($client->email);
    //         $message->subject('Statement of Account');
    //         $message->attach($filename);
    //     });

    //     return back();
    // }
    public function email(Request $request, Rooms $room)
    {
        // Get all bookings associated with the room
        $bookings = $room->bookings;

        // Loop through the bookings and send emails
        foreach ($bookings as $booking) {
            $email = $booking->email;
            $last_name = $booking->last_name;
            $arrival_date = $booking->arrival_date;
            $departure_date = $booking->departure_date;

            // Add your email sending logic here using the $emailAddress.

            Mail::send('emails.mail', ['booking' => $booking, 'user' => $last_name, 'arrival_date' => $arrival_date, 'departure_date' => $departure_date], function ($message) use ($booking, $email, $last_name, $arrival_date, $departure_date) {
                $message->to($email, $last_name, $arrival_date, $departure_date);
                $message->subject('Your Booking Schedule');
                // You can add any additional content to the email here.
            });
        }

        $request->session()->flash('flash.banner', 'Email sent successfully');
        $request->session()->flash('flash.bannerStyle', 'success');

        return back();
    }
}
