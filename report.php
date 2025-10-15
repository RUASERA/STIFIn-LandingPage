<?php
session_start();
if (!isset($_SESSION['ClientLoggedIn']) == True) {
  header('location: ./index.php');
  exit();
}
?>

<!DOCTYPE html>
<!-- saved from url=(0032)https://atom.redpixelthemes.com/ -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

  <title>STIFIn Report | <?= $_SESSION['type'] ?></title>

  <meta property="og:title" content="Your Stifin Report">

  <meta property="og:locale" content="en_US">

  <!-- <meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."> -->

  <link rel="icon" type="image/png" href="./src/images/favicon_stifin.webp">

  <meta name="theme-color" content="#5540af">

  <link crossorigin="crossorigin" href="https://fonts.gstatic.com" rel="preconnect" />

  <link as="style"
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Raleway:wght@400;500;600;700&display=swap"
    rel="preload" />

  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Raleway:wght@400;500;600;700&display=swap"
    rel="stylesheet" />

  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          header: ["Raleway", "sans-serif"],
          body: ["Open Sans", "sans-serif"],
        },
        extend: {
          colors: {
            primary: "#5540AF",
            secondary: "#252426",
            yellow: "#F9E71C",
            lila: "#E6E5EC",
            "grey-10": "#6C6B6D",
            "grey-20": "#7C7C7C",
            "grey-30": "#919091",
            "grey-40": "#929293",
            "grey-50": "#F4F3F8",
            "grey-60": "#EDEBF6",
            "grey-70": "#D8D8D8",
            "primaryG": "rgba(85, 64, 174, 0.95)",
            "secondaryG": "rgba(65, 47, 144, 0.93)",
            "blog-gradient-from": "#8F9098",
            "blog-gradient-to": "#222222",
          },
          zIndex: {
            70: "70",
          },
          backgroundImage: {
            "primaryG": "rgba(85, 64, 174, 0.95)",
            "secondaryG": "rgba(65, 47, 144, 0.93)",
            "blog-gradient-from": "#8F9098",
            "blog-gradient-to": "#222222",
          },
        },
        container: {
          center: true,
          padding: "1rem",
          screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1536px",
          },
        },
      },
    };
  </script>

  <script defer src="https://unpkg.com/@alpine-collective/toolkit@1.0.0/dist/cdn.min.js"></script>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</head>


<body :class="{ &#39;overflow-hidden max-h-screen&#39;: mobileMenu }" class="relative" x-data="{ mobileMenu: false }">

  <div id="main" class="relative">
    <div x-data="{
    triggerNavItem(id) {
        $scroll(id)
    },
    triggerMobileNavItem(id) {
        mobileMenu=false;
        this.triggerNavItem(id)
    }
}">
      <div class="w-full z-50 top-0 py-3 sm:py-5  absolute
  ">
        <div class="container flex items-center justify-between">
          <div class="flex items-center gap-5">
            <div>
              <img src="./src/images/logo_stifin.webp" class="w-24 lg:w-48" alt="logo image">
            </div>
            <div>
              <img src="./src/images/logo_steps.png" class="w-24 lg:w-48" alt="logo image">
            </div>
          </div>
          <div class="">
            <button type="button"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Default</button>
          </div>
          <!-- <div class="hidden lg:block">
      <ul class="flex items-center">
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#about&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">About</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#services&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Services</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#portfolio&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Portfolio</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#clients&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Clients</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#work&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Work</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#statistics&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Statistics</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#blog&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Blog</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
        <li class="group pl-6">
          
          <span @click="triggerNavItem(&#39;#contact&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Contact</span>
          
          <span class="block h-0.5 w-full bg-transparent group-hover:bg-yellow"></span>
        </li>
        
      </ul>
    </div>
    <div class="block lg:hidden">
      <button @click="mobileMenu = true">
        <i class="bx bx-menu text-4xl text-white"></i>
      </button>
    </div> -->
        </div>
      </div>

      <!-- hamburger menu, turn on if needed -->
      <!-- <div class="pointer-events-none fixed inset-0 z-70 min-h-screen bg-black bg-opacity-70 opacity-0 transition-opacity lg:hidden" :class="{ &#39;opacity-100 pointer-events-auto&#39;: mobileMenu }">
  <div class="absolute right-0 min-h-screen w-2/3 bg-primary py-4 px-8 shadow md:w-1/3">
    <button class="absolute top-0 right-0 mt-4 mr-4" @click="mobileMenu = false">
      <img src="./src/images/icon-close.svg" class="h-10 w-auto" alt="">
    </button>

    <ul class="mt-8 flex flex-col">
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#about&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">About</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#services&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Services</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#portfolio&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Portfolio</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#clients&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Clients</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#work&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Work</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#statistics&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Statistics</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#blog&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Blog</span>
        
      </li>
      
      <li class="py-2">
        
        <span @click="triggerMobileNavItem(&#39;#contact&#39;)" class="cursor-pointer pt-0.5 font-header font-semibold uppercase text-white">Contact</span>
        
      </li>
      
    </ul>
  </div>
</div> -->


      <div>
        <div class="relative bg-cover bg-center bg-no-repeat py-8"
          style="background-image: url('./src/images/bg-hero.jpg')">
          <div
            class="absolute inset-0 z-20 bg-gradient-to-r from-primaryG to-secondaryG bg-cover bg-center bg-no-repeat">
          </div>

          <div class="container relative z-30 pt-20 pb-12 sm:pt-56 sm:pb-48 lg:pt-64 lg:pb-48">
            <div class="flex flex-col items-center justify-center lg:flex-row">
              <div class="rounded-full border-8 border-primary shadow-xl">
                <img src="./src/images/blog-author.jpg" class="h-48 rounded-full sm:h-56" alt="author">
              </div>
              <div class="pt-8 sm:pt-10 lg:pl-8 lg:pt-0">
                <h1 class="text-center font-header text-4xl text-white sm:text-left sm:text-5xl md:text-6xl">
                  Hallo <?= $_SESSION['user_name'] ?>!
                </h1>
                <div class="flex flex-col justify-center pt-3 sm:flex-row sm:pt-5 lg:justify-start">
                  <see class="flex items-center justify-center pl-0 sm:justify-start md:pl-1">
                    <p class="font-body text-lg uppercase text-white">Let's see your test report!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-grey-50" id="about">
        <div class="container flex flex-col items-center py-16 md:py-20 lg:flex-row">
          <div class="w-full text-center sm:w-3/4 lg:w-3/5 lg:text-left">
            <h2 class="font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
              Your type is <?= $_SESSION['type'] ?>
            </h2>
            <h4 class="pt-6 font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
              Here&#39;s a brief description about your type
            </h4>
            <p class="pt-6 font-body leading-relaxed text-grey-20">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
              veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
              occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
          <div class="w-full pl-0 pt-10 sm:w-3/4 lg:w-2/5 lg:pl-12 lg:pt-0">
            <div>
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">
                  Lorem
                </h4>
                <h3 class="font-body text-3xl font-bold text-primary">85%</h3>
              </div>
              <div class="mt-2 h-3 w-full rounded-full bg-lila">
                <div class="h-3 rounded-full bg-primary" style="width: 85%"></div>
              </div>
            </div>
            <div class="pt-6">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">ipsum</h4>
                <h3 class="font-body text-3xl font-bold text-primary">70%</h3>
              </div>
              <div class="mt-2 h-3 w-full rounded-full bg-lila">
                <div class="h-3 rounded-full bg-primary" style="width: 70%"></div>
              </div>
            </div>
            <div class="pt-6">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">
                  sit
                </h4>
                <h3 class="font-body text-3xl font-bold text-primary">98%</h3>
              </div>
              <div class="mt-2 h-3 w-full rounded-full bg-lila">
                <div class="h-3 rounded-full bg-primary" style="width: 98%"></div>
              </div>
            </div>
            <div class="pt-6">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">Dolor</h4>
                <h3 class="font-body text-3xl font-bold text-primary">91%</h3>
              </div>
              <div class="mt-2 h-3 w-full rounded-full bg-lila">
                <div class="h-3 rounded-full bg-primary" style="width: 91%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container py-16 md:py-20" id="services">
        <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
          What you can be?
        </h2>
        <h3 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
          These are some recommendation for <?= $_SESSION['type'] ?> like you!
        </h3>

        <div class="grid grid-cols-1 gap-6 pt-10 sm:grid-cols-2 md:gap-10 md:pt-12 lg:grid-cols-3">
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-development-white.svg" alt="development icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-development-black.svg" alt="development icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                WEB DEVELOPMENT
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-content-white.svg" alt="content marketing icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-content-black.svg" alt="content marketing icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                Technical Writing
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-mobile-white.svg" alt="Mobile Application icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-mobile-black.svg" alt="Mobile Application icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                Mobile Development
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-email-white.svg" alt="Email Marketing icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-email-black.svg" alt="Email Marketing icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                Email Development
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-design-white.svg" alt="Theme Design icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-design-black.svg" alt="Theme Design icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                Graphic Design
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
          <div class="group rounded px-8 py-12 shadow hover:bg-primary">
            <div class="mx-auto h-24 w-24 text-center xl:h-28 xl:w-28">
              <div class="hidden group-hover:block">
                <img src="./src/images/icon-graphics-white.svg" alt="Graphic Design icon">
              </div>
              <div class="block group-hover:hidden">
                <img src="./src/images/icon-graphics-black.svg" alt="Graphic Design icon">
              </div>
            </div>
            <div class="text-center">
              <h3 class="pt-8 text-lg font-semibold uppercase text-primary group-hover:text-yellow lg:text-xl">
                Web Design
              </h3>
              <p class="text-grey pt-4 text-sm group-hover:text-white md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="bg-grey-50" id="clients">
  <div class="container py-16 md:py-20">
    <div class="mx-auto w-full sm:w-3/4 lg:w-full">
      <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
        My latest clients
      </h2>
      <div class="flex flex-wrap items-center justify-center pt-4 sm:pt-4">
        <span class="m-8 block">
          <img src="./src/images/logo-coca-cola.svg" alt="client logo" class="mx-auto block h-12 w-auto">
        </span>
        <span class="m-8 block">
          <img src="./src/images/logo-apple.svg" alt="client logo" class="mx-auto block h-12 w-auto">
        </span>

        <span class="m-8 block">
          <img src="./src/images/logo-netflix.svg" alt="client logo" class="mx-auto block h-12 w-auto">
        </span>

        <span class="m-8 block">
          <img src="./src/images/logo-amazon.svg" alt="client logo" class="mx-auto block h-12 w-auto">
        </span>

        <span class="m-8 block">
          <img src="./src/images/logo-stripe.svg" alt="client logo" class="mx-auto block h-12 w-auto">
        </span>
      </div>
    </div>
  </div>
</div> -->

      <!-- <div class="container py-16 md:py-20" id="work">
  <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
    My work experience
  </h2>
  <h3 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
    Here's what I did before freelancing
  </h3>

  <div class="relative mx-auto mt-12 flex w-full flex-col lg:w-2/3">
    <span class="left-2/5 absolute inset-y-0 ml-10 hidden w-0.5 bg-grey-40 md:block"></span>

    <div class="mt-8 flex flex-col text-center md:flex-row md:text-left">
      <div class="md:w-2/5">
        <div class="flex justify-center md:justify-start">
          <span class="shrink-0">
            <img src="./src/images/logo-spotify.svg" class="h-auto w-32" alt="company logo">
          </span>
          <div class="relative ml-3 hidden w-full md:block">
            <span class="absolute inset-x-0 top-1/2 h-0.5 -translate-y-1/2 transform bg-grey-70"></span>
          </div>
        </div>
      </div>
      <div class="md:w-3/5">
        <div class="relative flex md:pl-18">
          <span class="absolute left-8 top-1 hidden h-4 w-4 rounded-full border-2 border-grey-40 bg-white md:block"></span>

          <div class="mt-1 flex">
            <i class="bx bxs-right-arrow hidden text-primary md:block"></i>
            <div class="md:-mt-1 md:pl-8">
              <span class="block font-body font-bold text-grey-40">Apr 2015 - Mar 2018</span>
              <span class="block pt-2 font-header text-xl font-bold uppercase text-primary">Frontend Developer</span>
              <div class="pt-2">
                <span class="block font-body text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Vestibulum mattis felis vitae risus pulvinar tincidunt. Nam ac
                  venenatis enim.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8 flex flex-col text-center md:flex-row md:text-left">
      <div class="md:w-2/5">
        <div class="flex justify-center md:justify-start">
          <span class="shrink-0">
            <img src="./src/images/logo-microsoft.svg" class="h-auto w-32" alt="company logo">
          </span>
          <div class="relative ml-3 hidden w-full md:block">
            <span class="absolute inset-x-0 top-1/2 h-0.5 -translate-y-1/2 transform bg-grey-70"></span>
          </div>
        </div>
      </div>
      <div class="md:w-3/5">
        <div class="relative flex md:pl-18">
          <span class="absolute left-8 top-1 hidden h-4 w-4 rounded-full border-2 border-grey-40 bg-white md:block"></span>

          <div class="mt-1 flex">
            <i class="bx bxs-right-arrow hidden text-primary md:block"></i>
            <div class="md:-mt-1 md:pl-8">
              <span class="block font-body font-bold text-grey-40">Mar 2018 - September 2019</span>
              <span class="block pt-2 font-header text-xl font-bold uppercase text-primary">Software Engineer</span>
              <div class="pt-2">
                <span class="block font-body text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Vestibulum mattis felis vitae risus pulvinar tincidunt. Nam ac
                  venenatis enim.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8 flex flex-col text-center md:flex-row md:text-left">
      <div class="md:w-2/5">
        <div class="flex justify-center md:justify-start">
          <span class="shrink-0">
            <img src="./src/images/logo-fedex.svg" class="h-auto w-32" alt="company logo">
          </span>
          <div class="relative ml-3 hidden w-full md:block">
            <span class="absolute inset-x-0 top-1/2 h-0.5 -translate-y-1/2 transform bg-grey-70"></span>
          </div>
        </div>
      </div>
      <div class="md:w-3/5">
        <div class="relative flex md:pl-18">
          <span class="absolute left-8 top-1 hidden h-4 w-4 rounded-full border-2 border-grey-40 bg-white md:block"></span>

          <div class="mt-1 flex">
            <i class="bx bxs-right-arrow hidden text-primary md:block"></i>
            <div class="md:-mt-1 md:pl-8">
              <span class="block font-body font-bold text-grey-40">October 2019 - Feb 2021</span>
              <span class="block pt-2 font-header text-xl font-bold uppercase text-primary">DevOps Engineer</span>
              <div class="pt-2">
                <span class="block font-body text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Vestibulum mattis felis vitae risus pulvinar tincidunt. Nam ac
                  venenatis enim.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

      <div class="bg-cover bg-top bg-no-repeat pb-16 md:py-16 lg:py-24"
        style="background-image: url(./src/images/experience-figure.png)" id="statistics">
        <!-- <div class="container">
    <div class="mx-auto w-5/6 bg-white py-16 shadow md:w-11/12 lg:py-20 xl:py-24 2xl:w-full">
      <div class="grid grid-cols-2 gap-5 md:gap-8 xl:grid-cols-4 xl:gap-5">
        <div class="flex flex-col items-center justify-center text-center md:flex-row md:text-left">
          <div>
            <img src="./src/images/icon-project.svg" class="mx-auto h-12 w-auto md:h-20" alt="icon project">
          </div>
          <div class="pt-5 md:pl-5 md:pt-0">
            <h1 class="font-body text-2xl font-bold text-primary md:text-4xl">
              12
            </h1>
            <h4 class="text-grey-dark font-header text-base font-medium leading-loose md:text-xl">
              Finished Projects
            </h4>
          </div>
        </div>

        <div class="flex flex-col items-center justify-center text-center md:flex-row md:text-left">
          <div>
            <img src="./src/images/icon-award.svg" class="mx-auto h-12 w-auto md:h-20" alt="icon award">
          </div>
          <div class="pt-5 md:pl-5 md:pt-0">
            <h1 class="font-body text-2xl font-bold text-primary md:text-4xl">
              3
            </h1>
            <h4 class="text-grey-dark font-header text-base font-medium leading-loose md:text-xl">
              Awards Won
            </h4>
          </div>
        </div>

        <div class="mt-6 flex flex-col items-center justify-center text-center md:mt-10 md:flex-row md:text-left lg:mt-0">
          <div>
            <img src="./src/images/icon-happy.svg" class="mx-auto h-12 w-auto md:h-20" alt="icon happy clients">
          </div>
          <div class="pt-5 md:pl-5 md:pt-0">
            <h1 class="font-body text-2xl font-bold text-primary md:text-4xl">
              8
            </h1>
            <h4 class="text-grey-dark font-header text-base font-medium leading-loose md:text-xl">
              Happy Clients
            </h4>
          </div>
        </div>

        <div class="mt-6 flex flex-col items-center justify-center text-center md:mt-10 md:flex-row md:text-left lg:mt-0">
          <div>
            <img src="./src/images/icon-puzzle.svg" class="mx-auto h-12 w-auto md:h-20" alt="icon puzzle">
          </div>
          <div class="pt-5 md:pl-5 md:pt-0">
            <h1 class="font-body text-2xl font-bold text-primary md:text-4xl">
              99
            </h1>
            <h4 class="text-grey-dark font-header text-base font-medium leading-loose md:text-xl">
              Bugs Fixed
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div> -->
      </div>

      <div class="bg-grey-50" id="blog">
        <div class="container py-16 md:py-20">
          <h2 class="text-center font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
            A bit tips to improve yourself
          </h2>
          <h4 class="pt-6 text-center font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
            -------Backlink can be placed here-------
          </h4>
          <div class="mx-auto grid w-full grid-cols-1 gap-6 pt-12 sm:w-3/4 lg:w-full lg:grid-cols-3 xl:gap-10">
            <a href="https://atom.redpixelthemes.com/post" class="shadow">
              <div style="background-image: url(/post-01.png)"
                class="group relative h-72 bg-cover bg-center bg-no-repeat sm:h-84 lg:h-64 xl:h-72">
                <span
                  class="absolute inset-0 block bg-gradient-to-b from-blog-gradient-from to-blog-gradient-to bg-cover bg-center bg-no-repeat opacity-10 transition-opacity group-hover:opacity-50"></span>
                <span
                  class="absolute right-0 bottom-0 mr-4 mb-4 block rounded-full border-2 border-white px-6 py-2 text-center font-body text-sm font-bold uppercase text-white md:text-base">Read
                  More</span>
              </div>
              <div class="bg-white py-6 px-5 xl:py-8">
                <span class="block font-body text-lg font-semibold text-black">How to become a frontend developer</span>
                <span class="block pt-2 font-body text-grey-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
              </div>
            </a>
            <a href="https://atom.redpixelthemes.com/post" class="shadow">
              <div style="background-image: url(/post-02.png)"
                class="group relative h-72 bg-cover bg-center bg-no-repeat sm:h-84 lg:h-64 xl:h-72">
                <span
                  class="absolute inset-0 block bg-gradient-to-b from-blog-gradient-from to-blog-gradient-to bg-cover bg-center bg-no-repeat opacity-10 transition-opacity group-hover:opacity-50"></span>
                <span
                  class="absolute right-0 bottom-0 mr-4 mb-4 block rounded-full border-2 border-white px-6 py-2 text-center font-body text-sm font-bold uppercase text-white md:text-base">Read
                  More</span>
              </div>
              <div class="bg-white py-6 px-5 xl:py-8">
                <span class="block font-body text-lg font-semibold text-black">My personal productivity system</span>
                <span class="block pt-2 font-body text-grey-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
              </div>
            </a>
            <a href="https://atom.redpixelthemes.com/post" class="shadow">
              <div style="background-image: url(/post-03.png)"
                class="group relative h-72 bg-cover bg-center bg-no-repeat sm:h-84 lg:h-64 xl:h-72">
                <span
                  class="absolute inset-0 block bg-gradient-to-b from-blog-gradient-from to-blog-gradient-to bg-cover bg-center bg-no-repeat opacity-10 transition-opacity group-hover:opacity-50"></span>
                <span
                  class="absolute right-0 bottom-0 mr-4 mb-4 block rounded-full border-2 border-white px-6 py-2 text-center font-body text-sm font-bold uppercase text-white md:text-base">Read
                  More</span>
              </div>
              <div class="bg-white py-6 px-5 xl:py-8">
                <span class="block font-body text-lg font-semibold text-black">My year in review 2020</span>
                <span class="block pt-2 font-body text-grey-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
              </div>
            </a>
          </div>
        </div>
      </div>


      <div class="relative bg-primary bg-cover bg-center bg-no-repeat py-16 bg-blend-multiply lg:py-24"
        style="background-image: url(/bg-cta.jpg)">
        <div class="container relative z-30">
          <h3
            class="text-center font-header text-3xl uppercase leading-tight tracking-wide text-white sm:text-4xl lg:text-5xl">
            Want to know more about yourself? <br>
            Contact us now!
          </h3>
          <form class="mt-6 flex flex-col justify-center sm:flex-row">
            <input class="w-full rounded px-4 py-3 font-body text-black sm:w-2/5 sm:py-4 lg:w-1/3" type="text"
              id="email" placeholder="Say what u want to know">
            <button
              class="mt-2 rounded bg-yellow px-8 py-3 font-body text-base font-bold uppercase text-primary transition-colors hover:bg-primary hover:text-white focus:border-transparent focus:outline-none focus:ring focus:ring-yellow sm:ml-2 sm:mt-0 sm:py-4 md:text-lg">
              Ask Us!
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="bg-primary">
      <div class="container flex flex-col justify-between py-6 sm:flex-row">
        <p class="text-center font-body text-white md:text-left">
          © Copyright 2022. All right reserved, ATOM.
        </p>
        <div class="flex items-center justify-center pt-5 sm:justify-start sm:pt-0">
          <a href="https://atom.redpixelthemes.com/">
            <i class="bx bxl-facebook-square text-2xl text-white hover:text-yellow"></i>
          </a>
          <a href="https://atom.redpixelthemes.com/" class="pl-4">
            <i class="bx bxl-twitter text-2xl text-white hover:text-yellow"></i>
          </a>
          <a href="https://atom.redpixelthemes.com/" class="pl-4">
            <i class="bx bxl-dribbble text-2xl text-white hover:text-yellow"></i>
          </a>
          <a href="https://atom.redpixelthemes.com/" class="pl-4">
            <i class="bx bxl-linkedin text-2xl text-white hover:text-yellow"></i>
          </a>
          <a href="https://atom.redpixelthemes.com/" class="pl-4">
            <i class="bx bxl-instagram text-2xl text-white hover:text-yellow"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>