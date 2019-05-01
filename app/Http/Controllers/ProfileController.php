<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Contact;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee_contents/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        
        return view('employee_contents/editprofile')->with([

            'profile' => Profile::where('user_id', auth()->user()->id)->first(),
            'contact' => Contact::where('user_id', auth()->user()->id)->first(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $user = User::find(auth()->user()->id);
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        $contact = Contact::where('user_id', auth()->user()->id)->first();

        $user->email = $request->email;
        $user->save();

        if ($request->image)
            $profile->image = json_encode([
                'data' => 'data:' . $request->image->getMimeType() . ';base64,' . base64_encode(file_get_contents($request->image)),
                'path' => $request->image->getPathname(),
            ]);

        $profile->about = $request->about;
        $profile->save();

        $contact->address = $request->address;
        $contact->email = $user->email;
        $contact->mobile = $request->mobile;
        $contact->save();

        return redirect()->route('profile');
    }

    public function chpasswd(Request $request) {

        $request->validate([
            'current' => 'required',
            'newpasswd' => 'required',
            'repasswd' => 'required',
        ]);


        if (password_verify($request->current, auth()->user()->password)) {
            if ($request->newpasswd != $request->repasswd)
                return redirect()->route('profile')->withErrors([
                    'notmatch' => 'Password did not match',
                ]);

            $user = auth()->user();
            $user->password = bcrypt($request->newpasswd);
            $user->save();

            return redirect()->route('profile');
        }


        return redirect()->route('profile')->withErrors([
            'invalid-curpasswd' => 'Invalid current password',

        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
