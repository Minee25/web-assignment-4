<?php
  require_once __DIR__ . '/../config.php';
  session_start();

  $_SESSION['course_list'] = $_SESSION['course_list'] ?? [];

  $key = (int) $_POST['key'];
  $subject_name = trim($_POST['subject_name'] ?? '');
  $credit = $_POST['credit'] ?? 0;
  $grade = $_POST['grade'] ?? '';

  if ($key < 0 || $subject_name === '' || $credit < 1 || $credit > 10 || !isset($_SESSION['course_list'][$key])) {
    header('Location: ' . PAGES_PATH . '/manage_courses.php');
    exit;
  }

  if (isset($_SESSION['course_list'][$key])) {
    $_SESSION['course_list'][$key]['subject_name'] = $subject_name;
    $_SESSION['course_list'][$key]['credit'] = $credit;
    $_SESSION['course_list'][$key]['grade'] = $grade;
  }

  header('Location: ' . PAGES_PATH . '/manage_courses.php');
exit;
