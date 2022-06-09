<?php

namespace Cryocaustik\SeatHr\http\controllers\configuration;

use Cryocaustik\SeatHr\http\datatables\QuestionDataTable;
use Cryocaustik\SeatHr\models\SeatHrQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Seat\Web\Http\Controllers\Controller;


class QuestionController extends Controller
{
    public function view(QuestionDataTable $dataTable)
    {
        return $dataTable->render('seat-hr::configuration.question.view');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => ['required', 'min:2', 'max:500', 'unique:seat_hr_questions,name'],
                'type' => ['required', 'in:boolean,date,datetime,string,text'],
                'active' => ['boolean'],
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            SeatHrQuestion::create($data);
            return redirect()->route('seat-hr.config.question.view')
                ->with('success', 'Question created successfully.');
        }


        return view('seat-hr::configuration.question.create');
    }

    public function edit(Request $request, $id)
    {
        $question = SeatHrQuestion::find($id);
        if (!$question) {
            return back()->withErrors('Invalid question ID');
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => [
                    'required', 'min:2', 'max:500',
                    Rule::unique('seat_hr_questions')->ignore($question),
                ],
                'type' => ['required', 'in:boolean,date,datetime,string,text'],
                'active' => ['boolean'],
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->failed()) {
                return back()->withErrors($validator->errors());
            }

            $question->fill($data);
            if(!$question->isDirty())
            {
                return redirect()->route('seat-hr.config.question.view')
                    ->with('info', 'No changes found; question not updated.');
            }

            $question->save();
            return redirect()->route('seat-hr.config.question.view')->with('success', 'Question updated.');
        }

        return view('seat-hr::configuration.question.edit', compact('question'));
    }

    public function delete($id)
    {
        $question = SeatHrQuestion::find($id);
        if (!$question) {
            return back()->withErrors('Invalid question ID');
        }

        $question->delete();
        return back()->with('success', 'Question deleted successfully.');
    }
}
