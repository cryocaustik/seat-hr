<?php

namespace Cryocaustik\SeatHr\http\controllers\user;

use Cryocaustik\SeatHr\models\SeatHrApplication;
use Cryocaustik\SeatHr\models\SeatHrCorporation;
use Cryocaustik\SeatHr\models\SeatHrProfile;
use Seat\Eveapi\Models\Character\CharacterInfo;
use \Seat\Web\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        return view('seat-hr::user.applications.index');
    }

    public function view(CharacterInfo $character, SeatHrApplication $application)
    {
        return view('seat-hr::user.applications.view', ['application' => $application]);
    }

    public function apply(Request $request, CharacterInfo $character, SeatHrCorporation $corporation = null) {
        // POST, process submitted application
        if($request->isMethod('POST')) {
            if(!$corporation instanceof \Cryocaustik\SeatHr\models\SeatHrCorporation) {
                return redirect()->back()->withErrors('Invalid or missing corporation Id');
            }

            $available_questions = $corporation->questions()->active()->get();
            // because validator will literally reindex and overwrite your object keys if you use integers!!!
            $question_ids = array_map(
                fn($v): string => 'id-' . $v,
                $available_questions->pluck('question_id')->toArray()
            );

            $data = $request->only($question_ids);
            $rules = [];
            $attributes = [];

            foreach($available_questions as $q) {
                $id = 'id-'. $q->question_id;
                $type = $q->question->type;

                // validator does not have rules for type text
                if($type == 'text'){ $type = 'string'; }

                // validator does not have a rule for datetime specifically
                if($type == 'datetime') { $type = 'date'; }

                $rules[$id] = ['required', $type];
                $attributes[$id] = $q->question->name;
            }

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $profile = SeatHrProfile::firstOrCreate([ 'user_id' => $character->user->id ]);
            $application = SeatHrApplication::create([
                'corporation_id' => $corporation->id,
                'profile_id' => $profile->id,
                'can_reapply' => 0,
            ]);

            $answers = array_map(
                fn($v, $k): array => [
                    'question_id' => trim((string) $k, 'id-'),
                    'response' => $v,
                ],
                $data,
                array_keys($data)
            );
            $application->answers()->createMany($answers);
            $application->status()->create(['status_id' => 1, 'active' => 1]);

            return redirect()->route('seat-hr.profile.applications', ['character' => $character])->with('success', 'Application submitted successfully');
        }

        // no corporation specified, return list of recruiting corps
        if(!$corporation instanceof \Cryocaustik\SeatHr\models\SeatHrCorporation) {
            $recruiting_corps = SeatHrCorporation::recruiting()->get();
            return view('seat-hr::user.applications.apply', ['recruiting_corps' => $recruiting_corps]);
        }

        // corporation is specified, return active questions for target corp
        $corp_questions = $corporation->questions()->active()->get();

        return view('seat-hr::user.applications.apply', ['corporation' => $corporation, 'corp_questions' => $corp_questions]);
    }
}
