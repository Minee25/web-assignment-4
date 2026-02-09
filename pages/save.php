<?php
  require_once __DIR__ . '/../config.php';
  session_start();

  $_SESSION['course_list'] = $_SESSION['course_list'] ?? [];

  $subject_name = trim($_POST['subject_name'] ?? '');
  $credit = $_POST['credit'] ?? '';
  $grade = $_POST['grade'] ?? '';

  if ($subject_name !== '' && $credit !== '') {
    $_SESSION['course_list'][] = [
      'subject_name' => $subject_name,
      'credit'       => $credit,
      'grade'        => $grade,
    ];
  }

  header('Location: ' . PAGES_PATH . '/manage_courses.php');
  exit;
?>