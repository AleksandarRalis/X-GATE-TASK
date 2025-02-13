<div class="container">
    <h1>Tasks</h1>

    @if($tasks->isEmpty())
        <p>No tasks available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project ID</th>
                    <th>Category ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody id="content">
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td>{{ $task->category->name }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->due_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<form action="{{ route('storeTasks') }}" method="POST">
    @csrf  <!-- CSRF token for security -->

    <div>
        <label for="project_id">Project</label>
        <select id="project_id" name="project_id" required>
            <option value="" disabled selected>Select a Project</option>
            
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <option value="" disabled selected>Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="title">Task Title</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div>
        <label for="description">Task Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <div>
        <label for="due_date">Due Date</label>
        <input type="date" id="due_date" name="due_date" required>
    </div>

    <div>
        <button type="submit">Create Task</button>
    </div>
</form>

<form action="{{ route('markCompleted') }}" method="POST">
    @csrf  <!-- CSRF token for security -->
    
    <div>
        <label for="mark completed">Mark Completed</label>
        <select id="mark_completed" name="task_id" required>
            <option value="" disabled selected>Select a Task</option>
            
            @foreach($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->title }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">Mark Completed</button>
    </div>
</form>

<h3>Filter Tasks</h3>
    <div>
        <label for="category_filter">Category</label>
        <select id="category_filter" name="category_filter">
            <option value="" disabled selected>Select Category (Optional)</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="status_filter">Status</label>
        <select id="status_filter" name="status_filter">
            <option value="" disabled selected>Select Status (Optional)</option>
            <option value="pending" {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <div>
        <button type="submit" id='filterButton'>Filter Tasks</button>
    </div>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    let filterButton = $('#filterButton');
    filterButton.click(function() {
    let category = $('#category_filter').val();
    let status = $('#status_filter').val();
    let content = $('#content');
    $.ajax({
        url: '{{ route('filterTasks', ['category_id' => '#category#', 'status' => '#status#']) }}'
        .replace('#category#', category).replace('#status#', status),
        type: "GET",
        success: function(data) {
            content.html('');
            // Loop through the response data and append each category to the select
            console.log(data)
            $.each(data, function(key, task) {
                content.append(`<tr>
                <td>${task.id}</td>
                <td>${task.project.name}</td>
                <td>${task.category.name}</td>
                <td>${task.title}</td>
                <td>${task.description}</td>
                <td>${task.status}</td>
                <td>${task.due_date}</td>
            </tr>`);
            });
        },
        error: function(xhr, status, error) {
            alert("An error occurred while loading categories.");
        }
    });
});


</script>
