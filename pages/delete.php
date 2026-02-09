<?php
  require_once __DIR__ . '/../config.php';
  session_start();

  if (!isset($_POST['key']) || !isset($_SESSION['course_list']) || !array_key_exists($_POST['key'], $_SESSION['course_list'])) {
    header('Location: ' . PAGES_PATH . '/manage_courses.php');
    exit;
  }

  $key = (int) $_POST['key'];
  unset($_SESSION['course_list'][$key]);
  $_SESSION['course_list'] = array_values($_SESSION['course_list']);

  header('Location: ' . PAGES_PATH . '/manage_courses.php');
  exit;
?>