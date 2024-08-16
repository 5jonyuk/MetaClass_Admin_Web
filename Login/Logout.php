<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page or login page after logout
// echo "<meta http-equiv='refresh' content='1 url=../LoginHome.html'>"; // Assuming the home page is named index.php
// exit();
die("<script>
alert('로그아웃 되었습니다!');
location.href='../LoginHome.html';
</script>");
?>