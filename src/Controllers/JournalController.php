<?php

namespace Robconvery\LaravelJournal\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robconvery\LaravelJournal\Journal;
use Robconvery\LaravelJournal\Requests\JournalRequest;

class JournalController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $Journals = Journal::all()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format("Y-m-d");
            });

        return view('laravel-journal::all', [
            'Journals' => $Journals
        ]);
    }

    /**
     * @param JournalRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JournalRequest $request, $id)
    {
        $Journal = Journal::findOrFail($id);
        $Journal->entry = $request->input('entry');
        $Journal->save();
        return redirect()->route('laravel-journal-entry', ['date' => $Journal->created_at->format("Y-m-d")]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $Journal = Journal::findOrFail($id);
        return view('laravel-journal::edit', [
            'journal' => $Journal
        ]);
    }

    /**
     * @param JournalRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(JournalRequest $request)
    {
        $Journal = Journal::create(['entry' => $request->input('entry')]);
        return redirect()->route('laravel-journal-entry', [
            'date' => $Journal->created_at->format('Y-m-d')
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        return view('laravel-journal::new');
    }

    /**
     * @param string $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function entry(string $date)
    {
        $journals = Journal::whereDate('created_at', $date)
            ->orderBy('created_at', 'DESC')
            ->get();
        if ($journals->isEmpty()) {
            abort(404);
        }

        return view('laravel-journal::entry', [
            'journals' => $journals
        ]);
    }
}
