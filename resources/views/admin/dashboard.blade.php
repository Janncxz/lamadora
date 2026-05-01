<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

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
            max-width: 650px; /* Slightly wider for admin content */
        }

        /* The Main Business Card */
        .dashboard-card {
            background: #ffffff; 
            border-radius: 8px; 
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
            line-height: 1.2;
        }

        .header small {
            text-transform: none;
            letter-spacing: normal;
            font-weight: 400;
            color: #666;
            display: block;
            margin-top: 4px;
        }

        .logout-btn {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 5px 15px;
            color: #666;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        /* Note Items */
        .note-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            transition: border-color 0.2s ease;
        }

        .note-card:hover {
            border-color: #000;
        }

        .note-title {
            font-weight: 700;
            font-size: 1rem;
            color: #000;
            margin-bottom: 5px;
            display: block;
        }

        .note-content {
            font-size: 0.95rem;
            color: #444;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .author-badge {
            display: inline-block;
            background: #f1f1f1;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.3px;
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
        
        <!-- Header Section -->
        <div class="header">
            <h5>
                {{ auth()->user()->name }} (Admin)
                <small>All notes and their authors</small>
            </h5>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <!-- Notes List -->
        @forelse($notes as $note)
            <div class="note-card">
                <span class="note-title">{{ $note->title }}</span>
                <p class="note-content">{{ $note->content }}</p>
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="author-badge">
                        Author: {{ $note->user->name }}
                    </span>
                    <!-- Optional: Add admin actions here if needed -->
                </div>
            </div>
        @empty
            <div class="empty-message">
                No notes have been created yet.
            </div>
        @endforelse

    </div>
</div>

</body>
</html>