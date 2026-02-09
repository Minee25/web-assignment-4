<?php
  require_once __DIR__ . '/../config.php';
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['course_list'])) {
      unset($_SESSION['course_list']);
    }
  }

  header('Location: ' . PAGES_PATH . '/manage_courses.php');
exit;
