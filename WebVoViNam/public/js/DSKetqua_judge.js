
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
      await showTableKQ(data);
      loadPage();
    } catch (error) {
      console.error(error);
    }
  }
  
async function getSelect() {
  try {
      let response = await fetch("/api/judge/getKQ", {
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
      console.log("Dữ liệu select dskq nhận được từ API:", data);

       // Update select options with received data
    const selectKhoaThi = document.getElementById('khoa-thi');
    const selectCapDai = document.getElementById('cap-dai-du-thi');
    

    selectKhoaThi.innerHTML = '<option value="">Chọn Khóa Thi</option>';
    selectCapDai.innerHTML = '<option value="">Chọn Cấp Đai</option>';
    

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
        
    } catch (error) {
        console.error(error);
    }
}

async function btnLoc() {
    try {
        const khoaThi = document.getElementById('khoa-thi').value;
        const capDai = document.getElementById('cap-dai-du-thi').value;

        let response = await fetch("/api/judge/getKQ", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `function=DanhSachKQ&khoaThi=${encodeURIComponent(khoaThi)}&capDai=${encodeURIComponent(capDai)}}`,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let data = await response.json();
        console.log("Dữ liệu Lọc dskq nhận được từ API:", data);
        await showTableKQ(data);
        loadPage();
    } catch (error) {
        console.error(error);
    }
}
document.getElementById('locdanhsach').addEventListener('click', btnLoc);



async function showTableKQ(data) {
    console.log("Dữ liệu dskq trong loadData:", data);  // Ghi lại dữ liệu nhận được để kiểm tra
  
    let container = document.getElementById("danhsachKetqua");
    let result = "";

    let stt = 1;
  
    for (let i of data) {
      result  += `
        <tr>
          <td>${stt}</td>
          <td>${i.hoTen}</td>
          <td>${i.maThe}</td>
          <td>${i.tenKhoaThi}</td>
          <td>${i.tenCapDai}</td>
          <td>${i.TongDiem}</td>
          <td>${i.KetQua}</td>
          <td>${i.NgayCham}</td>
          <td>
              <button class="seebutton" data-id="${i.maChiTietKetQua}">Xem Chi Tiết</button>
          </td>
        </tr>
        `;
      stt++;
    }
    container.innerHTML = result;
  }


  document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let keyword = document.getElementById('input-search-dskq').value;

    fetch(`/api/judge/getKQ?TimKiem=${keyword}`)
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('danhsachKetqua');
            tableBody.innerHTML = '';  // Clear the table
            let stt = 1;
            data.forEach(result => {
                let row = `<tr>
                   <td>${stt}</td>
                    <td>${result.hoTen}</td>
                    <td>${result.maThe}</td>
                    <td>${result.tenKhoaThi}</td>
                    <td>${result.tenCapDai}</td>
                    <td>${result.TongDiem}</td>
                    <td>${result.KetQua}</td>
                    <td>${result.NgayCham}</td>
                    <td><button class="seebutton" data-id="${result.maChiTietKetQua}">Xem chi tiết</button></td>
                </tr>`;
                tableBody.insertAdjacentHTML('beforeend', row);
                stt++;
            });
        })
        .catch(error => console.error('Error:', error));
});


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


  document.addEventListener('DOMContentLoaded', function () {
    // Ẩn modal khi trang được tải
    const modal = document.getElementById('XemChiTietKQPD');
    if (modal) {
        modal.style.display = 'none';
    }
    // Function to fetch and display the detailed information
    function fetchDetail(maChiTietKetQua) {
        fetch(`/api/judge/getKQ?maChiTietKetQua=${maChiTietKetQua}`)
            .then(response => response.json())
            .then(data => {
                console.log("Dữ liệu seebutton nhận được từ API:", data);
                XemChiTietKQ(data);
            })
            .catch(error => console.error('Error fetching detail:', error));
    }

    // Function to display the detailed information in a modal
    function XemChiTietKQ(data) {
        if (!data || data.length === 0) {
            console.error("No data received.");
            return;
        }
    
        // Assuming data is an array, we take the first element since we're getting results by maChiTietKetQua
        const mainData = data[0];
    
        const modalContent = `
            <div class="modal-header">
                <h5 class="modaltitle">Bảng điểm chi tiết</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="info">
                <div class="thongtin">
                    <p>Họ tên: ${mainData.hoTen}</p>
                    <p>Mã Thẻ: ${mainData.maThe}</p>
                </div>
                <div class="thongtin">
                    <p>Khóa thi: ${mainData.tenKhoaThi}</p>
                    <p>Cấp đai dự thi: ${mainData.tenCapDai}</p>
                </div>
            </div>
            <table class="danhsach">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Kỹ thuật</th>
                        <th>Thuộc bài <br> (5đ)</th>
                        <th>Nhanh mạnh <br> (2đ)</th>
                        <th>Tấn pháp <br> (2đ)</th>
                        <th>Thuyết phục <br> (1đ)</th>
                        <th>Điểm</th>
                        <th>Kết quả</th>
                        <th>GK chấm</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    ${(mainData.details || []).map((detail, index) => `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.tenKyThuat}</td>
                            <td>${detail.thuocBai}</td>
                            <td>${detail.nhanhManh}</td>
                            <td>${detail.tanPhap}</td>
                            <td>${detail.thuyetPhuc}</td>
                            <td>${detail.diem}</td>
                            <td>${detail.ketQua}</td>
                            <td>${detail.giamKhaoCham}</td>
                            <td>${detail.ghiChu}</td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `; 
        modal.querySelector('.detailmodel').innerHTML = modalContent;
        modal.style.display = 'block';

        // Close modal on clicking the close button
        const closeButton = document.querySelector('.close');
        if (closeButton) {
            closeButton.onclick = function () {
                modal.style.display = 'none';
            };
        } else {
            console.error("Close button not found.");
        }
        
    }

    // Attach click event to all "Xem chi tiết" buttons
    document.querySelector('#danhsachKetqua').addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('seebutton')) {
            const maChiTietKetQua = event.target.getAttribute('data-id');
            fetchDetail(maChiTietKetQua);
        }
    });
});








  




  function loadItem(thisPage, limit) {
    // tính vị trí bắt đầu và kêt thúc
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
  
    // lấy tất cả các dòng dữ liệu có trong bảng
    let all_data_rows = document.querySelectorAll("#danhsachKetqua > tr");
  
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
    console.log("Trang Giám Khảo dskq đã load hoàn toàn");
    //const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
    await DanhSachKQ();
    getSelect();
    
    //EditBtn();
    //SaveBtn();
    loadItem(1, 4);
  });