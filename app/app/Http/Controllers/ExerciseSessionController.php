<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Category;

use App\Models\Problem;

class ExerciseSessionController extends Controller
{
    private function save() {
        return Redirect::route('dashboard');
    }

    private function cancel() {

    }

    private function reset() {

    }

    public function select() {
        return Inertia::render('Exercise/Select');
    }
    
    public function settings(Request $request) {
        $selected = $request->input('selected', '');
        switch ($selected) {
            case 'practice':
                $categories = Category::all();
                return Inertia::render('Exercise/Practice/Settings', [
                    'selected' => $selected,
                    'categories' => $categories
                ]);

                case 'assestment':
                    return Inertia::render('Exercise/Assestment/Settings', [
                        'selected' => $selected
                    ]);

                case 'standard':
                    $categories = Category::all();
                    return Inertia::render('Exercise/Practice/Settings', [
                        'selected' => $selected,
                        'categories' => $categories
                ]);
        }
        return Redirect::route('exercise.select');

    }

    public function create(Request $request) {
        dd($request);
        $selected = $request->input('selected');

        $query =  [
            'type' => $selected,
            'id' => '1'
        ];

        $problem_set = Problem::all();

        return redirect()->route('exercise.start', $query);
    }
    
    public function start(Request $request) {
        $id = $request->query('id');
        $selected = $request->query('type');
        $problem_set = Problem::all();
        return Inertia::render('Exercise/Start', [
            'problemSet' => $problem_set,
            'selected' => $selected,
            'id' => $id
        ]);

    }

    public function summary(Request $request) {
        $summary = $request->input('summary');
        return Inertia::render('Exercise/Summary');

    }

    public function end() {

    }

    
}
