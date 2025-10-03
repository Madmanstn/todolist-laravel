<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>My Todo List</h1>
            <p>Stay organized and get things done!</p>
        </div>

        <!-- Add Form -->
        <div class="input-section">
            <form method="POST" action="{{ route('todos.store') }}">
                @csrf
                <div class="input-wrapper">
                    <textarea name="text" class="task-input" id="taskInput" placeholder="What do you need to accomplish today? Describe your task in detail..." maxlength="500" rows="4"></textarea>
                </div>
                <div class="input-footer">
                    <span class="char-counter" id="charCounter">0/500</span>
                    <button type="submit" class="add-btn" id="addBtn">Add Task</button>
                </div>
            </form>
        </div>

        <!-- Display Pending Tasks -->
        <div class="todo-section">
            <h2>
                <span class="section-icon pending-icon"></span>
                Pending Tasks
            </h2>
            <div id="pendingContainer">
                @foreach($todos->where('completed', false) as $todo)
                    <div class="todo-item">
                        <div class="todo-content">
                            <div class="todo-text">{{ $todo->text }}</div>
                            <div class="todo-date">Added {{ $todo->created_at->format('M j, Y \a\t g:i A') }}</div>
                        </div>
                        <div class="todo-actions">
                            <form method="POST" action="{{ route('todos.complete', $todo) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="action-btn complete-btn">Complete</button>
                            </form>
                            <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                @if($todos->where('completed', false)->count() === 0)
                    <div class="empty-state">
                        No pending tasks. Add your first task above!
                    </div>
                @endif
            </div>
        </div>

        <!-- Display Completed Tasks -->
        <div class="todo-section">
            <h2>
                <span class="section-icon complete-icon"></span>
                Completed Tasks
            </h2>
            <div id="completedContainer">
                @foreach($todos->where('completed', true) as $todo)
                    <div class="todo-item completed-task">
                        <div class="todo-content">
                            <div class="todo-text">{{ $todo->text }}</div>
                            <div class="todo-date">
                                Added {{ $todo->created_at->format('M j, Y \a\t g:i A') }} • 
                                Completed {{ $todo->completed_at->format('M j, Y \a\t g:i A') }}
                            </div>
                        </div>
                        <div class="todo-actions">
                            <form method="POST" action="{{ route('todos.undo', $todo) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="action-btn undo-btn">Undo</button>
                            </form>
                            <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                @if($todos->where('completed', true)->count() === 0)
                    <div class="empty-state">
                        No completed tasks yet. Complete some tasks to see them here!
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        const taskInput = document.getElementById('taskInput');
        const charCounter = document.getElementById('charCounter');
        const addBtn = document.getElementById('addBtn');

        // Character counter
        taskInput.addEventListener('input', () => {
            const length = taskInput.value.length;
            charCounter.textContent = `${length}/500`;
            
            if (length > 450) {
                charCounter.classList.add('warning');
            } else {
                charCounter.classList.remove('warning');
            }
            
            addBtn.disabled = length === 0 || length > 500;
        });

        // Initialize
        addBtn.disabled = true;
    </script>
</body>
</html>