<?php 

function base_url()
{
  // Determine the protocol
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";

  // Get the host name
  $host = $_SERVER['HTTP_HOST'];

  // Get the base directory
  $baseDir = dirname($_SERVER['SCRIPT_NAME']);
  $baseDir = explode('/', $baseDir);

  // Combine to form the base URL
  $baseUrl = $protocol . $host . "/". $baseDir[1]; //turn to 1 if you using xampp, 0 if you using laragon

  // Return the base URL
 return rtrim($baseUrl, '/'); // Remove trailing slash if necessary
}

function generate_varchar($length = 8) {
  if ($length > 8) {
      throw new Exception("Maksimum panjang adalah 30 karakter");
  }
  return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
}