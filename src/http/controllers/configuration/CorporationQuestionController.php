<?php

namespace Cryocaustik\SeatHr\http\controllers\configuration;


use Cryocaustik\SeatHr\http\datatables\CorporationQuestionDataTable;
use Cryocaustik\SeatHr\models\SeatHrAnswer;
use Cryocaustik\SeatHr\models\SeatHrCorporationQuestion;
use Cryocaustik\SeatHr\models\SeatHrQuestion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Seat\Web\Http\Controllers\Controller;


class CorporationQuestionController extends Controller
{
    public function view(CorporationQuestionDataTable $dataTable)
    {
        $available_questions = SeatHrQuestion::get(['id', 'name', 'type']);
        return $dataTable
            ->render('seat-hr::configuration.corporation_questions.view', ['available_questions' => $available_questions]);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $data['active'] = true;
        $rules = [
            'corporation_id' => [
                'required',
                'exists:seat_hr_corporations,id',
            ],
            'question_id' => [
                'required',
                'exists:seat_hr_questions,id',
                'unique:seat_hr_corporation_questions',
            ],
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        SeatHrCorporationQuestion::create($data);
        return back()->with('success', 'Question added successfully.');
    }

    public function toggle(Request $request)
    {
        $id = $request->get('id');
        $question = SeatHrCorporationQuestion::find($id);
        if (!$question) {
            return back()->withErrors('Invalid question ID');
        }

        $question->active = !(bool)$question->active;
        $question->save();

        return back()->with('success', 'Question updated successfully.');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $question = SeatHrCorporationQuestion::find($id);
        if (!$question) {
            return back()->withErrors('Invalid question ID');
        }

        $question_id = $question->question_id;
        $question->delete();

        // find and delete any answers associated with this corporation's question
        $answers = SeatHrAnswer::where('question_id', '=', $question_id);
        if ($answers->count() > 0) {
            $answers->delete();
        }
        return back()->with('success', 'Question deleted successfully.');
    }
}
