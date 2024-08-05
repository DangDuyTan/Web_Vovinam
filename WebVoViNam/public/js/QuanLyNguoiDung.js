
var dataPermission = "";
//Lấy danh sách đối tượng

async function getListObj() {
  try {
    // Gọi AJAX để xóa payment
    let response = await fetch("/api/user/getList", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getListobj"),
    });
    // Kiểm tra trạng thái của phản hồi
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    // Ghi lại dữ liệu trả về từ API
    let data = await response.json();
    console.log("Dữ liệu nhận được từ API:", data);
    await loadData(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

// Lấy một đối tượng bằng id
async function getObj(userId) {
  try {
        // Gọi AJAX để xóa payment
        let response = await fetch(`/api/user/${userId}`, {
          method: "GET",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        });
        // Kiểm tra trạng thái của phản hồi
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

    let data = await response.json();
    console.log("Dữ liệu nhận được từ API:", data);

  } catch (error) {
    console.error(error);
  }
}
/*
// lấy dữ liệu từ kết quả  rearch
function searchAccount() {
  document.getElementById("input-search-account").oninput = async function () {
    try {
      // Gọi AJAX để xóa payment
      let str = document
        .getElementById("input-search-account")
        .value.trim()
        .toLowerCase();
      let response = await fetch("../../Domain/User/UserRepository.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchAccount") +
          "&str=" +
          encodeURIComponent(str),
      });

      let data = await response.json();
      if (data.length == 0) {
        console.log("Không có dữ liệu");

        document.querySelector("#Pagination").style.display = "none";
        loadData(data);
      } else {
        loadData(data);
        document.querySelector("#Pagination").style.display = "flex";
        loadItem(1, 4);
      }
      await loadData(data);
      console.log(data);
      loadPage();
    } catch (error) {
      console.error(error);
    }
  };
}
*/
async function loadData(data) {
  console.log("Dữ liệu trong loadData:", data);  // Ghi lại dữ liệu nhận được để kiểm tra

  let container = document.getElementById("danhsachUser");
  let container1 = document.getElementById("delete-User");
  let container2 = document.getElementById("edit-User");
  let result = "";
  let result1 = ``;
  let result2 = ``;
  let stt = 1;


  
  for (let i of data) {

    let strStt = "";
    if (i.kichHoat == "1") {
      strStt = `<td><a class="btn btn-sm btn-primary" title="Click để ẩn bình luận" onclick="updateStateUser('${i.Id}','${i.kichHoat}',event)"> Đang kích hoạt <i class="fa fa-eye"></i></a></td>`;
    } else {
      strStt = `<td><a class="btn btn-sm btn-danger" title="Click để hiện bình luận" onclick="updateStateUser('${i.Id}','${i.kichHoat}',event)"> Đang bị khóa <i class="fa fa-eye-slash"></i></a></td>`;
    }
    
    result  += `
      <tr>
         <td>${stt}</td>
         <td>${i.tenDangNhap}</td>
         <td>${i.ho}</td>
         <td>${i.ten}</td>
         <td>${i.loai}</td>
         <td>${i.soDienThoai}</td>
         ${strStt}
         <td><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUser-${i.Id}"><i class="fa fa-edit"></i></a></td>
         <td><a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser-${i.Id}"><i class="fa fa-trash"></i>Xóa</a></td>
      </tr>
    `;

  /*  let String1 = `
      <div class="modal fade" id="deleteUser-${i.Id}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Xóa người dùng</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  Bạn có chắc muốn xóa người dùng này?
                  <br>
                  Mã người dùng: ${i.Id}
                  <br>
                  Tên người dùng: ${i.ten}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-delete" onclick="deleteByID('${i.Id}')">Xóa</button>
              </div>
          </div>
      </div>
  </div>
  
        `;*/
 /*   let String2 = `
      <div class="modal fade" id="editUser-${
        i.Id
      }" tabindex="-1" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Sửa thông tin người dùng</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="editForm">
                      <div class="mb-3">
                          <label for="name" class="form-label">Tên đăng nhập</label>
                          <input type="text" class="form-control" id="${
                            i.Id
                          }" value="${i.Id}"
                              name="codeSupplier" placeholder="NCC001" disabled>
                      </div>
                      <div class="mb-3">
                          <label for="name" class="form-label">Mật khấu</label>
                          <div class="input-group">
                          <input type="password" class="form-control" id="${
                            i.Id
                          }-${i.matKhau}"
                              value="${
                                i.matKhau
                              }" name="passWord" aria-describedby="togglePassword">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" class="togglePassword" onclick="togglePasswordVisibility('${
                                i.Id
                              }-${i.passWord}')">Show</button>
                            </div>
                          
                          </div>
                      </div>
                      <input type="hidden" class="form-control" id="${
                        i.Id
                      }-${i.dateCreated}"
                          value="${i.dateCreated}" name="dateCreated">
                      <div class="mb-3">
                          <label for="name" class="form-label">Họ và tên</label>
                          <input type="text" class="form-control" id="${
                            i.Id
                          }-${i.ten}" value="${i.ten}"
                              name="name">
                      </div>
                      <div class="mb-3">
                          <label for="address" class="form-label">Địa chỉ</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.address}"
                              value="${i.address}" name="address">
                      </div>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.email}"
                              value="${i.email}" name="email">
                      </div>
                      <div class="mb-3">
                          <label for="phoneNumber" class="form-label">Số điện thoại</label>
                          <input class="form-control" id="${i.tenDangNhap}-${
      i.phoneNumber
    }" value="${i.phoneNumber}"
                              name="phoneNumber">
                      </div>
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Ngày sinh</label>
                          <input type="date" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.birth}" value="${i.birth}"
                              name="birth">
                      </div>
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Giới tính</label>
                          ${stringSelectorSex(sex, tenDangNhap)}
                      </div>
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Nhóm người dùng</label>
                          ${stringSelectorPermission(
                            dataPermission,
                            codePermissions,
                            tenDangNhap
                          )}
                      </div>
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Trạng thái</label>
                          ${stringSelectorStatus(kichHoat, tenDangNhap)}
                      </div>
                      <div style="text-align:right;">
                          <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                              onclick="updateObj('${i.tenDangNhap}', '${
      i.tenDangNhap
    }-${i.passWord}', '${i.tenDangNhap}-${i.dateCreated}','${i.tenDangNhap}-${
      i.accountStatus
    }','${i.tenDangNhap}-${i.name}','${i.tenDangNhap}-${i.address}','${
      i.tenDangNhap
    }-${i.email}','${i.tenDangNhap}-${i.phoneNumber}','${i.tenDangNhap}-${
      i.birth
    }','${i.tenDangNhap}-${i.sex}','${i.tenDangNhap}-${
      i.codePermissions
    }',event)">Sửa
                              người dùng</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
      
        `;
        */
    // console.log(String);
    //result += String;
    //result1 += String1;
    //result2 += String2;
    stt++;
  }
  // console.log(result);
  container.innerHTML = result;
  // container1.innerHTML = result1;
  // console.log(result1);
  // container2.innerHTML = result2;
  // console.log(result2);
}

/*
// hiển thị password
function togglePasswordVisibility(inputId) {
  var passwordInput = document.getElementById(inputId);
  var toggleButton = document.getElementById("togglePassword");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleButton.textContent = "Hide";
  } else {
    passwordInput.type = "password";
    toggleButton.textContent = "Show";
  }
}
*/
/*
async function getListUserGr() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}
*/
/*
function stringSelectorPermission(dataPermission, codePermission, username) {
  console.log(dataPermission);
  var string1 = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${username}-${codePermission}" name="${username}-${codePermission}">`;
  for (let i of dataPermission) {
    if (i.codePermission === codePermission) {
      string1 += `<option selected value="${i.codePermission}">${i.namePermission}</option>`;
    } else {
      string1 += `<option  value="${i.codePermission}">${i.namePermission}</option>`;
    }
  }
  string1 += `</select>`;
  // console.log("KOKOKOKOKO");
  // console.log(string1);
  return string1;
}
  */
/*
function stringSelectorSex(sex, username) {
  var string = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${username}-${sex}" name="${username}-${sex}">`;
  if (sex === "nam" || sex === "Nam" || sex === "Male" || sex === "male") {
    string += `<option selected value="Nam">Nam</option> <option  value="Nữ">Nữ</option>`;
  } else {
    string += `<option selected value="Nữ">Nữ</option> <option  value="Nam">Nam</option>`;
  }
  string += `</select>`;
  return string;
}
*/
/*
function stringSelectorStatus(accountStatus, username) {
  var string = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${username}-${accountStatus}" name="${username}-${accountStatus}">`;
  if (accountStatus === "1") {
    string += `<option selected value="1">Kích hoạt</option> <option  value="0">Chưa kích hoạt</option>`;
  } else {
    string += `<option selected value="0">Chưa kích hoạt</option> <option  value="1">Kích hoạt</option>`;
  }
  string += `</select>`;
  return string;
}
*/


function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#danhsachUser > tr");

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
  console.log("Trang quản lý người dùng đã load hoàn toàn");
  // await getListUserGr();
  const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
  await getListObj();
  //await getObj(userId);
  loadItem(1, 4);
  //searchAccount();
});
