<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Dashboard | Lamadora</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa; /* Light gray background */
            display: flex;
            justify-content: center;
            padding: 60px 20px;
        }

        .dashboard-container {
            width: 100%;
            max-width: 550px;
        }

        /* The Main Business Card */
        .dashboard-card {
            background: #ffffff; 
            border-radius: 8px; /* Sharper corners for business look */
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 25px;
        }

        .header h5 {
            margin: 0;
            font-weight: 700;
            color: #000;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .logout-btn {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 5px 10px;
            color: #666;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        /* Professional Form Look */
        .note-form {
            background: #fdfdfd;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #f0f0f0;
            margin-bottom: 30px;
        }

        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #000;
            box-shadow: none;
        }

        .btn-black {
            background-color: #000;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            padding: 10px;
            transition: opacity 0.2s;
        }

        .btn-black:hover {
            color: #fff;
            opacity: 0.85;
        }

        /* Note Items */
        .note-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            transition: transform 0.2s ease;
        }

        .note-card:hover {
            border-color: #000;
        }

        .note-title {
            font-weight: 700;
            font-size: 1rem;
            color: #000;
            margin-bottom: 5px;
        }

        .note-content {
            font-size: 0.9rem;
            color: #444;
            line-height: 1.5;
        }

        /* Subtle Delete Link Style */
        .delete-link {
            background: none;
            border: none;
            color: #d9534f;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        .delete-link:hover {
            text-decoration: underline;
        }

        .empty-message {
            text-align: center;
            padding: 40px 0;
            color: #999;
            font-style: italic;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-card">

        <div class="header">
            <div>
                <h5><i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name }}</h5>
                
                <!-- 1. ADDED GREETING HERE -->
                <h6>
                    @php $user = auth()->user(); @endphp
                    @if($user->role == 1)
                        Hello, {{ $user->name }}, these are all the notes and their authors
                    @else
                        Hello, {{ $user->name }}
                    @endif
                </h6>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <i class="bi bi-power"></i>
                </button>
            </form>
        </div>

        <div class="note-form">
            <form method="POST" action="/notes">
                @csrf
                <div class="mb-2">
                    <input type="text" name="title" class="form-control" placeholder="Note Title" required>
                </div>
                <div class="mb-2">
                    <textarea name="content" class="form-control" rows="2" placeholder="Write your details..." required></textarea>
                </div>
                <button type="submit" class="btn btn-black w-100">Save Note</button>
            </form>
        </div>

        <div class="notes-wrapper">
            @if(isset($notes) && count($notes) > 0)
                @foreach($notes as $note)
                    <div class="note-card">
                        <div class="note-title">{{ $note->title }}</div>
                        <div class="note-content">{{ $note->content }}</div>

                        <!-- 2. ADDED AUTHOR TAG HERE -->
                        @if(auth()->user()->role == 1)
                            <small class="text-dark">
                                <strong>Author:</strong> {{ $note->user->name }}
                            </small>
                        @endif

                        <form method="POST" action="/notes/{{ $note->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-link">
                                <i class="bi bi-trash3 me-1"></i> Delete Record
                            </button>
                        </form>
                    </div>
                @endforeach
            @else
                <div class="empty-message">
                    <i class="bi bi-sticky d-block mb-2" style="font-size: 2rem;"></i>
                    No records found in your dashboard.
                </div>
            @endif
        </div>

    </div>
</div>

</body>
</html>