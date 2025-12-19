<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>STIFIn | Promoted by STEPS ID</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        container: {
          center: true,
          padding: "1rem",
          screens: {
            xs: "400px",
            sm: "540px",
            md: "720px",
            lg: "960px",
            xl: "1140px",
            "2xl": "1320px",
          },
        },
        extend: {
          colors: {
            primary: "#3A6F43",
            secondary: "#59AC77",
            dark: "#111928",
            "dark-2": "#1F2A37",
            "dark-3": "#374151",
            "dark-6": "#9CA3AF",
            "dark-7": "#D1D5DB",
            "body-color": "#637381",
            "tg-bg": "#F7F8FA",
            stroke: "#DFE4EA",
          },
          boxShadow: {
            1: "0px 1px 3px 0px rgba(166, 175, 195, 0.40)",
            2: "0px 5px 12px 0px rgba(0, 0, 0, 0.10)",
            portfolio: "0px 4px 30px 0px rgba(0, 0, 0, 0.08)",
            pricing: "0px 39px 23px -27px rgba(0, 0, 0, 0.04)",
            "box-dark": "0px 10px 15px 0px rgba(5, 13, 29, 0.18)",
          },
          dropShadow: {
            pricing: "0px 16px 40px rgba(0, 0, 0, 0.07)",
          },
          zIndex: {
            "-2": "-2",
            99999: "99999",
          },
          backgroundImage: {
            "shape-gradient": "linear-gradient(180deg, rgba(255,255,255,0.08) 0%, rgba(196,196,196,0) 100%)",
          },
          screens: {
            xs: "400px",
          },
        },
      },
    };
  </script>

  <!-- Custom utilities manual (karena CDN tidak support plugin) -->
  <style type="text/tailwindcss">
    .navbarTogglerActive > span:nth-child(1) {
        top: 7px;
        --tw-rotate: 45deg;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y))
          rotate(var(--tw-rotate));
      }
      .navbarTogglerActive > span:nth-child(2) {
        opacity: 0;
      }
      .navbarTogglerActive > span:nth-child(3) {
        top: -0.5rem;
        --tw-rotate: 135deg;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y))
          rotate(var(--tw-rotate));
      }
      .message-user {
            background-color: #3A6F43;
            color: white;
            border-radius: 0.5rem;
            border-bottom-right-radius: 0;
            margin-left: auto;
            max-width: 80%;
        }
        
        .message-ai {
            background-color: #f3f4f6;
            color: #1f2937;
            border-radius: 0.5rem;
            border-bottom-left-radius: 0;
            max-width: 80%;
        }
        
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .typing-dot {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #9ca3af;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }
        
        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }
        
        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* Custom scrollbar */
        .messages-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .messages-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .messages-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        .messages-container::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

      /* Custom toggle/checkbox states */
      .checkbox-list:checked ~ label {
        @apply border-primary bg-primary text-white;
      }
      .box-select-1:checked ~ label .box {
        @apply border-primary bg-primary;
      }
      .tableCheckbox:checked ~ label .icon-box {
        @apply border-primary bg-primary;
      }

      /* Zoom button custom (map) */
      .jvm-zoom-btn {
        @apply flex h-8 w-8 items-center justify-center rounded border border-stroke bg-[#F9FAFB] font-semibold text-body-color;
      }
      .jvm-zoom-btn:hover {
        @apply border-primary bg-primary text-white;
      }

      /* Shape gradient */
      .shape-gradient {
        background: linear-gradient(
          180deg,
          rgba(255, 255, 255, 0.08) 0%,
          rgba(196, 196, 196, 0) 100%
        );
      }
    </style>

  <!-- 
    <link
      rel="stylesheet"
      href="src/css/tailwind.css"
    /> -->
  <script defer src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
  <link rel="icon" href="src/images/logo_stifin.webp" />
</head>

<body x-data="
    {
      scrolledFromTop: false
    }
  " x-init="window.pageYOffset >= 50 ? scrolledFromTop = true : scrolledFromTop = false"
  @scroll.window="window.pageYOffset >= 50 ? scrolledFromTop = true : scrolledFromTop = false">
  <!-- ====== Navbar Section Start -->
  <header
    x-data="{ navbarOpen: false }"
    :class="scrolledFromTop ? 'fixed z-50 bg-white dark:bg-dark bg-opacity-80 shadow-sm backdrop-blur-sm' : 'absolute'"
    class="top-0 left-0 z-50 w-full bg-white lg:overflow-hidden dark:bg-dark">
    <div class="container mx-auto">
      <div class="relative flex items-center justify-between -mx-4">

        <!-- Logo -->
        <div class="relative z-10 max-w-full px-4 py-3 w-60">
          <a href="javascript:void(0)" class="block w-full flex gap-2 items-center">
            <img src="src/images/logo_stifin.webp" alt="logo" class="sm:w-[40%] w-[40%]" />
            <img src="src/images/logo_steps.png" alt="logo" class="sm:w-[50%] w-[40%]" />
          </a>
          <span class="absolute right-0 top-1/2 z-[-1] h-full w-[1000%] -translate-y-1/2 bg-primary lg:h-[150%]"></span>
        </div>

        <!-- Button -->
        <div class="flex items-center justify-between w-full px-4">
          <button
            onclick="<?php if (isset($_SESSION['ClientLoggedIn'])) {
                        echo "window.location.href='report.php'; return false;";
                      } ?>"
            data-modal-target="authentication-modal"
            data-modal-toggle="authentication-modal"
            class="absolute right-4 top-1/2 -translate-y-1/2 rounded-md px-4 py-[6px] text-white bg-primary hover:opacity-80 ring-stroke focus:ring-2 transition">
            Cek Hasil Tes Kamu
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- Modal Login -->
  <div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">

      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Lihat Hasil Tes Kamu yuk!
          </h3>
          <button type="button"
            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="authentication-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <form class="space-y-4" action="./app/controller/LoginController.php" method="POST">

            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
              <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                required />
            </div>

            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                required />
            </div>

            <div class="flex justify-between">
              <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
            </div>

            <button type="submit" name="action" value="loginClient"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Login to your account
            </button>

            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
              Belum punya akun?
              <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Tes Sekarang yuk!</a>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- ====== Navbar Section End -->

  <!-- ====== Hero Section Start -->
  <div class="relative overflow-hidden bg-white dark:bg-dark">
    <div class="relative z-10 pb-20 pt-[150px] lg:pb-[120px] lg:pt-[210px]">
      <span class="absolute top-0 left-0 z-[-1] h-full w-full object-cover object-center"
        style="background-color: rgba(46, 46, 46, 0.322)"></span>

      <!-- Carousel Start -->
      <div class="swiper2 absolute top-0 left-0 z-[-2] h-full w-full">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="src/images/hero1.png" alt="image" class="h-full w-full object-cover object-center" />
          </div>
          <div class="swiper-slide">
            <img src="src/images/hero4.jpg" alt="image" class="h-full w-full object-cover object-center" />
          </div>
          <div class="swiper-slide">
            <img src="src/images/hero5.jpg" alt="image" class="h-full w-full object-cover object-center" />
          </div>
          <div class="swiper-slide">
            <img src="src/images/hero6.jpg" alt="image" class="h-full w-full object-cover object-center" />
          </div>
        </div>

      </div>
      <!-- Carousel End -->

      <div class="container mx-auto relative z-10">
        <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4 text-white">
            <h1 class="text-4xl font-bold">Kenali Diri Lebih Dalam Lewat STIFIn: Langkah Awal Bersama STEPS</h1>
            <p class="mt-4 text-lg">
              <strong>
                Langkah kecil yang dimulai dari mengenal diri sendiri bisa membawa perubahan besar.
              </strong>
            </p>
            <div>
              <a href="javascript:void(0)"
                class="inline-block px-6 py-4 my-5 text-base font-medium text-white transition rounded bg-primary hover:bg-white hover:text-primary md:px-9 lg:px-6 xl:px-9">
                Mulai Tes Sekarang!
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ====== Hero Section End -->

  <!-- ====== Services Section Start -->
  <section class="overflow-hidden dark:bg-dark pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
    <div class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between -mx-4">
        <div class="w-full px-4 lg:w-6/12">
          <div class="flex relative items-center -mx-3 sm:-mx-4">
            <div class="w-full px-3 sm:px-4 xl:w-1/2">
              <div class="py-3 sm:py-4">
                <img src="src/images/service1.jpg" alt="" class="w-full rounded-2xl" />
              </div>
              <div class="py-3 sm:py-4">
                <img src="src/images/service3.jpg" alt="" class="w-full rounded-2xl" />
              </div>
            </div>

            <div class="absolute z-10 inset-0 flex items-center justify-center pointer-events-none">
              <div class="w-full flex justify-center">
                <img
                  src="src/images/service2.jpg"
                  alt=""
                  class="w-32 sm:w-40 md:w-48 lg:w-56 xl:w-64 rounded-full" />
              </div>
            </div>


            <div class="w-full px-3 sm:px-4 xl:w-1/2 mt-20">
              <div class="py-3 sm:py-4">
                <img src="src/images/service1.jpg" alt="" class="w-full rounded-2xl" />
              </div>
              <div class="relative my-4">
                <img src="src/images/service2.jpg" alt="" class="w-full rounded-2xl" />
                <span class="absolute -right-7 -bottom-7 z-[-1]">

                </span>
              </div>
            </div>
            
          </div>
        </div>
        <div class="w-full px-4 lg:w-1/2 xl:w-5/12">
          <div class="mt-10 lg:mt-0">
            <span class="block mb-4 text-lg font-semibold text-primary">
              Why Choose Us
            </span>
            <h2 class="mb-5 text-3xl font-bold text-dark dark:text-white sm:text-[40px]/[48px]">
              Growing Through Self-Awareness
            </h2>
            <p class="mb-5 text-base text-body-color dark:text-dark-6">
              Dalam dunia yang serba cepat seperti sekarang, mengenal diri sendiri adalah langkah penting untuk
              berkembang — baik secara pribadi maupun profesional.
              Salah satu metode yang kini banyak digunakan untuk memahami kepribadian dan potensi seseorang adalah
              STIFIn.

            </p>
            <p class="mb-8 text-base text-body-color dark:text-dark-6">
              STIFIn adalah konsep personality mapping yang dikembangkan berdasarkan teori psikologi dan neuroscience,
              dengan fokus pada dominasi fungsi otak seseorang.
              Berbeda dengan tes kepribadian konvensional, STIFIn menilai bagaimana cara berpikir, berperilaku, dan
              mengambil keputusan secara alami.

            </p>
            <a href="javascript:void(0)"
              class="inline-flex items-center justify-center py-3 text-base font-medium text-center text-white border border-transparent rounded-md px-7 bg-primary hover:bg-opacity-90">
              learn more
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== Services Section End -->


  <!-- ====== Footer Section Start -->
  <footer class="relative z-10 bg-primary  pt-20 ">
    <div class="container mx-auto">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full px-4 sm:w-2/3 lg:w-2/4">
          <div class="w-full mb-10">
            <a href="javascript:void(0)" class="mb-6 inline-block max-w-[160px]">
              <img src="src/images/logo_stifin.webp" alt="logo" class="max-w-full" />
            </a>
            <p class="text-dark-7 text-body-color dark:text-dark-6 mb-7">
              QW3P+G3, Jl. Pd. Kelapa Raya No.5B Blok F1, RT.6/RW.11, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur,
              Daerah Khusus Ibukota Jakarta 13450
            </p>
            <div class="flex items-center -mx-3">
              <a href="https://www.facebook.com/steps.co.id"
                class="px-3 hover:text-secondary text-dark-7 dark:text-white/40">
                <svg width="10" height="18" viewBox="0 0 10 18" class="fill-current">
                  <path
                    d="M9.00007 6.82105H7.50006H6.96434V6.27097V4.56571V4.01562H7.50006H8.62507C8.91971 4.01562 9.16078 3.79559 9.16078 3.46554V0.550085C9.16078 0.247538 8.9465 0 8.62507 0H6.66969C4.55361 0 3.08038 1.54024 3.08038 3.82309V6.21596V6.76605H2.54466H0.72322C0.348217 6.76605 0 7.06859 0 7.50866V9.48897C0 9.87402 0.294645 10.2316 0.72322 10.2316H2.49109H3.02681V10.7817V16.31C3.02681 16.6951 3.32145 17.0526 3.75003 17.0526H6.26791C6.42862 17.0526 6.56255 16.9701 6.66969 16.8601C6.77684 16.7501 6.8572 16.5576 6.8572 16.3925V10.8092V10.2591H7.4197H8.62507C8.97328 10.2591 9.24114 10.0391 9.29471 9.709V9.6815V9.65399L9.66972 7.7562C9.6965 7.56367 9.66972 7.34363 9.509 7.1236C9.45543 6.98608 9.21436 6.84856 9.00007 6.82105Z" />
                </svg>
              </a>
              <a href="https://www.instagram.com/stepscoid/"
                class="px-3 hover:text-secondary text-dark-7 dark:text-white/40">
                <svg width="18" height="18" viewBox="0 0 18 18" class="fill-current">
                  <path
                    d="M8.91688 12.4995C10.6918 12.4995 12.1306 11.0911 12.1306 9.35385C12.1306 7.61655 10.6918 6.20819 8.91688 6.20819C7.14197 6.20819 5.70312 7.61655 5.70312 9.35385C5.70312 11.0911 7.14197 12.4995 8.91688 12.4995Z" />
                  <path
                    d="M12.4078 0.947388H5.37075C2.57257 0.947388 0.300781 3.17104 0.300781 5.90993V12.7436C0.300781 15.5367 2.57257 17.7604 5.37075 17.7604H12.3524C15.2059 17.7604 17.4777 15.5367 17.4777 12.7978V5.90993C17.4777 3.17104 15.2059 0.947388 12.4078 0.947388ZM8.91696 13.4758C6.56206 13.4758 4.70584 11.6047 4.70584 9.35389C4.70584 7.10312 6.58976 5.23199 8.91696 5.23199C11.2165 5.23199 13.1004 7.10312 13.1004 9.35389C13.1004 11.6047 11.2442 13.4758 8.91696 13.4758ZM14.735 5.61164C14.4579 5.90993 14.0423 6.07264 13.5714 6.07264C13.1558 6.07264 12.7402 5.90993 12.4078 5.61164C12.103 5.31334 11.9368 4.9337 11.9368 4.47269C11.9368 4.01169 12.103 3.65916 12.4078 3.33375C12.7125 3.00834 13.1004 2.84563 13.5714 2.84563C13.9869 2.84563 14.4302 3.00834 14.735 3.30663C15.012 3.65916 15.2059 4.06593 15.2059 4.49981C15.1782 4.9337 15.012 5.31334 14.735 5.61164Z" />
                  <path
                    d="M13.5985 3.82184C13.2383 3.82184 12.9336 4.12013 12.9336 4.47266C12.9336 4.82519 13.2383 5.12349 13.5985 5.12349C13.9587 5.12349 14.2634 4.82519 14.2634 4.47266C14.2634 4.12013 13.9864 3.82184 13.5985 3.82184Z" />
                </svg>
              </a>
              <a href="javascript:void(0)"
                class="px-3 hover:text-secondary text-dark-7 dark:text-white/40">
                <svg width="18" height="18" viewBox="0 0 18 18" class="fill-current">
                  <path
                    d="M16.7821 0.947388H1.84847C1.14272 0.947388 0.578125 1.49747 0.578125 2.18508V16.7623C0.578125 17.4224 1.14272 18 1.84847 18H16.7257C17.4314 18 17.996 17.4499 17.996 16.7623V2.15757C18.0525 1.49747 17.4879 0.947388 16.7821 0.947388ZM5.7442 15.4421H3.17528V7.32837H5.7442V15.4421ZM4.44563 6.2007C3.59873 6.2007 2.94944 5.5406 2.94944 4.74297C2.94944 3.94535 3.62696 3.28525 4.44563 3.28525C5.26429 3.28525 5.94181 3.94535 5.94181 4.74297C5.94181 5.5406 5.32075 6.2007 4.44563 6.2007ZM15.4835 15.4421H12.9146V11.509C12.9146 10.5739 12.8864 9.33618 11.5596 9.33618C10.2045 9.33618 10.0069 10.3813 10.0069 11.4265V15.4421H7.438V7.32837H9.95046V8.45605H9.9787C10.3457 7.79594 11.1644 7.13584 12.4347 7.13584C15.0601 7.13584 15.54 8.7861 15.54 11.0414V15.4421H15.4835Z" />
                </svg>
              </a>
            </div>
          </div>
        </div>

        <div class="w-full px-4 sm:w-1/2 lg:w-1/4">
          <div class="w-full mb-10">
            <h4 class="text-lg font-semibold text-white dark:text-white mb-9">
              Company
            </h4>
            <ul class="space-y-3">
              <li>
                <a href="https://steps.co.id/"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  About company
                </a>
              </li>
              <li>
                <a href="https://steps.co.id/services/"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  Company services
                </a>
              </li>
              <li>
                <a href="https://steps.co.id/hubungi-kami/"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  Contact us
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="w-full px-4 sm:w-1/2 lg:w-1/4">
          <div class="w-full mb-10">
            <h4 class="text-lg font-semibold text-white dark:text-white mb-9">
              Get in Touch
            </h4>
            <ul class="space-y-3">
              <li>
                <a href="javascript:void(0)"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  <i class="fas fa-map-marker-alt mr-2"></i>
                  QW3P+G3, Jl. Pd. Kelapa Raya No.5B Blok F1, RT.6/RW.11, Pd. Klp., Kec. Duren Sawit, Kota Jakarta
                  Timur, Daerah Khusus Ibukota Jakarta 13450
                </a>
              </li>
              <li>
                <a href="tel:+6282130005021"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  <i class="fas fa-phone-alt mr-2"></i>
                  +62 082130005021
                </a>
              </li>
              <li>
                <a href="mailto:marketing@rusera.co.id"
                  class="inline-block text-dark-7 leading-loose text-body-color hover:text-secondary dark:text-dark-6">
                  <i class="fas fa-envelope mr-2"></i>
                  marketing@rusera.co.id
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ====== Footer Section End -->

  <!-- theme switcher -->
  <div
    class="fixed flex items-center justify-center bg-white rounded dark:bg-dark-3 z-[99999] shadow-1 dark:shadow-box-dark bottom-10 right-10 h-11 w-11">
    <label for="themeSwitcher" class="inline-flex items-center cursor-pointer" aria-label="themeSwitcher"
      name="themeSwitcher">
      <input type="checkbox" name="themeSwitcher" id="themeSwitcher" class="sr-only" />
      <span class="block text-body-color dark:hidden">
        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13.3125 1.50001C12.675 1.31251 12.0375 1.16251 11.3625 1.05001C10.875 0.975006 10.35 1.23751 10.1625 1.68751C9.93751 2.13751 10.05 2.70001 10.425 3.00001C13.0875 5.47501 14.0625 9.11251 12.975 12.525C11.775 16.3125 8.25001 18.975 4.16251 19.0875C3.63751 19.0875 3.22501 19.425 3.07501 19.9125C2.92501 20.4 3.15001 20.925 3.56251 21.1875C4.50001 21.75 5.43751 22.2 6.37501 22.5C7.46251 22.8375 8.58751 22.9875 9.71251 22.9875C11.625 22.9875 13.5 22.5 15.1875 21.5625C17.85 20.1 19.725 17.7375 20.55 14.8875C22.1625 9.26251 18.975 3.37501 13.3125 1.50001ZM18.9375 14.4C18.2625 16.8375 16.6125 18.825 14.4 20.0625C12.075 21.3375 9.41251 21.6 6.90001 20.85C6.63751 20.775 6.33751 20.6625 6.07501 20.55C10.05 19.7625 13.35 16.9125 14.5875 13.0125C15.675 9.56251 15 5.92501 12.7875 3.07501C17.5875 4.68751 20.2875 9.67501 18.9375 14.4Z" />
        </svg>
      </span>
      <span class="hidden text-white dark:block">
        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_2172_3070)">
            <path
              d="M12 6.89999C9.18752 6.89999 6.90002 9.18749 6.90002 12C6.90002 14.8125 9.18752 17.1 12 17.1C14.8125 17.1 17.1 14.8125 17.1 12C17.1 9.18749 14.8125 6.89999 12 6.89999ZM12 15.4125C10.125 15.4125 8.58752 13.875 8.58752 12C8.58752 10.125 10.125 8.58749 12 8.58749C13.875 8.58749 15.4125 10.125 15.4125 12C15.4125 13.875 13.875 15.4125 12 15.4125Z" />
            <path
              d="M12 4.2375C12.45 4.2375 12.8625 3.8625 12.8625 3.375V1.5C12.8625 1.05 12.4875 0.637497 12 0.637497C11.55 0.637497 11.1375 1.0125 11.1375 1.5V3.4125C11.175 3.8625 11.55 4.2375 12 4.2375Z" />
            <path
              d="M12 19.7625C11.55 19.7625 11.1375 20.1375 11.1375 20.625V22.5C11.1375 22.95 11.5125 23.3625 12 23.3625C12.45 23.3625 12.8625 22.9875 12.8625 22.5V20.5875C12.8625 20.1375 12.45 19.7625 12 19.7625Z" />
            <path
              d="M18.1125 6.74999C18.3375 6.74999 18.5625 6.67499 18.7125 6.48749L19.9125 5.28749C20.25 4.94999 20.25 4.42499 19.9125 4.08749C19.575 3.74999 19.05 3.74999 18.7125 4.08749L17.5125 5.28749C17.175 5.62499 17.175 6.14999 17.5125 6.48749C17.6625 6.67499 17.8875 6.74999 18.1125 6.74999Z" />
            <path
              d="M5.32501 17.5125L4.12501 18.675C3.78751 19.0125 3.78751 19.5375 4.12501 19.875C4.27501 20.025 4.50001 20.1375 4.72501 20.1375C4.95001 20.1375 5.17501 20.0625 5.32501 19.875L6.52501 18.675C6.86251 18.3375 6.86251 17.8125 6.52501 17.475C6.18751 17.175 5.62501 17.175 5.32501 17.5125Z" />
            <path
              d="M22.5 11.175H20.5875C20.1375 11.175 19.725 11.55 19.725 12.0375C19.725 12.4875 20.1 12.9 20.5875 12.9H22.5C22.95 12.9 23.3625 12.525 23.3625 12.0375C23.3625 11.55 22.95 11.175 22.5 11.175Z" />
            <path
              d="M4.23751 12C4.23751 11.55 3.86251 11.1375 3.37501 11.1375H1.50001C1.05001 11.1375 0.637512 11.5125 0.637512 12C0.637512 12.45 1.01251 12.8625 1.50001 12.8625H3.41251C3.86251 12.8625 4.23751 12.45 4.23751 12Z" />
            <path
              d="M18.675 17.5125C18.3375 17.175 17.8125 17.175 17.475 17.5125C17.1375 17.85 17.1375 18.375 17.475 18.7125L18.675 19.9125C18.825 20.0625 19.05 20.175 19.275 20.175C19.5 20.175 19.725 20.1 19.875 19.9125C20.2125 19.575 20.2125 19.05 19.875 18.7125L18.675 17.5125Z" />
            <path
              d="M5.32501 4.125C4.98751 3.7875 4.46251 3.7875 4.12501 4.125C3.78751 4.4625 3.78751 4.9875 4.12501 5.325L5.32501 6.525C5.47501 6.675 5.70001 6.7875 5.92501 6.7875C6.15001 6.7875 6.37501 6.7125 6.52501 6.525C6.86251 6.1875 6.86251 5.6625 6.52501 5.325L5.32501 4.125Z" />
          </g>
          <defs>
            <clipPath id="clip0_2172_3070">
              <rect width="24" height="24" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </span>
    </label>
  </div>

  <!-- theme switcher -->
  <script defer src="./src/js/bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script>
    const swiper2 = new Swiper(".swiper2", {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      effect: "fade",
    });
    // Huruf pagination custom
    const paginationLetters = ["S", "T", "I", "F", "In"];
    const paginationContainer = document.getElementById("pagination");

    // Tambahkan style untuk pagination dan state active (warna primary)
    const paginationStyle = document.createElement("style");
    paginationStyle.innerHTML = `
      #pagination { display:flex; flex-direction:column; gap:0.5rem; }
      .pagination-letter {
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:36px;
      height:36px;
      border-radius:9999px;
      background:#ffffff;
      color:#6b7280; /* gray-500 */
      border:1px solid #e5e7eb; /* gray-200 */
      font-weight:600;
      cursor:pointer;
      transition: all .18s ease;
      }
      .pagination-letter.active {
      background: #3A6F43; /* primary */
      color: #ffffff;
      border-color: #3A6F43;
      }
    `;
    document.head.appendChild(paginationStyle);

    // Render pagination letters
    paginationLetters.forEach((letter, i) => {
      const span = document.createElement("span");
      span.textContent = letter;
      span.className = "pagination-letter";
      span.dataset.index = i;
      span.addEventListener("click", () => {
        // pindah slide dan update langsung tampilan pagination
        // gunakan slideTo karena index sesuai urutan slide non-loop
        swiper.slideTo(i);
        updatePagination(i);
      });
      paginationContainer.appendChild(span);
    });

    // Inisialisasi Swiper
    const swiper = new Swiper(".swiper", {
      direction: "vertical",
      slidesPerView: 1,
      spaceBetween: 30,
      mousewheel: true,
      on: {
        slideChange: () => updatePagination(typeof swiper.realIndex === "number" ? swiper.realIndex : swiper.activeIndex),
      },
      autoplay: {
        delay: 3000, // waktu perpindahan (ms)
        disableOnInteraction: false, // tetap jalan walau user interaksi
      },
    });

    // --- Penambahan: background per-slide ---
    // Array warna background untuk tiap slide (sesuaikan sesuai kebutuhan)
    const slideBackgrounds = [
      "#8A0000", // S
      "#211832", // T
      "#4E56C0", // I
      "#59AC77", // F
      "#F97A00" // In
    ];

    // Container swiper utama
    const swiperContainer = document.querySelector(".swiper");
    // Beri transisi halus pada perubahan background
    if (swiperContainer) {
      swiperContainer.style.transition = "background-color 300ms ease";
    }

    // Fungsi pause on hover
    const swiperEl = document.querySelector(".swiper");
    swiperEl.addEventListener("mouseenter", () => swiper.autoplay.stop());
    swiperEl.addEventListener("mouseleave", () => swiper.autoplay.start());

    // Fungsi update warna aktif pada pagination + ubah background sesuai slide
    function updatePagination(activeIndex) {
      // pastikan index valid (untuk safety jika activeIndex lebih besar dari jumlah)
      const idx = Math.max(0, Math.min(activeIndex, paginationLetters.length - 1));

      document.querySelectorAll(".pagination-letter").forEach((el, i) => {
        el.classList.toggle("active", i === idx);
      });

      // update background swiper jika tersedia warna untuk index tersebut
      if (swiperContainer && slideBackgrounds[idx]) {
        swiperContainer.style.backgroundColor = slideBackgrounds[idx];
      }
    }

    // Set default aktif di awal
    updatePagination(0);
  </script>
</body>

</html>