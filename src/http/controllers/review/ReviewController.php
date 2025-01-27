<?php

namespace Cryocaustik\SeatHr\http\controllers\review;

use Cryocaustik\SeatHr\http\datatables\ApplicationReviewDataTable;
use Cryocaustik\SeatHr\models\SeatHrApplication;
use Cryocaustik\SeatHr\models\SeatHrCorporation;

class ReviewController extends \Seat\Web\Http\Controllers\Controller
{
    public function index($corporation = null)
    {
        if (!$corporation) {
            $corporation = SeatHrCorporation::first();
        }
        if (!$corporation) {
            return redirect()->route('seat-hr.config.corp.view')
                ->withErrors('No corporations configured; please configure at least one corporation.');
        }

        return redirect()->route('seat-hr.review.summary', ['corporation' => $corporation]);
    }

    public function summary(SeatHrCorporation $corporation)
    {
        return view('seat-hr::review.summary', ['corporation' => $corporation]);
    }

    public function applications(SeatHrCorporation $corporation, ApplicationReviewDataTable $dataTable)
    {
        return $dataTable->with(['id' => $corporation->id])
            ->render('seat-hr::review.applications', ['corporation' => $corporation]);
    }

    public function application_review(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        if($application->currentStatus->status_id === 2) {
            return redirect()->back()->withErrors('Application is already in review.');
        }
        $application->status()->update(['active' => false]);
        $application->status()->create([
            'status_id' => 2,
            'active' => true,
            'assigned_to' => auth()->user()->id,
            'assigned_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Application review started.');
    }

    public function application_approve(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        if($application->currentStatus->status_id === 3) {
            return redirect()->back()->withErrors('Application is already approved.');
        }
        $application->status()->update(['active' => false]);
        $application->status()->create([
            'status_id' => 3,
            'active' => true,
            'assigned_to' => auth()->user()->id,
            'assigned_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Application approved.');
    }

    public function application_cancel(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        if($application->currentStatus->status_id === 4) {
            return redirect()->back()->withErrors('Application is already cancelled.');
        }
        $application->status()->update(['active' => false]);
        $application->status()->create([
            'status_id' => 4,
            'active' => true,
            'assigned_to' => auth()->user()->id,
            'assigned_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Application approved.');
    }

    public function application_reject(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        if($application->currentStatus->status_id === 5) {
            return redirect()->back()->withErrors('Application is already rejected.');
        }
        $application->status()->update(['active' => false]);
        $application->status()->create([
            'status_id' => 5,
            'active' => true,
            'assigned_to' => auth()->user()->id,
            'assigned_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Application rejected.');
    }

    public function application_toggle_reapply(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        if($application->currentStatus->status_id < 3) {
            return redirect()->back()->withErrors('Application needs to have a decision before allowing to re-apply.');
        }

        $application->update(['can_reapply' => !$application->can_reapply]);

        return redirect()->back()->with('success', 'Application re-apply toggled.');
    }

    public function application_delete(SeatHrCorporation $corporation, SeatHrApplication $application)
    {
        $application->delete();
        return redirect()->back()->with('success', 'Application deleted.');
    }
}
