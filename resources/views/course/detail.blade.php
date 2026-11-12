
<!DOCTYPE html>
<html>
<head>
    <title>Course Details</title>
</head>
<body>

    <h1>Course Details</h1>

    <p><strong>ID:</strong> {{ $course->id }}</p>

    <p><strong>Course Name:</strong> {{ $course->name }}</p>

    <p><strong>Description:</strong> {{ $course->description }}</p>

    <p><strong>Duration:</strong> {{ $course->duration }} weeks</p>

    <p><strong>Fee:</strong> {{ $course->fee }}</p>

    <p><strong>Difficulty:</strong> {{ $course->difficulty }}</p>

    <p>
        <strong>Active:</strong>
        {{ $course->is_active ? 'Yes' : 'No' }}
    </p>

    <br>

    <a href="/courses/{{ $course->id }}/edit">Edit Course</a>

    <br><br>

    <a href="/courses">Back to Courses</a>

</body>
</html>
