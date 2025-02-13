<div class="container">
    <h1>Projects</h1>

    @if($projects->isEmpty())
        <p>No projects available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody id="content">
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->due_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="form-group">
    <label for="due_date">Select Category</label>
    <select name="due_date" id="due_date" class="form-control">
        <option value="">-- Choose a category --</option>
        @foreach($dueDates as $dueDate)
            <option value="{{ $dueDate }}">{{ $dueDate }}</option>
        @endforeach
    </select>
</div>

<form action="{{ route('storeProject') }}" method="POST">
    @csrf  
    <div>
        <label for="name">Project Name</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="description">Project Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <div>
        <label for="due_date">Due Date</label>
        <input type="date" id="due_date" name="due_date" required>
    </div>

    <div>
        <button type="submit">Create Project</button>
    </div>
</form>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    let dueDateSelect = $('#due_date');
    dueDateSelect.change(function() {
    let dueDate = dueDateSelect.val();
    let content = $('#content');

    $.ajax({
        url: '{{ route('filterProjects', ['due_date' => 'dueDate']) }}'.replace('dueDate', dueDate),
        type: "GET",
        success: function(data) {
            content.html('');
            // Loop through the response data and append each category to the select
            $.each(data, function(key, category) {
                content.append(`<tr>
                <td>${category.id}</td>
                <td>${category.name}</td>
                <td>${category.description}</td>
                <td>${category.due_date}</td>
            </tr>`);
            });
        },
        error: function(xhr, status, error) {
            alert("An error occurred while loading categories.");
        }
    });
});


</script>
