<?php require_once __DIR__ . '/../config.php'; ?>

<!-- Navigation -->
<div class="bg-blue-500 fixed top-0 left-0 w-full">
  <div class="container mx-auto h-20 px-4 flex justify-between items-center">
    <a href="/" class="flex items-center">
      <img src="/../images/logo-aplus.png" alt="logo" class="h-20">
      <h1 class="text-4xl text-white">คำนวณเกรด</h1>
    </a>
    <ul class="gap-4 hidden md:flex">
      <li><a class="text-white text-lg" href="/">ผลการเรียน</a></li>
      <li><a class="text-white text-lg" href="<?= PAGES_PATH ?>/manage_courses.php">จัดการรายวิชา</a></li>
      <li><a class="text-white text-lg" href="<?= PAGES_PATH ?>/add_course.php">เพิ่มรายวิชา</a></li>
    </ul>
  </div>
</div>
