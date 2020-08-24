<?php

namespace App\Http\Controllers\Host;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Host
 */
class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        return view('host.profile')
            ->with('user', $user);
    }

    /**
     * @return View
     */
    public function editProfile()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        /** @var Collection $countries */
        $countries = Country::all();

        return view('host.edit-profile')
            ->with('user', $user)
            ->with('countries', $countries);
    }

    /**
     * @param EditProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(EditProfileRequest $request)
    {
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->country_id = $request->post('country');
        $user->city = $request->post('city');
        $user->address = $request->post('address');
        $user->phone_number = $request->post('phone');
        $user->save();

        return redirect()->route('host.profile');
    }

    /**
     * @return View
     */
    public function resetPassword()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        return view('host.reset-password')
            ->with('user', $user);
    }
}
