
<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
</head>
<body>

    <h1>Edit Course</h1>

    @if($errors->any())
        <div>
            <h3>Please fix the following errors:</h3>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="/courses/{{ $course->id }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="name">Course Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $course->name) }}"
            >
        </div>

        <br>

        <div>
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
            >{{ old('description', $course->description) }}</textarea>
        </div>

        <br>

        <div>
            <label for="duration">Duration (Weeks)</label>

            <input
                type="number"
                id="duration"
                name="duration"
                value="{{ old('duration', $course->duration) }}"
            >
        </div>

        <br>

        <div>
            <label for="fee">Course Fee</label>

            <input
                type="number"
                step="0.01"
                id="fee"
                name="fee"
                value="{{ old('fee', $course->fee) }}"
            >
        </div>

        <br>

        <div>
            <label for="difficulty">Difficulty</label>

            <select id="difficulty" name="difficulty">
                <option value="Easy"
                    {{ old('difficulty', $course->difficulty) == 'Easy' ? 'selected' : '' }}>
                    Easy
                </option>

                <option value="Medium"
                    {{ old('difficulty', $course->difficulty) == 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="Hard"
                    {{ old('difficulty', $course->difficulty) == 'Hard' ? 'selected' : '' }}>
                    Hard
                </option>
            </select>
        </div>

        <br>

        <div>
            <label>
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $course->is_active))
                >
                Active Course
            </label>
        </div>

        <br>

        <button type="submit">
            Update Course
        </button>

    </form>

    <br>

    <a href="/courses">Back to Courses</a>

</body>
</html>
