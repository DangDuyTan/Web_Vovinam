// location.reload();
// ------------------------------------- AJAX LOGIN ---------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", Login);
});

async function Login(event) {
    try {
      let tenDangNhap = document.getElementById("userNameInput").value;
      let matKhau = document.getElementById("passWordInput").value;

        const response = await fetch("/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                tenDangNhap: tenDangNhap,
                matKhau: matKhau
            }),
        });

        const data = await response.json();
        if (data.mess === "success") {
            if (data.maQuyen === "giamkhaocanban") {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Login Success",
                    showConfirmButton: false,
                    timer: 2000,
                });
                window.location.href = "/../Views/HomePage.php";
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Login Success",
                    showConfirmButton: false,
                    timer: 2000,
                });
                window.location.href = "/../Views/judge-score.php";
            }
        } else if (data.mess === "Block") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Your account is locked, please contact the administrator to unlock it!",
            });
        } else if (data.mess === "wrongPass") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Wrong Password!",
            });
        } else if (data.mess === "notFound") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Account not found!",
                footer: `Don't have an account? <a href="/Views/signup.php">Sign up</a>`,
            });
        }
    } catch (error) {
        console.error("Error:", error);
    } 
}
  // window.addEventListener('load', function () {
  //        // Xử lý khi toàn bộ trang đã được tải xong
  //        console.log('Toàn bộ trang đã được tải xong');
  //        checkLogin();
  // });
  // ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
  async function checkLogin() {
    // location.reload();
    try {
      const response = await fetch("/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "function=" + encodeURIComponent("getObj"),
      });
      const data = await response.json();
  
      console.log("console checkLogin() :",data);
      let tenDangNhap = data;
      if (tenDangNhap.mess == "success") {
        // window.location.href = "../../GUI/view/HomePage.php";
        if (tenDangNhap.maQuyen == "giamkhaocanban") {
          window.location.href = "/../Views/HomePage.php";
        }
        // Nếu tài khoản khác với user
        else {
          window.location.href = "/../Views/judge-score.php";
        }
      }
      // for (let i of data) {
      //        console.log(i);
      // }
      // showProductItem(data);
    } catch (error) {
      console.error("Error:", error);
    }
  }
  // checkLogin();
  
  function checkFormLogin() {
    let tenDangNhap = document.getElementById("userNameInput").value;
    let matKhau = document.getElementById("passWordInput").value;
    // Regular expressions for validation
    var usernameRegex = /^[a-zA-Z\d]{5,16}$/;
    var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;
  
    // Check if the fields are filled correctly
    if (!usernameRegex.test(tenDangNhap)) {
      // alert('Vui lòng điền tên đăng nhập hợp lệ từ 5 đến 16 ký tự');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Please enter a valid username of 5 to 16 characters!",
      });
      return false; // Stop the function if the username is not valid
    }
    if (!passwordRegex.test(matKhau)) {
      // alert('Vui lòng điền mật khẩu hợp lệ');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Please enter a valid password between 6 and 20 characters!",
      });
      return false; // Stop the function if the password is not valid
    }
    return true;
  }
  
  // chỉ thực hiện các hàm khi trang web đã load xong
  
  window.addEventListener("load", function () {
    // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
    console.log("Trang Login đã load hoàn toàn");
    checkLogin();
    Login();
  });
  