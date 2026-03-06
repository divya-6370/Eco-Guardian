<?php
    session_start();
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plastic Usage Tracker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; transition: background 0.3s, color 0.3s; }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f9fc;
      color: #222;
      animation: fadeIn 1s ease-in-out;
    }
    body.dark-mode {
      background: #1b1b1b;
      color: #eee;
    }

    @keyframes fadeIn { from {opacity:0;transform:translateY(10px);} to {opacity:1;transform:translateY(0);} }

    nav {
      background: linear-gradient(90deg, #33ccff, #0066cc);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      position: relative;
    }
    body.dark-mode nav {
      background: linear-gradient(90deg, #333, #111);
    }

    .nav-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo {
      font-size: 24px;
      font-weight: 600;
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .theme-toggle-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      margin-top: 4px;
    }

    .theme-switch {
      width: 50px;
      height: 24px;
      background: #fff;
      border-radius: 24px;
      cursor: pointer;
      box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
      position: relative;
    }
    .theme-switch::before {
      content: '';
      position: absolute;
      top: 2px;
      left: 2px;
      width: 20px;
      height: 20px;
      background: #33ccff;
      border-radius: 50%;
      transition: transform 0.3s, background 0.3s;
    }
    body.dark-mode .theme-switch::before {
      transform: translateX(26px);
      background: #ffcc00;
    }

    .theme-label {
      font-size: 10px;
      color: #fff;
      margin-top: 2px;
    }

    nav ul {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 17px;
      padding: 6px 10px;
      border-radius: 4px;
      position: relative;
    }
    nav ul li a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 2px;
      width: 0;
      background: white;
      transition: width 0.3s ease;
    }
    nav ul li a:hover::after { width: 100%; }
    nav ul li a:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }

    .menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
      margin-left: 15px;
    }
    .menu-toggle span {
      background: white;
      height: 3px;
      margin: 4px 0;
      width: 25px;
      border-radius: 2px;
    }

    @media (max-width: 768px) {
      .menu-toggle { display: flex; }
      nav ul {
        flex-direction: column;
        width: 100%;
        max-height: 0;
        overflow: hidden;
        background: inherit;
        transition: max-height 0.3s ease;
      }
      nav ul.show { max-height: 300px; padding: 10px 0; }
    }

    .content {
      padding: 20px;
      text-align: center;
    }
    .content h1 { font-size: 2.2rem; margin-bottom: 10px; }
    .content p { font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

    img {
      width: 100%;
      max-height: 70vh;
      object-fit: cover;
      display: block;
      margin: 0 auto;
      filter: brightness(1);
      transition: filter 0.3s;
    }
    body.dark-mode img { filter: brightness(0.8); }

    @media (max-width: 480px) {
      .logo { font-size: 20px; }
      nav ul li a { font-size: 15px; }
      .theme-switch { width: 45px; height: 22px; }
      .theme-switch::before { width: 18px; height: 18px; }
      .theme-label { font-size: 9px; }
      .content h1 { font-size: 1.8rem; }
      .content p { font-size: 1rem; }
    }
  </style>
</head>
<body>

<nav>
  <div class="nav-left">
    <div class="logo">🌍 EcoGuardian</div>
    <div class="theme-toggle-container">
      <div class="theme-switch" onclick="toggleTheme()" title="Toggle Light/Dark Mode"></div>
      <div class="theme-label">Light/Dark</div>
    </div>
  </div>
  <div class="menu-toggle" onclick="toggleMenu()">
    <span></span><span></span><span></span>
  </div>
  <ul id="menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="form.html">Tracker</a></li>
    <li><a href="article.html">Articles/Blogs</a></li>
    <li><a href="tips.html">Tips & Tricks</a></li>
    <?php if (isset($_SESSION['email'])): ?>
      <li><a href="#">👤 <?php echo htmlspecialchars($_SESSION['fname']); ?></a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="loginpage.php">Profile</a></li>
    <?php endif; ?>
  </ul>
</nav>

<img src="./i6.jpg" alt="Plastic Pollution">

<div class="content">
  <h1>Welcome, Climate Warrior</h1>
  <p>From Awareness to Action — Track. Reduce. Repeat.</p>
</div>

<script>
  function toggleMenu() {
    document.getElementById('menu').classList.toggle('show');
  }

  function applyTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }

  function toggleTheme() {
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }

  applyTheme();
</script>

</body>
</html>