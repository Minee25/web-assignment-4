<?php require_once __DIR__ . '/../config.php'; ?>
<?php session_start(); ?>

<!-- -------------------------------------------------- -->
<!-- Head -->
<?php $title = 'เพิ่มรายวิชา'; ?>
<?php include PARTIALS_PATH . '/head.php'; ?>

<!-- Body -->
  <?php include PARTIALS_PATH . '/nav.php'; ?>

  <div class="flex flex-col justify-center items-center min-h-[calc(100vh-80px)] p-4">
    <div class="w-full max-w-2xl rounded-lg shadow-lg">

      <div class="bg-blue-500 rounded-t-lg ">
        <h1 class="text-white text-center text-3xl p-3">เพิ่มรายวิชา</h1>
      </div>

      <form action="save.php" method="post" class="p-4">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <label for="subject-name" class="block my-2 text-sm text-gray-600">
              ชื่อวิชา <span class="text-red-500">*</span>
            </label>
            <input type="text" name="subject_name" id="subject-name" placeholder="เช่น Data Structures" required class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
          </div>

          <div>
            <label for="credit" class="block my-2 text-sm text-gray-600">
              หน่วยกิต <span class="text-red-500">*</span>
            </label>
            <input type="number" name="credit" id="credit" placeholder="เช่น 3" min="1" max="10" required class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
          </div>

          <div class="">
            <label for="credit" class="block my-2 text-sm text-gray-600">
              หน่วยกิต <span class="text-red-500">*</span>
            </label>
            <select name="grade" id="grade" class="w-full p-2.5 text-black bg-gray-50 text-base rounded-lg border focus:outline focus:outline-2 focus:outline-blue-500 focus:ring-blue-500 focus:border-blue-500 block">
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
          <button type="submit" class="cursor-pointer text-white bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 outline-none hover:bg-blue-700 active:ring-2 active:ring-blue-300 duration-300">ลงทะเบียน</button>
        </div>
      </form>

    </div>
  </div>

<?php include PARTIALS_PATH . '/footer.php'; ?>