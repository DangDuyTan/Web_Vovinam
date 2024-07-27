<!DOCTYPE html>
<html lang="en">
<?php require('config.php') ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
		<script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
<!--		<script type="text/javascript">
			window.tailwind.config = {
				darkMode: ['class'],
				theme: {
					extend: {
						colors: {
							border: 'hsl(var(--border))',
							input: 'hsl(var(--input))',
							ring: 'hsl(var(--ring))',
							background: 'hsl(var(--background))',
							foreground: 'hsl(var(--foreground))',
							primary: {
								DEFAULT: 'hsl(var(--primary))',
								foreground: 'hsl(var(--primary-foreground))'
							},
							secondary: {
								DEFAULT: 'hsl(var(--secondary))',
								foreground: 'hsl(var(--secondary-foreground))'
							},
							destructive: {
								DEFAULT: 'hsl(var(--destructive))',
								foreground: 'hsl(var(--destructive-foreground))'
							},
							muted: {
								DEFAULT: 'hsl(var(--muted))',
								foreground: 'hsl(var(--muted-foreground))'
							},
							accent: {
								DEFAULT: 'hsl(var(--accent))',
								foreground: 'hsl(var(--accent-foreground))'
							},
							popover: {
								DEFAULT: 'hsl(var(--popover))',
								foreground: 'hsl(var(--popover-foreground))'
							},
							card: {
								DEFAULT: 'hsl(var(--card))',
								foreground: 'hsl(var(--card-foreground))'
							},
						},
					}
				}
			}
		</script> -->
        <style>
            <?php 
            //require('../../css/admin/sidebar.css');
            //require('../../css/admin/header_admin.css');
            //require('../../css/admin/footer_admin.css');
            require('css/Judge-score.css');

            ?>
        </style>
  </head>
  <body>
    <div class="flex h-screen">
        <div class="flex-1 p-6 bg-zinc-100">
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h1 class="text-2xl font-semibold">Quản lý chấm thi</h1>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div>
                        <label for="khoa-thi" class="block text-zinc-700">Khóa thi:</label>
                    <!--<select id="khoa-thi" class="w-full border border-zinc-300 rounded p-2">
                            <option>Vui lòng chọn</option>
                            <option>Kỳ thi Thu 2024</option>
                        </select> -->
                    </div>
                    <div>
                        <label for="cap-dai-du-thi" class="block text-zinc-700">Cấp đai dự thi:</label>
                    <!--    <select id="cap-dai-du-thi" class="w-full border border-zinc-300 rounded p-2">
                            <option>Vui lòng chọn</option>
                            <option>Tự Vệ</option>
                        </select> -->
                    </div>
                    <div>
                        <label for="phan-thi" class="block text-zinc-700">Phần thi:</label>
                    <!--    <select id="phan-thi" class="w-full border border-zinc-300 rounded p-2">
                            <option>Vui lòng chọn</option>
                            <option>Đơn Luyện</option>
                        </select> -->
                    </div>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" id= "" >Lọc</button>
            </div>

            <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
                <h2 class="text-xl font-semibold mb-4">Danh sách chấm thi</h2>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Họ tên</th>
                            <th class="border px-4 py-2">Mã thẻ</th>
                            <th class="border px-4 py-2">Khóa thi</th>
                            <th class="border px-4 py-2">Cấp đai dự thi</th>
                            <th class="border px-4 py-2">Phần thi</th>
                            <th class="border px-4 py-2">Thuộc bài 5d</th>
                            <th class="border px-4 py-2">Nhanh mạnh 2d</th>
                            <th class="border px-4 py-2">Tấn pháp 2d</th>
                            <th class="border px-4 py-2">Thuyết phục 1d</th>
                            <th class="border px-4 py-2">Tổng điểm</th>
                            <th class="border px-4 py-2">Kết quả</th>
                            <th class="border px-4 py-2">Ghi chú</th>
                            <th class="border px-4 py-2">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="danhsachChamThi">
                    <!--    <tr>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">Đỗ Tiến Đạt</td>
                            <td class="border px-4 py-2">xxx</td>
                            <td class="border px-4 py-2">xxx</td>
                            <td class="border px-4 py-2">xxx</td>
                            <td class="border px-4 py-2">xxx</td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded mb-1">Lưu</button>
                            <button class="bg-yellow-500 text-white px-2 py-1 rounded">Sửa</button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                <!-- <div class="phan-trang">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div> -->
            </div>
        </div>
    </div>
  </body>
</html>