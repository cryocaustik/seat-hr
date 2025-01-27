<?php

namespace Cryocaustik\SeatHr\http\controllers\configuration;

use Cryocaustik\SeatHr\http\datatables\CorporationDataTable;
use Cryocaustik\SeatHr\models\SeatHrCorporation;
use Illuminate\Validation\Rule;
use Seat\Eveapi\Models\Corporation\CorporationInfo;
use \Seat\Web\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CorporationController extends Controller
{
    public function view(CorporationDataTable $dataTable)
    {
        return $dataTable->render('seat-hr::configuration.corporation.view');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'corporation_id' => [
                    'required',
                    'exists:corporation_infos',
                    Rule::unique('seat_hr_corporations'),
                ],
                'hr_head' => ['required', 'string'],
                'has_restricted_questions' => ['boolean'],
                'accepting_applications' => ['boolean'],
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            SeatHrCorporation::create($data);
            return redirect()->route('seat-hr.config.corp.view')
                ->with('success', 'Corporation added successfully.');
        }

        $available_corps = CorporationInfo::get(['corporation_id', 'name']);

        return view('seat-hr::configuration.corporation.create', ['available_corps' => $available_corps]);
    }

    public function edit(Request $request, $id)
    {
        $corporation = SeatHrCorporation::find($id);
        if (!$corporation) {
            return back()->withErrors('Invalid corporation ID');
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'corporation_id' => ['prohibited'],
                'hr_head' => ['required', 'string'],
                'has_restricted_questions' => ['boolean'],
                'accepting_applications' => ['boolean'],
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $corporation->fill($data);
            if(!$corporation->isDirty()){
                return redirect()->route('seat-hr.config.corp.view')
                    ->with('info', 'No changes found; corporation not updated.');
            }

            $corporation->save();
            return redirect()->route('seat-hr.config.corp.view')
                ->with('success', 'Corporation updated successfully.');
        }

        return view('seat-hr::configuration.corporation.edit', ['corporation' => $corporation]);
    }

    public function delete($id)
    {
        $corporation = SeatHrCorporation::find($id);
        if (!$corporation) {
            return back()->withErrors('Invalid corporation ID');
        }

        $corporation->delete();
        return back()->with('success', 'Corporation deleted successfully.');
    }
}
