<?php
session_start();
require_once './app/config/utils.php';
if (!isset($_SESSION['ClientLoggedIn']) == True) {
  header('location: ./index.php');
  exit();
}

$descriptions = [

  'Si' => 'Kamu adalah sosok yang teliti, sabar, dan konsisten. Tipe Si (Introvert Sensing) memiliki kekuatan pada detail dan ketepatan. Kamu bekerja dengan hati-hati, selalu memastikan segalanya berjalan rapi dan teratur. Kamu lebih nyaman dengan rutinitas yang stabil dan hasil nyata. Dalam kerja maupun kehidupan, kamu menjadi sosok yang dapat diandalkan dan dipercaya karena ketenangan serta kesungguhanmu.',

  'Se' => 'Kamu hidup penuh energi dan spontanitas. Tipe Se (Extrovert Sensing) sangat menikmati dunia nyata dan segala pengalaman yang bisa dirasakan langsung. Kamu cepat bertindak, sigap membaca situasi, dan tangguh di lapangan. Dalam setiap tantangan, kamu hadir sebagai pelaku yang berani mengambil risiko dan membawa semangat hidup yang menular bagi orang di sekitarmu.',

  'Ti' => 'Kamu adalah pemikir logis dan analitis. Tipe Ti (Introvert Thinking) memiliki cara berpikir sistematis dan mendalam, selalu mencari kebenaran melalui struktur dan prinsip. Kamu lebih fokus pada keakuratan dan efisiensi dibanding hal-hal emosional. Dalam setiap keputusan, kamu menilai berdasarkan logika yang matang dan fakta yang jelas. Dunia bagimu adalah rangkaian sistem yang bisa disempurnakan.',

  'Te' => 'Kamu adalah penggerak yang tegas dan berorientasi hasil. Tipe Te (Extrovert Thinking) tahu bagaimana membuat rencana menjadi nyata. Kamu berpikir strategis, memimpin dengan arah yang jelas, dan menghargai kinerja serta produktivitas. Kamu tidak suka berlama-lama dalam teori — kamu bergerak cepat dan tepat sasaran. Dengan ketegasanmu, kamu membantu banyak orang mencapai tujuan bersama.',

  'Fi' => 'Kamu adalah pribadi yang lembut dan penuh empati. Tipe Fi (Introvert Feeling) memiliki kepekaan mendalam terhadap nilai dan perasaan. Kamu hidup sesuai prinsip hati dan selalu berusaha menjaga keaslian diri. Dalam relasi, kamu setia, tulus, dan hangat. Kamu memahami orang lain tanpa banyak kata, karena empati adalah bahasamu. Dunia membutuhkan ketenangan dan kasihmu.',

  'Fe' => 'Kamu adalah penghubung alami antar manusia. Tipe Fe (Extrovert Feeling) memiliki kemampuan luar biasa dalam menciptakan kehangatan dan harmoni di lingkunganmu. Kamu mudah membaca emosi orang lain dan berusaha membuat semua merasa diterima. Dalam kelompok, kamu adalah perekat sosial yang membawa semangat kebersamaan. Senyum dan energimu adalah kekuatan yang menginspirasi banyak orang.',

  'Ii' => 'Kamu adalah pemikir yang penuh imajinasi dan makna. Tipe Ii (Introvert Intuiting) memiliki kemampuan untuk melihat pola tersembunyi dan memahami sesuatu secara mendalam. Kamu sering merenung, memikirkan konsep besar, dan mencari arti di balik kehidupan. Dengan ide-ide visionermu, kamu mampu menciptakan perubahan tanpa banyak bicara. Dunia batinmu adalah sumber inspirasi yang tak terbatas.',

  'Ie' => 'Kamu adalah penggagas ide besar dan pembawa visi. Tipe Ie (Extrovert Intuiting) selalu melihat masa depan dan kemungkinan baru. Kamu kreatif, inovatif, dan suka menantang batas yang ada. Orang lain melihatmu sebagai sosok penuh ide segar yang mampu menyalakan semangat perubahan. Dunia adalah tempat eksplorasimu, dan ide-ide besarmu bisa menjadi sumber gerakan besar berikutnya.',

  'In' => 'Kamu adalah pribadi yang intuitif, reflektif, dan visioner. Tipe In (Introvert Intuiting) memiliki kekuatan dalam membaca pola dan makna di balik setiap kejadian. Kamu berpikir jauh ke depan, mampu melihat kemungkinan sebelum orang lain menyadarinya. Dunia batinmu penuh ide besar yang lahir dari perenungan mendalam. Dengan ketenangan dan intuisi yang tajam, kamu lebih memilih menciptakan arah baru daripada sekadar mengikuti arus. Kepekaan dan imajinasimu menjadikanmu sumber inspirasi bagi banyak orang.',

];
$description = $descriptions[$_SESSION['type']] ?? 'Deskripsi belum tersedia untuk tipe ini.';

// Tentukan warna berdasarkan session
$type = $_SESSION['type'] ?? 'default';

switch ($type) {
  case 'Si':
  case 'Se':
    $primary = '#1D4ED8';
    $primaryG = 'rgba(29, 78, 216, 0.9)';
    $secondaryG = 'rgba(30, 64, 175, 0.9)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;

  case 'Ti':
  case 'Te':
    $primary = '#15803D';
    $primaryG = 'rgba(21, 128, 61, 0.9)';
    $secondaryG = 'rgba(22, 101, 52, 0.9)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;

  case 'Ii':
  case 'Ie':
    $primary = '#7E22CE';
    $primaryG = 'rgba(126, 34, 206, 0.95)';
    $secondaryG = 'rgba(109, 40, 217, 0.93)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;

  case 'Fi':
  case 'Fe':
    $primary = '#DC2626';
    $primaryG = 'rgba(220, 38, 38, 0.95)';
    $secondaryG = 'rgba(185, 28, 28, 0.9)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;

  case 'In':
    $primary = '#EA580C';
    $primaryG = 'rgba(234, 88, 12, 0.95)';
    $secondaryG = 'rgba(194, 65, 12, 0.93)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;

  default:
    $primary = '#6D28D9';
    $primaryG = 'rgba(109, 40, 217, 0.95)';
    $secondaryG = 'rgba(91, 33, 182, 0.9)';
    $stats = [
      [
        "label" => "Sensing",
        "value" => 85
      ],
      [
        "label" => "Thinking",
        "value" => 85
      ],
      [
        "label" => "Feeling",
        "value" => 85
      ],
      [
        "label" => "Intuiting",
        "value" => 85
      ],
      [
        "label" => "Instinct",
        "value" => 85
      ]
    ];
    break;
}
$statsJson = json_encode($stats);

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

  <meta name="theme-color" content="#0a0716ff">

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
            primary: "<?= $primary ?>",
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
            "primaryG": "<?= $primaryG ?>",
            "secondaryG": "<?= $secondaryG ?>",
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
          <form method="POST" action="./app/controller/LoginController.php">
            <button type="submit" name="action" value="logout" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">logout</button>
          </form>
        </div>
      </div>


      <div>
        <div class="relative bg-cover bg-center bg-no-repeat py-8"
          style="background-image: url('./src/images/bg-hero.jpg')">
          <div
            class="absolute inset-0 z-20 bg-gradient-to-r from-primaryG to-secondaryG bg-cover bg-center bg-no-repeat">
          </div>
          <div class="container relative z-30 pt-20 pb-12 sm:pt-56 sm:pb-48 lg:pt-64 lg:pb-48">
            <div class="flex flex-col items-center justify-center gap-4">
              <div class="rounded-full border-8 border-primary shadow-xl">
                <img src="./app/uploads/photos/clients/<?= $_SESSION['profile'] ?>" class="h-48 rounded-full sm:h-56" alt="author">
              </div>
              <div class="flex flex-col items-center justify-center">
                <h1 class="text-center font-header text-4xl text-white sm:text-5xl md:text-6xl">
                  Hallo <br><?= $_SESSION['user_name'] ?>!
                </h1>
                <div class="pt-3 sm:flex-row sm:pt-5 lg:justify-start">
                  <p class="font-body text-lg uppercase text-white">Let's see your test report!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-grey-50" id="about">

        <div class="container flex flex-col place-content-around items-center py-16 md:py-20 lg:flex-row">
          <div class="w-full text-center sm:w-3/4 lg:w-3/5 lg:text-left">
            <h2 class="font-header text-4xl font-semibold uppercase text-primary sm:text-5xl lg:text-6xl">
              Your type is <?= $_SESSION['type'] ?>
            </h2>
            <div class="">
              <h4 class="pt-6 font-header text-xl font-medium text-black sm:text-2xl lg:text-3xl">
                Here&#39;s a brief description about your type
              </h4>

            </div>
            <p class="pt-6 font-body leading-relaxed text-grey-20">
              <?= $description ?>
            </p>
          </div>

          <div class="w-full lg:w-1/3 flex justify-center gap-6 mt-10 lg:mt-0">
            <div x-data='{items : <?php echo $statsJson; ?> }' class="w-full flex flex-wrap justify-center gap-6 mt-10 lg:mt-0">
              <div class="flex gap-10">
                <div class="relative h-24 w-24">
                  <svg class="absolute inset-0" viewBox="0 0 36 36">
                    <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                    <path class="text-primary" stroke="currentColor" stroke-width="3" :stroke-dasharray="`${items[0].value},100`" fill="none"
                      stroke-linecap="round"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                  </svg>
                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <h3 class="font-body text-xl font-bold text-primary" x-text="items[0].value + '%'"></h3>
                    <p class="font-body text-xs text-black" x-text="items[0].label"></p>
                  </div>
                </div>
  
                <div class="relative h-24 w-24">
                  <svg class="absolute inset-0" viewBox="0 0 36 36">
                    <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                    <path class="text-primary" stroke="currentColor" stroke-width="3" :stroke-dasharray="`${items[1].value},100`" fill="none"
                      stroke-linecap="round"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                  </svg>
                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <h3 class="font-body text-xl font-bold text-primary" x-text="items[1].value + '%'"></h3>
                    <p class="font-body text-xs text-black" x-text="items[1].label"></p>
                  </div>
                </div>
              </div>
  
              <div class="relative h-24 w-24">
                <svg class="absolute inset-0" viewBox="0 0 36 36">
                  <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                    d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                  <path class="text-primary" stroke="currentColor" stroke-width="3" :stroke-dasharray="`${items[2].value},100`" fill="none"
                    stroke-linecap="round"
                    d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                  <h3 class="font-body text-xl font-bold text-primary" x-text="items[2].value + '%'"></h3>
                  <p class="font-body text-xs text-black" x-text="items[2].label"></p>
                </div>
              </div>
  
              <div class="flex gap-10">
                <div class="relative h-24 w-24">
                  <svg class="absolute inset-0" viewBox="0 0 36 36">
                    <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                    <path class="text-primary" stroke="currentColor" stroke-width="3" :stroke-dasharray="`${items[3].value},100`" fill="none"
                      stroke-linecap="round"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                  </svg>
                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <h3 class="font-body text-xl font-bold text-primary" x-text="items[3].value + '%'"></h3>
                    <p class="font-body text-xs text-black" x-text="items[3].label"></p>
                  </div>
                </div>
  
                <div class="relative h-24 w-24">
                  <svg class="absolute inset-0" viewBox="0 0 36 36">
                    <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                    <path class="text-primary" stroke="currentColor" stroke-width="3" :stroke-dasharray="`${items[4].value},100`" fill="none"
                      stroke-linecap="round"
                      d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                  </svg>
                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <h3 class="font-body text-xl font-bold text-primary" x-text="items[4].value + '%'"></h3>
                    <p class="font-body text-xs text-black" x-text="items[4].label"></p>
                  </div>
                </div>
              </div>

              <div class="mt-4 flex flex-col sm:flex-row lg:justify-start">
                <button
                  onclick="preview()"
                  class="mt-2 rounded bg-yellow px-5 py-1 font-body text-base font-bold uppercase text-primary transition-colors hover:bg-primary hover:text-white focus:border-transparent focus:outline-none focus:ring focus:ring-yellow sm:ml-2 sm:mt-0 sm:py-4 ">
                  Preview
                </button>
                <button
                  onclick="download()"
                  class="mt-2 rounded bg-yellow px-5 py-1 font-body text-base font-bold uppercase text-primary transition-colors hover:bg-primary hover:text-white focus:border-transparent focus:outline-none focus:ring focus:ring-yellow sm:ml-2 sm:mt-0 sm:py-4 ">
                  Download
                </button>
              </div>
  
  
            </div>

          </div>
        </div>

        <!-- <div class="flex flex-col lg:flex-row border-t border-b border-grey-70 bg-white py-12 items-center gap-8" id="statistics">

          Sunburn
          <div class="w-full lg:w-1/3 flex flex-wrap justify-center gap-6">
            <div class="relative h-24 w-24">
              <svg class="absolute inset-0" viewBox="0 0 36 36">
                <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                <path class="text-primary" stroke="currentColor" stroke-width="3" stroke-dasharray="85,100" fill="none"
                  stroke-linecap="round"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h3 class="font-body text-xl font-bold text-primary">85%</h3>
                <p class="font-body text-xs text-black">Lorem</p>
              </div>
            </div>

            <div class="relative h-24 w-24">
              <svg class="absolute inset-0" viewBox="0 0 36 36">
                <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                <path class="text-primary" stroke="currentColor" stroke-width="3" stroke-dasharray="70,100" fill="none"
                  stroke-linecap="round"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h3 class="font-body text-xl font-bold text-primary">70%</h3>
                <p class="font-body text-xs text-black">Ipsum</p>
              </div>
            </div>

            <div class="relative h-24 w-24">
              <svg class="absolute inset-0" viewBox="0 0 36 36">
                <path class="text-lila" stroke="currentColor" stroke-width="3" fill="none"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
                <path class="text-primary" stroke="currentColor" stroke-width="3" stroke-dasharray="98,100" fill="none"
                  stroke-linecap="round"
                  d="M18 2a16 16 0 1 1 0 32 16 16 0 1 1 0-32z" />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h3 class="font-body text-xl font-bold text-primary">98%</h3>
                <p class="font-body text-xs text-black">Sit</p>
              </div>
            </div>
          </div>

          Radar
          <div class="w-full lg:w-1/3 flex flex-col items-center">
            <h4 class="font-body font-semibold uppercase text-black mb-2">Performance Radar</h4>
            <div class="relative h-48 w-48">
              <div class="absolute inset-0 rounded-full border border-lila opacity-40"></div>
              <div class="absolute inset-4 rounded-full border border-lila opacity-40"></div>
              <div class="absolute inset-8 rounded-full border border-lila opacity-40"></div>

              <div class="absolute top-0 left-1/2 h-1/2 w-px bg-lila"></div>
              <div class="absolute bottom-0 left-1/2 h-1/2 w-px bg-lila"></div>
              <div class="absolute left-0 top-1/2 w-1/2 h-px bg-lila"></div>
              <div class="absolute right-0 top-1/2 w-1/2 h-px bg-lila"></div>

              <svg class="absolute inset-0" viewBox="0 0 100 100">
                <polygon points="50,10 90,50 60,90 40,80 10,40"
                  fill="rgba(59,130,246,0.3)"
                  stroke="rgb(59,130,246)"
                  stroke-width="1.5" />
              </svg>

              <span class="absolute top-0 left-1/2 -translate-x-1/2 text-[10px] font-body">Lorem</span>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 text-[10px] font-body">Ipsum</span>
              <span class="absolute left-0 top-1/2 -translate-y-1/2 text-[10px] font-body">Sit</span>
              <span class="absolute right-0 top-1/2 -translate-y-1/2 text-[10px] font-body">Dolor</span>
            </div>
          </div>

          Line Chart Section
          <div class="w-1/2 lg:w-1/3 pl-0 pt-6 lg:pl-8 lg:pt-0 mx-10">
            <div>
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">Lorem</h4>
                <h3 class="font-body text-2xl font-bold text-primary">85%</h3>
              </div>
              <div class="mt-2 h-2 w-full rounded-full bg-lila">
                <div class="h-2 rounded-full bg-primary" style="width: 85%"></div>
              </div>
            </div>

            <div class="pt-4">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">Ipsum</h4>
                <h3 class="font-body text-2xl font-bold text-primary">70%</h3>
              </div>
              <div class="mt-2 h-2 w-full rounded-full bg-lila">
                <div class="h-2 rounded-full bg-primary" style="width: 70%"></div>
              </div>
            </div>

            <div class="pt-4">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">Sit</h4>
                <h3 class="font-body text-2xl font-bold text-primary">98%</h3>
              </div>
              <div class="mt-2 h-2 w-full rounded-full bg-lila">
                <div class="h-2 rounded-full bg-primary" style="width: 98%"></div>
              </div>
            </div>

            <div class="pt-4">
              <div class="flex items-end justify-between">
                <h4 class="font-body font-semibold uppercase text-black">Dolor</h4>
                <h3 class="font-body text-2xl font-bold text-primary">91%</h3>
              </div>
              <div class="mt-2 h-2 w-full rounded-full bg-lila">
                <div class="h-2 rounded-full bg-primary" style="width: 91%"></div>
              </div>
            </div>
          </div>


        </div> -->

        <div class="bg-primary">
          <div class="container flex flex-col justify-between py-6 sm:flex-row">
            <p class="text-center font-body text-white md:text-left">
              © Copyright 2025. All right reserved, STEPS ID.
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

    <script>
      function download() {
        window.location.href = '<?= base_url() ?>/app/controller/cert/download.php?id=' + <?= json_encode($_SESSION['user_id']) ?>;
      }

      function preview() {
        window.open('<?= base_url() ?>/app/controller/cert/preview.php?id=' + <?= json_encode($_SESSION['user_id']) ?>, '_blank', 'noopener,noreferrer');
      }
    </script>

</body>

</html>