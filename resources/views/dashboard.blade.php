<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notes Dashboard</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: #f4f6f9; 
    display: flex;
    justify-content: center;
    padding-top: 40px;
}

.dashboard-container {
    width: 100%;
    max-width: 500px;
    padding: 20px;
}

.dashboard-card {
    background: #add2d8; 
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,.1);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h5 {
    margin: 0;
    font-weight: 600;
}


.logout-btn {
    background: transparent;
    border: none;
    font-size: 22px;
    color: #2f4f54;
    cursor: pointer;
    transition: 0.2s ease;
}

.logout-btn:hover {
    color: #dc3545;
    transform: scale(1.15);
}

.note-form {
    background: rgba(255,255,255,0.6);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.note-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
}

.note-title {
    font-weight: 600;
    font-size: 0.95rem;
}

.note-content {
    font-size: 0.85rem;
    opacity: 0.8;
}

.btn-primary {
    background-color: #5a9ea8;
    border: none;
}

.btn-primary:hover {
    background-color: #4a8e97;
}

.empty-message {
    text-align: center;
    font-size: 0.9rem;
    opacity: 0.7;
}
</style>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-card">

      
        <div class="header">
            <h5>Hello, {{ auth()->user()->name }}</h5>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="note-form">
            <form method="POST" action="/notes">
                @csrf
                <div class="mb-2">
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                </div>
                <div class="mb-2">
                    <textarea name="content" class="form-control" rows="3" placeholder="Content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Note</button>
            </form>
        </div>

   
        @if(isset($notes) && count($notes) > 0)
            @foreach($notes as $note)
                <div class="note-card">
                    <div class="note-title">{{ $note->title }}</div>
                    <div class="note-content">{{ $note->content }}</div>

                    <form method="POST" action="/notes/{{ $note->id }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100">Delete</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="empty-message">No notes yet. Add one above!</div>
        @endif

    </div>
</div>

</body>
</html>