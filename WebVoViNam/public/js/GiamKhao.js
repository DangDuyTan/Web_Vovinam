async function getListPDiem() {
    try {
      // Gọi AJAX để xóa payment
      let response = await fetch("/api/judge/getPD", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "function=" + encodeURIComponent("getListPDiem"),
      });
      // Kiểm tra trạng thái của phản hồi
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      // Ghi lại dữ liệu trả về từ API
      let data = await response.json();
      console.log("Dữ liệu PD nhận được từ API:", data);
      await showTablePD(data);
      loadPage();
    } catch (error) {
      console.error(error);
    }
  }
  async function btnLoc() {
    try {
        const khoaThi = document.getElementById('khoa-thi').value;
        const capDai = document.getElementById('cap-dai-du-thi').value;
        const phanThi = document.getElementById('phan-thi').value;

        let response = await fetch("/api/judge/getPD", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `function=getListPDiem&khoaThi=${encodeURIComponent(khoaThi)}&capDai=${encodeURIComponent(capDai)}&phanThi=${encodeURIComponent(phanThi)}`,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let data = await response.json();
        console.log("Dữ liệu Lọc nhận được từ API:", data);
        await showTablePD(data);
        loadPage();
    } catch (error) {
        console.error(error);
    }
}

document.getElementById('locdanhsach').addEventListener('click', btnLoc);

async function getSelect() {
  try {
      let response = await fetch("/api/judge/getPD", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "function=" + encodeURIComponent("getSelect"),
      });

      if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
      }

      let data = await response.json();
      console.log("Dữ liệu select nhận được từ API:", data);

       // Update select options with received data
    const selectKhoaThi = document.getElementById('khoa-thi');
    const selectCapDai = document.getElementById('cap-dai-du-thi');
    const selectPhanThi = document.getElementById('phan-thi');

    selectKhoaThi.innerHTML = '<option value="">Chọn Khóa Thi</option>';
    selectCapDai.innerHTML = '<option value="">Chọn Cấp Đai</option>';
    selectPhanThi.innerHTML = '<option value="">Chọn Phần Thi</option>';

    data['khoaThi'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maKhoaThi'];
      newOption.text = option['tenKhoaThi'];
      selectKhoaThi.appendChild(newOption);
    });

    data['capDai'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maCapDai'];
      newOption.text = option['tenCapDai'];
      selectCapDai.appendChild(newOption);
    });

    data['phanThi'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maKyThuat'];
      newOption.text = option['tenKyThuat'];
      selectPhanThi.appendChild(newOption); // typo: should be selectPhanThi
    });
        
    } catch (error) {
        console.error(error);
    }
}


  async function showTablePD(data) {
    console.log("Dữ liệu PD trong loadData:", data);  // Ghi lại dữ liệu nhận được để kiểm tra
  
    let container = document.getElementById("danhsachChamThi");
    let container1 = document.getElementById("save-CTPD");
    let container2 = document.getElementById("edit-CTPD");
    let result = "";
    let result1 = ``;
    let result2 = ``;
    let stt = 1;
  
    for (let i of data) {
      
      result  += `
        <tr>
          <td>${stt}</td>
          <td>${i.hoTen}</td>
          <td>${i.maThe}</td>
          <td>${i.tenKhoaThi}</td>
          <td>${i.tenCapDai}</td>
          <td>${i.tenKyThuat}</td>
          <td>${i.ThuocBai}</td>
          <td>${i.NhanhManh}</td>
          <td>${i.TanPhap}</td>
          <td>${i.ThuyetPhuc}</td>
          <td>${i.TongDiem}</td>
          <td>${i.KetQua}</td>
          <td>${i.GhiChu}</td>
          <td>
              <button class="save-button" data-id="${i.maCTPhieuDiem}">Lưu</button>
              <button class="edit-button" data-id="${i.maCTPhieuDiem}">Sửa</button>
          </td>
        </tr>
        `;
 /* 
      let String1 = `
        <div class="modal fade" id="saveCTPD-${i.maCTPhieuDiem}" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveModalLabel">Lưu thành công</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn muốn lưu thông tin điểm?
                    <br>
                    Tên học viên: ${i.maCTPhieuDiem}-${i.maMonSinh}
                    <br>
                    Mã thẻ: ${i.maCTPhieuDiem}-${i.maThe}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-save" onclick="updateScore('${i.maCTPhieuDiem}')">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    
          `;
          
      let String2 = `
        <div class="modal fade" id="editCTPD-${i.maCTPhieuDiem}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Sửa điểm học viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên học viên</label>
                            <input type="text" class="form-control" id="${i.maCTPhieuDiem}-${i.maMonSinh}" value="${i.maMonSinh}"  disabled>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Mã Thẻ</label>
                            <input type="text" class="form-control" id="${i.maCTPhieuDiem}-${i.maThe}" value="${i.maThe}" disabled">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Thuộc Bài (5d)</label>
                            <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.ThuocBai}" value="${i.ThuocBai}" min="0" max="5" width"48" height="48" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nhanh Mạnh (2d)</label>
                            <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.NhanhManh}" value="${i.NhanhManh}" min="0" max="2" width"5" height="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tấn Pháp (2d)</label>
                            <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.TanPhap}" value="${i.TanPhap}" min="0" max="2" width"5" height="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Thuyết Phục (1d)</label>
                            <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.ThuyetPhuc}" value="${i.ThuyetPhuc}" min="0" max="1" width"5" height="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="brandsuppliers" class="form-label">Ghi Chú</label>
                            <input type="text" class="form-control" id="${i.maCTPhieuDiem}-${i.GhiChu}" value="${i.GhiChu}" size = "20">
                        </div>
                        <div style="text-align:right;">
                            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                                onclick="updateScore('${i.maCTPhieuDiem}', 
                                '${i.maCTPhieuDiem}-${i.ThuocBai}', 
                                '${i.maCTPhieuDiem}-${i.NhanhManh}',
                                '${i.maCTPhieuDiem}-${i.TanPhap}',
                                '${i.maCTPhieuDiem}-${i.ThuyetPhuc}',
                                '${i.maCTPhieuDiem}-${i.GhiChu}',
                                event)">Sửa người dùng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
          `;
          
      
      result1 += String1;
      result2 += String2;
      */
      stt++;
    }
    
    container.innerHTML = result;
   /*  container1.innerHTML = result1;
     console.log(result1);
     container2.innerHTML = result2;
     console.log(result2);
     */
  }

function validateNumber(input) {
  // Kiểm tra giá trị của input dựa trên pattern và chỉnh sửa nếu cần thiết
  const pattern = new RegExp(input.pattern);
  if (!pattern.test(input.value)) {
      input.setCustomValidity("Giá trị nhập không hợp lệ.");
      input.reportValidity(); // Hiển thị thông báo lỗi
  } else {
      input.setCustomValidity(""); // Xóa thông báo lỗi nếu giá trị hợp lệ
  }
}
function isValidNumber(value) {
  return /^\d*\.?\d+$/.test(value);
}
  async function EditBtn() {
    document.addEventListener('click', function (event) {
        if (event.target.matches('.edit-button')) {
            let row = event.target.closest('tr');
            row.querySelectorAll('td').forEach(function (td, index) {
                if (index == 6 || index == 7 || index == 8 || index == 9 || index == 12) { // Chỉ các cột cần chỉnh sửa
                    let content = td.textContent;
                    let inputType = (index == 12) ? 'text' : 'number';
                    let maxVal = (index == 6) ? 5 : (index == 7 || index == 8) ? 2 : (index == 9) ? 1 : '';
                    td.innerHTML = `<input type="${inputType}" value="${content}" 
                                    ${maxVal ? `min="0" max="${maxVal}" pattern="\\d*\\.?\\d+"` : ''} 
                                    oninput="validateNumber(this)" required/>`;

                  }
            });
        }
      });
    }
    async function SaveBtn() {
      document.addEventListener('click', function (event) {
          if (event.target.matches('.save-button')) {
              let row = event.target.closest('tr');
              let maCTPhieuDiem = event.target.dataset.id;
              
              if (!maCTPhieuDiem) {
                  console.error('Mã CT Phiếu Điểm không tồn tại.');
                  return;
              }
  
              let ThuocBai = row.querySelector('td:nth-child(7) input').value;
              let NhanhManh = row.querySelector('td:nth-child(8) input').value;
              let TanPhap = row.querySelector('td:nth-child(9) input').value;
              let ThuyetPhuc = row.querySelector('td:nth-child(10) input').value;
              let GhiChu = row.querySelector('td:nth-child(13) input').value;
  
              fetch('/api/judge/getPD', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                      function: 'updateScore',
                      maCTPhieuDiem: maCTPhieuDiem,
                      ThuocBai: ThuocBai,
                      NhanhManh: NhanhManh,
                      TanPhap: TanPhap,
                      ThuyetPhuc: ThuyetPhuc,
                      GhiChu: GhiChu
                  }),
              })
              .then(response => response.json())
              .then(data => {
                  console.log("Dữ liệu edit and save nhận được từ API:", data);
                  if (data === true) {
                      row.querySelectorAll('td').forEach(function (td, index) {
                          if (index === 6 || index === 7 || index === 8 || index === 9 || index === 12) { // Chỉ các cột cần chỉnh sửa
                              let input = td.querySelector('input');
                              if (input) {
                                  td.textContent = input.value;
                                  input.disabled = true;
                              }
                          }
                      });
                      // Cập nhật giá trị TongDiem và KetQua
                      let Diem = parseFloat(ThuocBai) + parseFloat(NhanhManh) + parseFloat(TanPhap) + parseFloat(ThuyetPhuc);
                      row.querySelector('td:nth-child(11)').textContent = Diem.toFixed(2);
                      row.querySelector('td:nth-child(12)').textContent = Diem >= 5 ? 'Đạt' : 'Không đạt';
                      console.log('Cập nhật thành công');
                  } else {
                      console.error('Cập nhật thất bại', data);
                  }
              })
              .catch(error => {
                  console.error('Lỗi trong quá trình cập nhật:', error);
              });
          }
      });
  }
  

async function DanhSachKQ() {
  try {
    // Gọi AJAX để xóa payment
    let response = await fetch("/api/judge/getKQ", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("DanhSachKQ"),
    });
    // Kiểm tra trạng thái của phản hồi
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    // Ghi lại dữ liệu trả về từ API
    let data = await response.json();
    console.log("Dữ liệu dskq nhận được từ API:", data);
    await showTablePD(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}



  function loadItem(thisPage, limit) {
    // tính vị trí bắt đầu và kêt thúc
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
  
    // lấy tất cả các dòng dữ liệu có trong bảng
    let all_data_rows = document.querySelectorAll("#danhsachChamThi > tr");
  
    all_data_rows.forEach((item, index) => {
      if (index >= beginGet && index <= endGet) {
        item.style.display = "table-row";
      } else {
        item.style.display = "none";
      }
    });
  
    // hàm tính có bao nhieu nút chuyển trang
    listPage(thisPage, limit, all_data_rows);
    // loadPage();
  }

  function listPage(thisPage, limit, all_data_rows) {
    let result = "";
    let count = Math.ceil(all_data_rows.length / limit);
    // thêm nút prev
  
    if (thisPage != 1) {
      result += `<li class="page-item" onclick="loadItem(${thisPage - 1}, ${limit})"><a class="page-link">Previous</a></li>`;
    } else {
      result += `<li class="page-item disabled"><a class="page-link">Previous</a></li>`;
    }
  
    // tính xem có bao nhieu nút
  
    // lấy container chứa nút phân trang
    let container = document.getElementById("Pagination");
  
    for (let i = 1; i <= count; i++) {
      let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
      if (i == thisPage) {
        string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
      }
      result += string;
    }
  
    // thêm nút next
  
    if (thisPage != count) {
      result += `<li class="page-item" onclick="loadItem(${thisPage + 1}, ${limit})"><a class="page-link">Next</a></li>`;
    } else {
      result += `<li class="page-item disabled"><a class="page-link">Next</a></li>`;
    }
  
    container.innerHTML = result;
  }

  function loadPage() {
    let listItems = document.querySelectorAll("#Pagination li");
    listItems.forEach(function (item) {
      if (item.classList.contains("active")) {
        let activePageNumber = parseInt(item.querySelector("a").textContent.trim());
        console.log("Trang đang active: " + activePageNumber);
        loadItem(activePageNumber, 4);
      }
    });
  }

  window.addEventListener("load", async function () {
    // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
    console.log("Trang Giám Khảo đã load hoàn toàn");
    //const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
    await getListPDiem();
    getSelect();
    EditBtn();
    SaveBtn();
    loadItem(1, 4);
  });