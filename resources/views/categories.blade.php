<div class="container">
    <h1>Categories</h1>

    @if($categories->isEmpty())
        <p>No categories available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody id="content">
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<form action="{{ route('storeCategory') }}" method="POST">
    @csrf  
    <div>
        <label for="name">category Name</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <button type="submit">Create Category</button>
    </div>
</form>
