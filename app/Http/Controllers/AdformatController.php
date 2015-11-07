<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Adformat;
use Illuminate\Http\Request;

class AdformatController extends Controller
{
    private $validation_rules = [
        'name' => 'string|required|max:255',
        'price' => 'integer|required|max:1000000',
    ];

    public function create(Request $request, $issue_id)
    {
        $issue = Issue::findOrFail($issue_id);
        $this->validate($request, $this->validation_rules);
        $adformat = new Adformat($request->all());
        $issue->adformats()->save($adformat);
        return redirect()->route('issues.issue', $issue->id);
    }

    public function update(Request $request, $id)
    {
        $adformat = Adformat::findOrFail($id);
        $this->validate($request, $this->validation_rules);
        $adformat->update($request->all());
        $adformat->save();
        return redirect()->route('issues.issue', $adformat->issue->id);
    }

    public function delete($id)
    {
        $adformat = Adformat::findOrFail($id);
        $issue = $adformat->issue;
        if ($adformat->advertisements()->count() > 0)
            return redirect()->route('issues.issue', $issue->id)->withErrors(['alert' => 'Das Werbeformat kann nicht gelöscht werden, weil es verwendet wird.']);
        $adformat->delete();
        return redirect()->route('issues.issue', $issue->id);
    }
}
