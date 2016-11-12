<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Adformat;
use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdvertisementController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
            'adformat_id' => 'required|exists:adformats,id',
        ]);
        $adformat = Adformat::findOrFail($request->input('adformat_id'));
        $advertisement = new Advertisement();
        $advertisement->customer_id = $request->input('customer_id');
        $adformat->advertisements()->save($advertisement);
        return redirect()->route('issues.issue', $adformat->issue_id);
    }

    public function update(Request $request, $id)
    {
        // One can only update the adformat, not the issue or the customer
        $advertisement = Advertisement::findOrFail($id);
        $issue_id = $advertisement->adformat->issue_id;
        $this->validate($request, [
            'adformat_id' => [
                'required',
                Rule::exists('adformats', 'id')->where(function ($query) use ($issue_id) { $query->where('issue_id', $issue_id); }),
            ],
            'paid' => 'boolean|required',
        ]);
        $advertisement->update($request->only('adformat_id', 'paid'));
        return redirect()->route('issues.issue', $advertisement->adformat->issue_id);
    }

    public function delete($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $issue = $advertisement->adformat->issue;
        if ($advertisement->paid == true)
            return redirect()->route('issues.issue', $issue->id)->withErrors(['alert' => 'Eine bezahlte Anzeige kann nicht gelöscht werden.']);
        $advertisement->delete();
        return redirect()->route('issues.issue', $issue->id);
    }
}
