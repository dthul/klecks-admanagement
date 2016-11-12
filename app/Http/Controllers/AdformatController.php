<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Adformat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdformatController extends Controller
{
    public function create(Request $request, $issue_id)
    {
        $issue = Issue::findOrFail($issue_id);
        $this->validate($request, [
            'name' => [
                'string', 'required', 'max:255',
                Rule::unique('adformats')->where(function ($query) { $query->where('issue_id', $issue_id); },
            ],
            'price' => 'integer|required|min:0|max:1000000',
        ]);
        $adformat = new Adformat($request->only('name', 'price'));
        $issue->adformats()->save($adformat);
        return redirect()->route('issues.issue', $issue_id);
    }

    public function update(Request $request, $id)
    {
        $adformat = Adformat::findOrFail($id);
        $this->validate($request, [
            'name' => [
                'string', 'required', 'max:255',
                Rule::unique('adformats')->ignore($id)->where(function ($query) { $query->where('issue_id', $adformat->issue_id); },
            ],
            'price' => 'integer|required|min:0|max:1000000',
        ]);
        $adformat->update($request->only('name', 'price'));
        $adformat->save();
        return redirect()->route('issues.issue', $adformat->issue_id);
    }

    public function delete($id)
    {
        $adformat = Adformat::findOrFail($id);
        if ($adformat->advertisements()->count() > 0)
            return redirect()->route('issues.issue', $adformat->issue_id)->withErrors(['alert' => 'Das Werbeformat kann nicht gelöscht werden, weil es verwendet wird.']);
        $adformat->delete();
        return redirect()->route('issues.issue', $adformat->issue_id);
    }
}
