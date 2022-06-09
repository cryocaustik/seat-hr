<?php

namespace Cryocaustik\SeatHr\http\controllers\user;

use Cryocaustik\SeatHr\models\SeatHrBlacklist;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Cryocaustik\SeatHr\models\SeatHrProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BlackListController extends \Seat\Web\Http\Controllers\Controller
{
    public function index()
    {
        return view('seat-hr::user.blacklist.index');
    }

    public function create(Request $request, CharacterInfo $character)
    {
        if($request->isMethod('post'))
        {
            $data = $request->only([
                'blacklisted_by',
                'blacklisted_at',
                'reason',
            ]);

            $rules = [
                'blacklisted_by' => ['required'],
                'blacklisted_at' => ['required', 'date'],
                'reason' => ['required'],
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $profile = SeatHrProfile::firstOrCreate([ 'user_id' => $character->user->id ]);
            $data['profile_id'] = $profile->id;
            $data['created_by'] = auth()->user()->id;

            SeatHrBlacklist::create($data);

            return redirect()->route('seat-hr.profile.blacklist', compact('character'))
                ->with('success', 'User has been blacklisted');
        }

        return view('seat-hr::user.blacklist.create');
    }

    public function edit(Request $request, CharacterInfo $character, SeatHrBlacklist $blacklist)
    {
        if($request->isMethod('post'))
        {
            $data = $request->only([
                'blacklisted_by',
                'blacklisted_at',
                'reason',
            ]);
            $rules = [
                'blacklisted_by' => ['required'],
                'blacklisted_at' => ['required', 'date'],
                'reason' => ['required'],
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $blacklist->update($data);
            return view('seat-hr::user.blacklist.index')->with('success', 'Blacklist record has been updated');

        }
        return view('seat-hr::user.blacklist.edit', compact('blacklist'));
    }

    public function delete(CharacterInfo $character, SeatHrBlacklist $blacklist)
    {
        $blacklist->delete();
        return redirect()->back()->with('success', 'Record has been removed from the blacklist');
    }

}
