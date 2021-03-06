<?php

namespace App\Http\Controllers;

use App\Adformat;
use App\Customer;
use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll()
    {
        $issues = Issue::orderBy('created_at', 'desc')->get();
        return view('issues.index', ['issues' => $issues]);
    }

    public function show($id)
    {
        $issue = Issue::findOrFail($id);
        $customers = Customer::orderBy('name')->get();
        return view('issues.issue', ['issue' => $issue, 'customers' => $customers]);
    }

    public function showLatest()
    {
        $issue = Issue::orderBy('created_at', 'desc')->first();
        if ($issue === null)
            return view('issues.none');
        return redirect()->route('issues.issue', $issue->id);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|max:256|unique:issues',
            'due' => 'date|required',
        ]);
        $issue = Issue::create($request->only('name', 'due'));
        return redirect()->route('issues.issue', $issue->id);
    }

    public function update(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $this->validate($request, [
            'name' => [
                'string', 'required', 'max:256',
                Rule::unique('issues')->ignore($id),
            ],
            'due' => 'date|required',
        ]);
        $issue->update($request->only('name', 'due'));
        return redirect()->route('issues.issue', $issue->id);
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        if ($issue->advertisements()->count() > 0)
            return redirect()->route('issues.index')->withErrors(['alert' => 'Die Ausgabe kann nicht gelöscht werden, da sie Anzeigen enthält.']);
        Adformat::where('issue_id', $id)->delete();
        $issue->delete();
        return redirect()->route('issues.index');
    }
}
