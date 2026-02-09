<?php require_once __DIR__ . '/config.php'; ?>
<?php session_start(); ?>

<?php $_SESSION['course_list'] = $_SESSION['course_list'] ?? []; ?>

<?php
  $gradeColors = [
    'A'  => 'text-green-600',
    'B+' => 'text-green-500',
    'B'  => 'text-yellow-500',
    'C+' => 'text-orange-500',
    'C'  => 'text-orange-600',
    'D+'  => 'text-red-500',
    'D'  => 'text-red-500',
    'F'  => 'text-red-700'
  ];

  $gradeScores = [
    'A'  => 4,
    'B+' => 3.5,
    'B'  => 3,
    'C+' => 2.5,
    'C'  => 2,
    'D+'  => 1.5,
    'D'  => 1,
    'F'  => 0
  ];

  $count = 1;
  $sumCredit = 0;
  $sumScore = 0.0;
?>

<!-- -------------------------------------------------- -->
<!-- Head -->
<?php $title = 'ผลการเรียน'; ?>
<?php include PARTIALS_PATH . '/head.php'; ?>

<!-- Body -->
  <?php include PARTIALS_PATH . '/nav.php'; ?>

  <div class="container mx-auto">
    <div class="flex flex-col justify-center items-center min-h-[calc(100vh-80px)] p-4">
      <div class="w-full max-w-4xl bg-white shadow-xl rounded-md p-6 border">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">ผลการเรียน</h1>
            <p class="text-sm text-gray-500">รหัสนิสิต: 65123456</p>
          </div>
        </div>

        <!-- Table -->
        <?php if (empty($_SESSION['course_list'])) { ?>
          <p class="bg-gray-100 text-gray-500 text-center rounded-md py-3">ยังไม่มีรายวิชา</p>
        <?php } else { ?>
          <div class="overflow-x-auto">
            <table class="w-full border-collapse">
              <thead>
                <tr class="bg-gray-100 text-gray-600 text-sm">
                  <th class="p-3 text-left">ลำดับ</th>
                  <th class="p-3 text-left">ชื่อวิชา</th>
                  <th class="p-3 text-center">หน่วยกิต</th>
                  <th class="p-3 text-center">เกรด</th>
                </tr>
              </thead>
              <tbody class="text-gray-700">
                <?php foreach($_SESSION['course_list'] as $key => $course) { ?>
                <?php 
                  $sumCredit += $course['credit']; 
                  $sumScore += $course['credit'] * ($gradeScores[$course['grade']] ?? 0);
                ?>
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-left"><?php echo($count); $count++;?></td>
                    <td class="p-3 text-left"><?= htmlspecialchars($course['subject_name']) ?></td>
                    <td class="p-3 text-center"><?= htmlspecialchars($course['credit']) ?></td>
                    <td class="p-3 text-center font-bold">
                      <span class="<?= $gradeColors[$course['grade']] ?? 'text-gray-500' ?>">
                        <?= htmlspecialchars($course['grade']) ?>
                      </span>
                    </td>
                  </tr>
                <?php } ?>
                  <tr class="border-b bg-blue-100">
                    <td class="p-3 text-left text-green-500 font-bold">สรุปผล</td>
                    <td class="p-3 text-left text-green-500 font-bold">-</td>
                    <td class="p-3 text-center text-green-500 font-bold"><?= $sumCredit ?></td>
                    <td class="p-3 text-center text-green-500 font-bold"><?= number_format($sumScore, 2) ?></td>
                  </tr>
              </tbody>
            </table>
          </div>
        <?php } ?>

        <!-- Footer -->
        <div class="mt-6 flex justify-between items-center">
          <div>
            <a href="/pages/manage_courses.php" class="block cursor-pointer text-white bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-blue-700 active:ring-2 active:ring-blue-300 duration-300">
              จัดการรายวิชา
            </a>
          </div>
          <div class="text-right">
            <p class="text-gray-600">GPA</p>
            <p class="text-3xl font-bold text-gray-800"><?= $gpa = $sumCredit > 0 ? round($sumScore / $sumCredit, 2) : 0; ?></p>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php include PARTIALS_PATH . '/footer.php'; ?>