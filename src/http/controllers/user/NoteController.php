<?php

namespace Cryocaustik\SeatHr\http\controllers\user;

use Cryocaustik\SeatHr\models\SeatHrNote;
use Cryocaustik\SeatHr\models\SeatHrProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Seat\Eveapi\Models\Character\CharacterInfo;

class NoteController extends \Seat\Web\Http\Controllers\Controller
{
    public function index()
    {
        return view('seat-hr::user.note.index');
    }

    public function create(Request $request, CharacterInfo $character)
    {
        if($request->isMethod('post'))
        {
            $data = $request->only([
                'severity',
                'note',
            ]);

            $rules = [
                'severity' => ['required', 'in:info,warning,danger'],
                'note' => ['required'],
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $profile = SeatHrProfile::firstOrCreate([ 'user_id' => $character->user->id ]);
            $data['profile_id'] = $profile->id;
            $data['created_by'] = auth()->user()->id;

            SeatHrNote::create($data);

            return redirect()->route('seat-hr.profile.note', compact('character'))
                ->with('success', 'User note created successfully.');
        }

        return view('seat-hr::user.note.create');
    }

    public function edit(Request $request, CharacterInfo $character, SeatHrNote $note)
    {
        if($request->isMethod('post'))
        {
            $data = $request->only([
                'severity',
                'note',
            ]);
            $rules = [
                'severity' => ['required', 'in:info,warning,danger'],
                'note' => ['required'],
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $note->update($data);
            return view('seat-hr::user.note.index')->with('success', 'User note has been updated successfully.');

        }
        return view('seat-hr::user.note.edit', compact('note'));
    }

    public function delete(CharacterInfo $character, SeatHrNote $note)
    {
        $note->delete();

        return redirect()->back()->with('success', 'User note has been removed successfully.');
    }
}
