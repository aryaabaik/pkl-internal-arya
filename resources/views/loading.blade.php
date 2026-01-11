
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Loading...</title>

    <style>
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: white;
        }

        .loader {
            text-align: center;
        }

        .spinner {
            width: 64px;
            height: 64px;
            border: 6px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        h1 {
            margin-top: 20px;
            font-weight: 700;
            letter-spacing: .5px;
        }
    </style>

    <script>
        setTimeout(() => {
            window.location.href = "/";
        }, 1500);
    </script>
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
        <h1>SudiaShop</h1>
    </div>
</body>
</html>
