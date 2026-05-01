<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lamadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Container to stack the Weather and Login vertically */
        .main-wrapper {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 15px; /* Space between weather and login card */
        }

        .auth-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        /* Weather Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.4s ease;
        }

        /* Weather Typography */
        #weather h5 {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin: 0;
        }

        .temp-val {
            font-size: 2.2rem;
            font-weight: 800;
            color: #111;
        }

        .unit {
            font-size: 1rem;
            vertical-align: super;
            font-weight: 400;
        }

        .weather-desc {
            font-size: 0.85rem;
            color: #666;
            text-transform: capitalize;
        }

        /* Dynamic Weather Theme Colors */
        .glass-card.clear { background: rgba(255, 243, 205, 0.7); border-color: rgba(255, 193, 7, 0.2); }
        .glass-card.clouds { background: rgba(233, 236, 239, 0.7); }
        .glass-card.rain { background: rgba(209, 231, 221, 0.7); }

        /* Rest of your login styles... */
        .brand-logo { font-weight: 800; font-size: 1.5rem; letter-spacing: -1px; text-transform: uppercase; text-align: center; display: block; margin-bottom: 20px;}
        .form-label { font-size: 0.85rem; font-weight: 600; color: #333; }
        .btn-business { background-color: #000; color: #fff; border: none; padding: 12px; font-weight: 600; width: 100%; border-radius: 6px; }
        .divider { height: 1px; background: #eee; margin: 25px 0; }
    </style>
</head>
<body>

    <div class="main-wrapper">
        
        <div class="glass-card shadow-sm">
            <div id="weather">
                @if(isset($weather))
                    <h5>{{ $weather['city'] }}</h5>
                    <div class="temp-val">{{ round($weather['temp']) }}<span class="unit">°C</span></div>
                    <div class="weather-desc">{{ $weather['description'] }}</div>
                @else
                    <div class="text-muted small">Loading local weather...</div>
                @endif
            </div>
        </div>

        <div class="auth-card">
            <span class="brand-logo">LOGIN</span>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-business">Sign In</button>

                <div class="divider"></div>

                <div class="text-center">
                    <span class="text-muted small">Do you want to register?</span> <br>
                    <a href="{{ route('register') }}" class="footer-link fw-bold text-dark text-decoration-none small">Create an account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    async function loadWeather() {
        try {
            const res = await fetch('/weather');
            const data = await res.json();
            const card = document.querySelector('.glass-card');

            // Set the background class based on weather condition
            const mainWeather = data.weather[0].main.toLowerCase();
            card.className = `glass-card shadow-sm ${mainWeather}`;

            document.getElementById('weather').innerHTML = `
                <h5>${data.name}</h5>
                <div class="temp-val">${Math.round(data.main.temp)}<span class="unit">°C</span></div>
                <div class="weather-desc">${data.weather[0].description}</div>
            `;
        } catch (error) {
            console.error("Weather load failed", error);
        }
    }

    loadWeather();
    setInterval(loadWeather, 600000); // Updated to 10 mins to be polite to the API
    </script>
</body>
</html>