<?php require_once __DIR__ . '/../config.php'; ?>
<?php session_start(); ?>

<?php $_SESSION['course_list'] = $_SESSION['course_list'] ?? []; ?>

<!-- -------------------------------------------------- -->
<!-- Head -->
<?php $title = 'จัดการรายวิชา'; ?>
<?php include PARTIALS_PATH . '/head.php'; ?>

<!-- Body -->
  <?php include ROOT_PATH . '/partials/nav.php'; ?>

  <div class="container mx-auto">
    <div class="flex flex-col justify-center items-center min-h-[calc(100vh-80px)] p-4">
      <div class="w-full max-w-4xl bg-white shadow-xl rounded-lg p-6 border">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">จัดการรายวิชา</h1>
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
                  <th class="p-3 text-center">ชื่อวิชา</th>
                  <th class="p-3 text-center">หน่วยกิต</th>
                  <th class="p-3 text-center">เกรด</th>
                  <th class="p-3 text-center">จัดการ</th>
                </tr>
              </thead>
              <tbody class="text-gray-700">
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
                  $count = 1;
                ?>
                <?php foreach($_SESSION['course_list'] as $key => $course) { ?>
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-left"><?= $key + 1 ?></td>
                    <td class="p-3 text-left"><?= htmlspecialchars($course['subject_name']) ?></td>
                    <td class="p-3 text-center"><?= htmlspecialchars($course['credit']) ?></td>
                    <td class="p-3 text-center font-bold">
                      <span class="<?= $gradeColors[$course['grade']] ?? 'text-gray-500' ?>">
                        <?= htmlspecialchars($course['grade']) ?>
                      </span>
                    </td>
                    <td class="p-3 text-center flex gap-2 justify-center">
                      <button data-key="<?= $key ?>" data-subject_name="<?= htmlspecialchars($course['subject_name']) ?>" data-credit="<?= $course['credit'] ?>" data-grade="<?= $course['grade'] ?>" class="edit-form cursor-pointer text-blue-500 font-medium rounded-lg text-md outline-none hover:text-blue-700 active:ring-2 active:ring-blue-300 duration-300">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <?php if (empty($course['grade'])) { ?>
                        <form action="delete.php" method="post" class="delete-form">
                          <input type="hidden" name="key" value="<?= $key ?>">
                          <button class="cursor-pointer text-red-500 font-medium rounded-lg text-md outline-none hover:text-red-700 active:ring-2 active:ring-red-300 duration-300">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>

        <!-- Footer -->
        <div class="mt-6 flex justify-between items-center">
          <div>
            <a href="/" class="cursor-pointer text-white bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-blue-700 active:ring-2 active:ring-blue-300 duration-300">หน้าหลัก</a>
            <a href="/pages/add_course.php" class="cursor-pointer text-white bg-green-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-green-700 active:ring-2 active:ring-green-300 duration-300">เพิ่มรายวิชา</a>
          </div>
          <div class="text-right">
            <?php if (!empty($_SESSION['course_list'])) { ?>
              <form action="clear.php" method="post" class="clear-all-form">
                <button class="cursor-pointer text-red-500 font-medium rounded-lg text-md outline-none hover:text-red-700 active:ring-2 active:ring-red-300 duration-300">
                  <i class="fa-solid fa-trash"></i> Clear
                </button>
              </form>
            <?php } ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    const deleteForms = document.querySelectorAll(".delete-form");
    const clearAllForm = document.querySelector(".clear-all-form");
    const editForms = document.querySelectorAll(".edit-form");

    deleteForms.forEach((form) => {
      form.addEventListener("submit", function(e) {
        e.preventDefault();

        Swal.fire({
          title: "คุณต้องการลบหรือไม่?",
          text: "คุณลบแล้วจะไม่สามารถย้อนกลับได้!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "ลบเลย",
          cancelButtonText: "ยกเลิก"
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit(); 
          }
        });
      });
    });

    clearAllForm.addEventListener("submit", function(e) {
      e.preventDefault();

      Swal.fire({
        title: "คุณต้องการเคลียร์หรือไม่",
        text: "คุณเคลียร์ทุกอย่างแล้วจะไม่สามารถย้อนกลับได้!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "ลบเลย",
        cancelButtonText: "ยกเลิก"
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      });
    });

    editForms.forEach((form) => {
      form.addEventListener("click", function(e) {
        e.preventDefault();
        
        const key = this.dataset.key;
        const subjectName = this.dataset.subject_name;
        const credit = this.dataset.credit;
        const grade = this.dataset.grade;

        Swal.fire({
          title: "แก้ไขข้อมูล",
          html: `
            <form action="edit.php" method="post" class="p-4">
              <input type="hidden" name="key" value="${key}">

              <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                  <label for="subject-name" class="block text-left my-2 text-sm text-gray-600">
                    ชื่อวิชา <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="subject_name" value="${subjectName}" id="subject-name" placeholder="เช่น Data Structures" required class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
                </div>

                <div>
                  <label for="credit" class="block text-left my-2 text-sm text-gray-600">
                    หน่วยกิต <span class="text-red-500">*</span>
                  </label>
                  <input type="number" name="credit" value="${credit}" id="credit" placeholder="เช่น 3" min="1" max="10" required class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
                </div>

                <div class="">
                  <label for="credit" class="block text-left my-2 text-sm text-gray-600">
                    หน่วยกิต <span class="text-red-500">*</span>
                  </label>
                  <select name="grade" value="${grade}" id="grade" class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
                    <option value="">เลือกเกรด</option>
                    <option value="A">A</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="C+">C+</option>
                    <option value="C">C</option>
                    <option value="D+">D+</option>
                    <option value="D">D</option>
                    <option value="F">F</option>
                  </select>
                </div>
              </div>

              <!-- Action Button -->
              <div class="w-full flex justify-end mt-8 gap-4">
                <a href="/pages/manage_courses.php" class="cursor-pointer text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-gray-700 active:ring-2 active:ring-gray-300 duration-300">ยกเลิก</a>
                <button type="submit" class="cursor-pointer text-white bg-green-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-green-700 active:ring-2 active:ring-green-300 duration-300">ลงทะเบียน</button>
              </div>
            </form>
          `,
          showCancelButton: false,
          showConfirmButton: false
        });
      });
    });
  </script>

<?php include PARTIALS_PATH . '/footer.php'; ?>