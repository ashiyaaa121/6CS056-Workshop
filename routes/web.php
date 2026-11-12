
<?php

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

// ==========================================
// HOME
// ==========================================

Route::get('/', function () {
    return view('welcome');
});


// ==========================================
// STUDENT CRUD
// ==========================================

// CREATE: Show student creation form
Route::get('/students/create', function () {
    return view('student.create');
});

// CREATE: Store new student
Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:students,email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect('/students')
        ->with('success', 'Student created successfully!');
});

// READ: Display all students
Route::get('/students', function () {
    $students = Student::all();

    return view('student.list', ['students' => $students]);
});

// READ: Display one student
Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.detail', ['student' => $student]);
});

// UPDATE: Show student edit form
Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.edit', ['student' => $student]);
});

// UPDATE: Save student changes
Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('students', 'email')->ignore($student->id),
        ],
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/students/' . $student->id)
        ->with('success', 'Student updated successfully!');
});

// DELETE: Remove student
Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);

    $student->delete();

    return redirect('/students')
        ->with('success', 'Student deleted successfully!');
});


// ==========================================
// COURSE CRUD
// ==========================================

// CREATE: Show course creation form
Route::get('/courses/create', function () {
    return view('course.create');
});

// CREATE: Store new course
Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
        'is_active' => 'sometimes|boolean',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    Course::create($validated);

    return redirect('/courses')
        ->with('success', 'Course created successfully!');
});

// READ: Display all courses
Route::get('/courses', function () {
    $courses = Course::all();

    return view('course.list', ['courses' => $courses]);
});

// READ: Display one course
Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.detail', ['course' => $course]);
});

// UPDATE: Show course edit form
Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.edit', ['course' => $course]);
});

// UPDATE: Save course changes
Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
        'is_active' => 'sometimes|boolean',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    $course->update($validated);

    return redirect('/courses')
        ->with('success', 'Course updated successfully!');
});

// DELETE: Remove course
Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    $course->delete();

    return redirect('/courses')
        ->with('success', 'Course deleted successfully!');
});
