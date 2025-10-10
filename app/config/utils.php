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
function rememberMe($conn)
{
  if (isset($_COOKIE['auth_token'])) {
    $token = $_COOKIE['auth_token'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['profile'] = base_url() ."/". $row['image'];
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $row['role'];
        header('location: '.base_url() .'/src/pages/dashboard/index.php');
        exit();
    }
  }
}