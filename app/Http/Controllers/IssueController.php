<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    private $validation_rules = [
        'name' => 'string|required|max:256',
        'due' => 'date|required'
    ];

    public function showAll()
    {
        $issues = Issue::orderBy('created_at', 'desc')->get();
        return view('issues.index', ['issues' => $issues]);
    }

    public function show($id)
    {
        $issue = Issue::findOrFail($id);
        return view('issues.issue', ['issue' => $issue]);
    }

    public function showLatest()
    {
        $issue = Issue::orderBy('created_at', 'desc')->first();
        if ($issue === null)
            return view('issues.none');
        return view('issues.issue', ['issue' => $issue]);
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->validation_rules);
        $issue = Issue::create($request->all());
        return redirect()->route('issues.issue', $issue->id);
    }

    public function update(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $this->validate($request, $this->validation_rules);
        $issue->update($request->all());
        $issue->save();
        return redirect()->route('issues.issue', $issue->id);
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        if ($issue->advertisements()->count() > 0)
            return redirect()->route('issues.index')->withErrors(['alert' => 'Die Ausgabe kann nicht gelöscht werden, da sie Anzeigen enthält.']);
        $issue->delete();
        return redirect()->route('issues.index');
    }
}
