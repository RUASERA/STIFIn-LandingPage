<?php
session_start();
if (!isset($_SESSION['ClientLoggedIn']) || $_SESSION['ClientLoggedIn'] !== true) {
  header('Location: ./index.php');
  exit();
}

$type = $_SESSION['type'] ?? '';
$color = '#242033'; // default
switch ($type) {
  case 'Si':
  case 'Se': $color = '#8a1304'; break;
  case 'Ti':
  case 'Te': $color = '#797979'; break;
  case 'Ii':
  case 'Ie': $color = '#17447f'; break;
  case 'Fi':
  case 'Fe': $color = '#3A6F43'; break;
  case 'In': $color = '#aa8720'; break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>STIFIn Report | <?= htmlspecialchars($type) ?></title>
  <link rel="icon" type="image/png" href="./src/images/favicon_stifin.webp" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "<?= $color ?>",
            secondary: "#252426",
            yellow: "#F9E71C",
          },
        },
      },
    };
  </script>
</head>

<body class="font-body text-gray-800" style="background-color: <?= $color ?>10;">
  <!-- NAVBAR -->
  <nav class="bg-[<?= $color ?>] fixed top-0 left-0 right-0 z-50 shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-6 text-white">
      <div class="flex items-center gap-4">
        <img src="./src/images/logo_stifin.webp" class="w-24" alt="logo" />
        <img src="./src/images/logo_steps.png" class="w-24" alt="logo" />
      </div>
      <form method="POST" action="./app/controller/LoginController.php">
        <button type="submit" name="action" value="logout" class="bg-white text-[<?= $color ?>] px-4 py-2 rounded-full font-semibold hover:bg-gray-100 transition">
          Logout
        </button>
      </form>
    </div>
  </nav>

  <!-- HERO -->
  <section class="relative pt-24 bg-cover bg-center" style="background-image:url('./src/images/bg-hero.jpg')">
    <div class="absolute inset-0 bg-[<?= $color ?>]/95"></div>
    <div class="relative z-10 container mx-auto text-center py-24 text-white">
      <img src="./app/uploads/photos/clients/<?= htmlspecialchars($_SESSION['profile'] ?? 'default.png') ?>" 
           class="w-40 h-40 mx-auto rounded-full border-4 border-white object-cover mb-6" />
      <h1 class="text-4xl font-bold">Hallo <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>!</h1>
      <p class="mt-3 text-lg">Let’s see your test report!</p>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="bg-white py-16">
    <div class="container mx-auto flex flex-col lg:flex-row items-center">
      <div class="lg:w-1/2">
        <h2 class="text-4xl font-semibold text-[<?= $color ?>]">Your type is <?= htmlspecialchars($type) ?></h2>
        <p class="mt-4 text-gray-600 leading-relaxed">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
      </div>
      <div class="lg:w-1/2 mt-8 lg:mt-0 px-6">
        <div class="space-y-6">
          <div>
            <div class="flex justify-between">
              <span class="font-semibold">Lorem</span><span>85%</span>
            </div>
            <div class="w-full bg-gray-200 h-3 rounded-full">
              <div class="h-3 bg-[<?= $color ?>] rounded-full" style="width:85%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between">
              <span class="font-semibold">Ipsum</span><span>70%</span>
            </div>
            <div class="w-full bg-gray-200 h-3 rounded-full">
              <div class="h-3 bg-[<?= $color ?>] rounded-full" style="width:70%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto text-center">
      <h2 class="text-4xl font-bold text-[<?= $color ?>]">What you can be?</h2>
      <h3 class="mt-2 text-xl text-gray-700">Some recommendations for <?= htmlspecialchars($type) ?> like you!</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
        <div class="p-8 rounded-lg shadow hover:bg-[<?= $color ?>] hover:text-white transition">
          <img src="./src/images/icon-development-black.svg" class="mx-auto w-20" />
          <h4 class="mt-6 font-semibold text-lg">Web Development</h4>
          <p class="text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
        <div class="p-8 rounded-lg shadow hover:bg-[<?= $color ?>] hover:text-white transition">
          <img src="./src/images/icon-content-black.svg" class="mx-auto w-20" />
          <h4 class="mt-6 font-semibold text-lg">Technical Writing</h4>
          <p class="text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
        <div class="p-8 rounded-lg shadow hover:bg-[<?= $color ?>] hover:text-white transition">
          <img src="./src/images/icon-mobile-black.svg" class="mx-auto w-20" />
          <h4 class="mt-6 font-semibold text-lg">Mobile Development</h4>
          <p class="text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG -->
  <section class="bg-white py-16">
    <div class="container mx-auto text-center">
      <h2 class="text-4xl font-bold text-[<?= $color ?>]">A bit tips to improve yourself</h2>
      <h4 class="mt-2 text-gray-500">---Backlink can be placed here---</h4>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        <div class="shadow rounded overflow-hidden">
          <img src="./src/images/post-01.png" class="w-full h-56 object-cover" />
          <div class="p-6 text-left">
            <h3 class="font-semibold text-lg">How to become a frontend developer</h3>
            <p class="text-gray-500 text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="shadow rounded overflow-hidden">
          <img src="./src/images/post-02.png" class="w-full h-56 object-cover" />
          <div class="p-6 text-left">
            <h3 class="font-semibold text-lg">My personal productivity system</h3>
            <p class="text-gray-500 text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="shadow rounded overflow-hidden">
          <img src="./src/images/post-03.png" class="w-full h-56 object-cover" />
          <div class="p-6 text-left">
            <h3 class="font-semibold text-lg">My year in review 2020</h3>
            <p class="text-gray-500 text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-[<?= $color ?>] text-white py-6">
    <div class="container mx-auto flex flex-col sm:flex-row justify-between items-center text-center sm:text-left">
      <p>© Copyright 2025. All rights reserved, STEPS ID.</p>
      <div class="flex gap-4 mt-4 sm:mt-0">
        <a href="#"><i class="bx bxl-facebook-square text-2xl hover:text-yellow"></i></a>
        <a href="#"><i class="bx bxl-twitter text-2xl hover:text-yellow"></i></a>
        <a href="#"><i class="bx bxl-instagram text-2xl hover:text-yellow"></i></a>
      </div>
    </div>
  </footer>
</body>
</html>
