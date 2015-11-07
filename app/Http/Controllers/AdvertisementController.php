<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function create(Request $request, $issue_id)
    {
        /*$issue = Issue::findOrFail($issue_id);
        $this->validate($request, [
            'name' => 'string|required|max:255',
            'price' => 'integer|required|max:1000000',
        ]);
        $adformat = new Adformat($request->all());
        $issue->adformats()->save($adformat);
        return redirect()->route('issues.issue', $issue->id);*/
    }

    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        /*$this->validate($request, [
            'name' => 'string|required|max:255',
            'price' => 'integer|required|max:1000000',
        ]);
        $adformat->update($request->all());
        $adformat->save();
        return redirect()->route('issues.issue', $adformat->issue->id);*/
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
