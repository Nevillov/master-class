<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\MasterClass;

class RegistrationController extends Controller
{
    public function confirm($id)
    {
        $mc = MasterClass::with('user', 'category')->findOrFail($id);

        return view('confirm', compact('mc'));
    }

    public function store($id)
    {
        $masterClass = MasterClass::findOrFail($id);

        $exists = Registration::where('user_id', auth()->id())
            ->where('master_class_id', $id)
            ->exists();

        if ($exists) {
            return redirect('/category/' . $masterClass->category_id)
                ->with('error', 'Вы уже записаны');
        }

        if ($masterClass->registrations()->count() >= $masterClass->max_people) {
            return redirect('/category/' . $masterClass->category_id)
                ->with('error', 'Нет свободных мест');
        }

        Registration::create([
            'user_id' => auth()->id(),
            'master_class_id' => $id
        ]);

        return redirect('/category/' . $masterClass->category_id)
            ->with('success', 'Вы успешно записались');
    }
}