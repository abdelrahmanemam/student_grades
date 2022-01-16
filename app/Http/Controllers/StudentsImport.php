<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;


class StudentsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return Student|null
     */
    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        $courses = array_slice(current($rows), 2);

        // Skip header
        array_shift($rows);

        foreach ($rows as $row) {
            $name = current($row);
            $names = explode(" ", $name);
            if (current($names) === "") array_shift($names);
            if (last($names) === "") array_pop($names);

            $firstName = current($names);
            $lastName = last($names);

            $studentData = Student::where('first_name', strtolower($firstName))
                ->where('last_name', strtolower($lastName))
                ->first();

            if (!$studentData)
                $studentData = Student::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'full_name' => $name
                ]);

            foreach ($courses as $key => $course) {
                Grade::create([
                    'student_id' => $studentData->id,
                    'student_number' => $row[1],
                    'course' => $course,
                    'grade' => $row[$key + 2]
                ]);
            }
        }
    }
}
