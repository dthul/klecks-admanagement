<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Adformat;
use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
            'adformat_id' => 'required|exists:adformats,id',
            'page' => 'nullable|integer|min:0',
            'comment' => 'nullable|string|max:10000',
        ]);
        $adformat = Adformat::findOrFail($request->input('adformat_id'));
        $advertisement = new Advertisement();
        $advertisement->customer_id = $request->input('customer_id');
        $advertisement->comment = $request->input('comment');
        $page = $request->input('page', null); 
        $advertisement->page = ($page === '') ? null : $page; 
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
            'page' => 'nullable|integer|min:0',
            'comment' => 'nullable|string|max:10000',
        ]);
        print('page: '.$request->input('page'));
        $advertisement->adformat_id = $request->input('adformat_id');
        $advertisement->paid = $request->input('paid');
        $advertisement->comment = $request->input('comment');
        $page = $request->input('page', null); 
        $advertisement->page = ($page === '') ? null : $page; 
        $advertisement->save();
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
