<?php

namespace App\Http\Controllers;

use App\Http\Models\UserDetail;
use App\Http\Requests\UserDetailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class UserDetailController.
 *
 * @category Main
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class UserDetailController extends Controller
{
    /**
     * Return profile (user details).
     *
     * @return mixed
     */
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile()->get();


        if (count($profile) < 1) {
            Session::flash('message', 'Your profile is empty!');

            return redirect('account/profile/edit');
        } else {
            return view('account.profile.profile', compact('profile'));
        }
    }

    /**
     * Save profile details.
     *
     * @param UserDetailRequest $request profile request
     *
     * @return mixed
     */
    public function store(UserDetailRequest $request)
    {
        $profile = new  UserDetail();
        $profile->user_id = Auth::user()->id;
        $profile->profile_id = str_random(50);
        $profile->name = $request->name;
        $profile->dob = $request->dob;
        $profile->phone = $request->phone;
        $profile->pin = rand(pow(10, 5) - 1, pow(10, 6) - 1);
        $profile->save();

        if ($request->next_page) {
            return redirect('shop/check_out');
        }

        Session::flash('alert-success', 'Profile updated');

        return redirect('account/profile');
    }

    /**
     * Edit profile form.
     *
     * @return mixed
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile()->get();

        return view('account.profile.edit', compact('profile'));
    }

    /**
     * Update profile.
     *
     * @param UserDetailRequest $request profile request
     *
     * @return mixed
     */
    public function update(UserDetailRequest $request)
    {
        $id = UserDetail::GetId($request->profile_id);
        $profile = UserDetail::findorFail($id[0]->id);
        $profile->update($request->all());
        Session::flash('alert-success', 'Profile updated');

        return redirect('account/profile');
    }
}
