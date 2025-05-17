<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #3B82F6, #60A5FA);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #FACC15;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            font-weight: bold;
            animation: bounce 2s infinite;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        h1 {
            font-size: 48px;
            margin-top: 30px;
        }

        p {
            font-size: 18px;
            margin: 10px 0 30px;
        }

        a {
            background-color: #FACC15;
            color: #1E3A8A;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #eab308;
        }
    </style>
</head>
<body>

    <div class="circle">403</div>
    <h1>Akses Ditolak</h1>
    <p>Maaf, kamu tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ route('dashboard') }}">Kembali</a>


</body>
</html>
{{-- .. --}}