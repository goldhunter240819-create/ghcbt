<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GHCBT | Under Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, #1e293b 0%, #0f172a 100%);
            font-family: 'Outfit', sans-serif;
            color: white;
            overflow: hidden;
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 10;
        }

        .icon-box {
            font-size: 80px;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #fbd38d 0%, #f6ad55 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 0px rgba(251, 211, 141, 0)); }
            50% { transform: scale(1.05); filter: drop-shadow(0 0 20px rgba(251, 211, 141, 0.4)); }
        }

        h1 {
            font-size: 42px;
            font-weight: 800;
            margin: 0 0 20px 0;
            letter-spacing: -1px;
        }

        p {
            font-size: 18px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .loader-wrapper {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .dot {
            width: 12px;
            height: 12px;
            background: #fbd38d;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .dot:nth-child(1) { animation-delay: -0.32s; }
        .dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1.0); }
        }

        .footer {
            font-size: 14px;
            color: #475569;
            margin-top: 20px;
        }

        .bg-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(251, 211, 141, 0.1) 0%, rgba(251, 211, 141, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="container">
        <div class="icon-box">
            <i class="fas fa-screwdriver-wrench"></i>
        </div>
        <h1>System Lockdown</h1>
        <p>GHCBT Engine is currently undergoing scheduled maintenance. We're tuning the gears to provide you with a faster and more secure experience. Please check back shortly.</p>
        
        <div class="loader-wrapper">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div class="footer">
            &copy; 2026 Gold Hunter CBT Platform
        </div>
    </div>
</body>
</html>
