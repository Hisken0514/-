<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>update_password.php</title>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .container {
    text-align: center;
  }
  .password-container {
    position: relative;
  }
  .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }
  table {
    margin: 0 auto;
    font-size: 1.2em; /* 增大表格文字 */
    border-collapse: collapse;
  }
  td {
    padding: 10px 20px; /* 增大表格內間距 */
  }
  input[type="text"], input[type="password"] {
    font-size: 1.2em; /* 增大輸入框文字 */
    padding: 5px; /* 增大輸入框內間距 */
    width: 100%; /* 使輸入框填滿表格單元格 */
  }
  .message {
    margin-top: 20px;
    color: blue;
  }
  .error-message {
    margin-top: 20px;
    color: red;
  }
</style>
<script>
function togglePassword() {
  var passwordField = document.getElementById("password");
  var toggleIcon = document.getElementById("togglePasswordIcon");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.textContent = "🙈"; // 隱藏密碼圖標
  } else {
    passwordField.type = "password";
    toggleIcon.textContent = "👁️"; // 顯示密碼圖標
  }
}
</script>
</head>
<body>
<div class="container">
<?php
$message = "";
// 是否是表單送回
if (isset($_POST["Update"])) {
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost", "root", "1234")
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "user_db");  // 選擇資料庫

   // 取得並處理表單數據
   $id = mysqli_real_escape_string($link, $_POST["id"]);
   
   // 檢查用戶 ID 是否存在
   $checkIdQuery = "SELECT * FROM user WHERE Id='$id'";
   $result = mysqli_query($link, $checkIdQuery);

   if (mysqli_num_rows($result) == 0) {
      $message = "<span class='error-message'>Id不存在，無法更改密碼！</span>";
   } else {
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);  //對使用者輸入的password進行hash

      // 建立更新記錄的SQL指令字串
      $sql = "UPDATE user SET Password='$password' WHERE Id='$id'";
      
      //送出UTF8編碼的MySQL指令
      mysqli_query($link, 'SET NAMES utf8'); 
      if (mysqli_query($link, $sql)) // 執行SQL指令
         $message = "<span class='message'>密碼已更新！</span>";
      else
         die("資料庫更新記錄失敗<br/>");
   }

   mysqli_close($link);      // 關閉資料庫連接
}
?>
<form action="update_password.php" method="post">

<table border="1">
<tr><td>ID:</td>
   <td><input type="text" name="id" size="10"/></td>
</tr>
<tr><td>密碼:</td>
   <td>
      <div class="password-container">
         <input type="password" id="password" name="password" size="10"/>
         <span id="togglePasswordIcon" class="toggle-password" onclick="togglePassword()">👁️</span>
      </div>
   </td>
</tr>
</table><hr/>
<input type="submit" name="Update" value="更新"/>
</form>
<?php
if (!empty($message)) {
    echo $message;
}
?>
</div>
</body>
</html>
