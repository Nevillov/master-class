<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterClass;
use Illuminate\Http\Request;

class MasterClassController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'master') {
            abort(403);
        }

        $masterClasses = MasterClass::with('registrations.user')
            ->where('user_id', auth()->id())
            ->get();

        return view('cabinet', compact('masterClasses'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'master') {
            abort(403);
        }

        $categories = Category::all();

        $busy = MasterClass::all()
            ->groupBy('date')
            ->map(function ($items) {
                return $items->pluck('time')->toArray();
            });

        return view('form_master-class', compact('categories', 'busy'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'master') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'max_people' => 'required|integer|min:1|max:20',
            'price' => 'required|integer|min:0|max:10000',
        ]);

        $allowedTimes = ['09:00', '11:00', '13:00', '15:00'];

        if (! in_array($request->time, $allowedTimes)) {
            return back()->withErrors(['time' => 'Недопустимое время'])->withInput();
        }

        $exists = MasterClass::where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'Слот занят'])->withInput();
        }

        MasterClass::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'max_people' => $request->max_people,
            'price' => $request->price,
        ]);

        return redirect('/cabinet')->with('success', 'Мастер-класс добавлен');
    }

    public function edit($id)
    {
        $mc = MasterClass::findOrFail($id);

        if (auth()->user()->role !== 'master' || $mc->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('edit_master_class', compact('mc', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $mc = MasterClass::findOrFail($id);

        if (auth()->user()->role !== 'master' || $mc->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'max_people' => 'required|integer|min:1|max:20',
            'price' => 'required|integer|min:0|max:10000',
        ]);

        $allowedTimes = ['09:00', '11:00', '13:00', '15:00'];

        if (! in_array($request->time, $allowedTimes)) {
            return back()->withErrors(['time' => 'Недопустимое время'])->withInput();
        }

        $exists = MasterClass::where('date', $request->date)
            ->where('time', $request->time)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'Слот занят'])->withInput();
        }

        $mc->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'date' => $request->date,
            'time' => $request->time,
            'max_people' => $request->max_people,
            'price' => $request->price,
        ]);

        return redirect('/cabinet')->with('success', 'Обновлено');
    }

    public function destroy($id)
    {
        $mc = MasterClass::findOrFail($id);

        if (auth()->user()->role !== 'master' || $mc->user_id !== auth()->id()) {
            abort(403);
        }

        $mc->delete();

        return back()->with('success', 'Удалено');
    }
}
