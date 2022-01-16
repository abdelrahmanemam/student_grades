<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Grade::with('student')
                ->get()
                ->map(function ($item){
                    return [
                        'id' => $item->student_number,
                        'course' => $item->course,
                        'grade' => $item->grade,
                        'full_name' => $item->student->full_name,
                        'email' => $item->student->email
                    ];
                });
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function studentStore(StudentRequest $request)
    {
        $fullName = $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->last_name;

        Student::Create([
            'first_name' => strtolower($request->first_name),
            'last_name' => strtolower($request->last_name),
            'full_name' => strtolower($fullName),
            'email' => $request->email,
        ]);

        return redirect()->route('/');
    }

    public function gradeStore(Request $request)
    {
        $rules = [
            'grades' => 'required|file',
        ];

        $validator = Validator::make($request->toArray(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator);
        } else {
            try {
                Excel::import(new StudentsImport, request()->file('grades'));
                \Session::flash('success', 'Users uploaded successfully.');
                return redirect(route('/'));
            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return redirect(route('/'));
            }
        }
    }
}
