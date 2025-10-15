<?php
session_start();
if(isset($_SESSION['loggedIn']) == false){
        header('location: ./auth.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Simple Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

  <!-- NAVBAR -->
  <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <!-- Header kiri -->
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-500 rounded-lg"></div>
        <span class="text-lg font-semibold">MyDashboard</span>
      </div>

      <!-- Header tengah -->
      <div class="hidden md:flex items-center gap-6">
        <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
        <a href="./sert/" class="text-gray-600 hover:text-blue-600">Sertifikat</a>
        <a href="./operators/" class="text-gray-600 hover:text-blue-600">Dashboard Operators</a>
      </div>

      <!-- Header kanan -->
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
          <span class="text-sm font-medium">OR</span>
        </div>
        <a href="./logout.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
          Logout
        </a>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-24 container mx-auto px-6">
    <h1 class="text-2xl font-semibold mb-6">Welcome Back, <?=$_SESSION['name']?></h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card 1 -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2">Overview</h2>
        <p class="text-gray-600 text-sm">Quick summary of your dashboard metrics.</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2">Recent Activity</h2>
        <p class="text-gray-600 text-sm">Latest updates from your account.</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2">Performance</h2>
        <p class="text-gray-600 text-sm">Analytics of your recent performance trends.</p>
      </div>
    </div>
  </main>

</body>
</html>
