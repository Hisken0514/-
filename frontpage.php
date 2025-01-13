<?php
session_start();
if (isset($_POST['logout'])) {
    session_unset();
    header('Location: frontpage.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>數教交流網</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .MaxContainer {
            display: flex;
            height: 100%;
            width: 100%;
            background-color: #FFFCEC;
        }
        .SideContainer {
            height: 100%-20px;
            width: 200px;
            background-color: #7B7B7B;
            border: 1px solid black;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }
        .MainContainer {
            flex: 1;
            background-color: #FFFAF4;
            border: 1px solid black;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .HeaderContainer {
            width: 100%;
            background-color: #6F8E7F;
            border-bottom: 1px solid black;
            display: flex;
            justify-content: center; 
            align-items: center; 
            color: #272727;
            font-weight: bold;
            padding: 20px 0;
        }
        .Title {
            font-size: 40px;
        }
        .Frontpage_B{
            height: 60px; 
            width: 100%;
            display: flex;
            justify-content: center; 
            align-items: center; 
            background-color: #FCFCFC;
            color: #272727;
            cursor: pointer;
            border: 1px solid #272727;
            padding: 10px;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .HeaderContainer input[type="submit"] {
            padding: 10px 10px;
            color: #fff;
            border: 1;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 5px;
            color:black;
        }
        .HeaderContainer input[type="submit"]:hover {
            background-color: #DEDEBE;
        }
        .SideContainer input[type="submit"]:hover {
            background-color: #DEDEBE;
        }
        .sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            bottom: 0;
            width: 250px;
            background-color: #333;
            padding: 20px;
            transition: left 0.3s ease;
        }
        .menu {
            list-style-type: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
        .menu li a {
            color: #fff;
            text-decoration: none;
        }
        .expand-btn {
            position: absolute;
            top: 61px;
            right: -40px;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 2;
        }
        .bordered {
            border: 1px solid black;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="MaxContainer">
    <div class="sidebar">
        <button class="expand-btn" onclick="toggleMenu()">選單</button>
        <ul class="menu">
            <li><input type="submit" value="首頁" class="Frontpage_B" onclick="location.href='frontpage.php'"></li>
            <li>
                <?php
                if (empty($_SESSION["nickname"])) {
                    echo '<input type="submit" value="課程攻略" class="Frontpage_B" onclick="showAlertAndRedirect()">';
                } else {
                    echo '<input type="submit" value="課程攻略" class="Frontpage_B" onclick="location.href=\'talk.php\'">';
                }
                ?>
            </li>
            <li>
                <?php
                if (empty($_SESSION["nickname"])) {
                    echo '<input type="submit" value="情報交流" class="Frontpage_B" onclick="showAlertAndRedirect()">';
                } else {
                    echo '<input type="submit" value="情報交流" class="Frontpage_B" onclick="location.href=\'talk.php\'">';
                }
                ?>
            </li>
            <li>
                <?php
                if (empty($_SESSION["nickname"])) {
                    echo '<input type="submit" value="打工家教" class="Frontpage_B" onclick="showAlertAndRedirect()">';
                } else {
                    echo '<input type="submit" value="打工家教" class="Frontpage_B" onclick="location.href=\'work.php\'">';
                }
                ?>
            </li>
            <?php
            if (empty($_SESSION["nickname"])) {
                echo '<input type="submit" value="課本買賣" class="Frontpage_B" onclick="showAlertAndRedirect()">';
            } else {
                echo '<input type="submit" value="課本買賣" class="Frontpage_B" onclick="location.href=\'trade.php\'">';
            }
            ?>
            <?php
            if (empty($_SESSION["nickname"])) {
                echo '<input type="submit" value="畢業學分" class="Frontpage_B" onclick="showAlertAndRedirect()">';
            } else {
                echo '<input type="submit" value="畢業學分" class="Frontpage_B" onclick="location.href=\'graduate.php\'">';
            }
            ?>
            <li>
                <?php
                if (empty($_SESSION["nickname"])) {
                    echo '<input type="submit" value="個人檔案" class="Frontpage_B" onclick="showAlertAndRedirect()">';
                } else {
                    echo '<input type="submit" value="個人檔案" class="Frontpage_B"  onclick="location.href=\'change.php\'">';
                }
                ?>
            </li>
            <li>
                <form id="logoutForm" method="post" action="talk.php">
                    <div class="col-g-12">
                        <input type="hidden" name="logout" value="1">
                        <input <?php if ($_SESSION["nickname"] == "") {
                            echo 'type="hidden"';
                        } else {
                            echo 'type="button"';
                        } ?> class="Frontpage_B" style="background:#C77272;color:#FFFFFF" onclick="confirmLogout()" value="帳號登出">
                    </div>
                </form>
            </li>
        </ul>
    </div>
    <script>
        function showAlertAndRedirect() {
            alert("請先登入帳號!");
            window.location.href = "userlogin.php";
        }
    </script>
    <script>
        function confirmLogout() {
            if (confirm("確定要登出嗎？")) {
                document.getElementById("logoutForm").submit();
            }
        }
    </script>
    <script>
        function toggleMenu() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0px';
        }
    </script>

    <div class="MainContainer">
        <div class="HeaderContainer">
            <div><img src="FP.png" style="width:50px ;margin-bottom:5px" alt="..."></div>
            <div class="Title">數教系交流網站</div>
            <?php
            // 檢查是否存在用戶名
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["nickname"];
                // 在這裡你可以使用 $username 來顯示登入用戶的相關內容或功能
                echo '<br>' . '<a href="userchange.php" style="color:#355C8A;margin-top:18px">嗨~' . " $username" . '</a>';
            } else {
                echo '<input type="submit" value="登入" onclick="location.href=\'userlogin.php\'">';
            }
            ?>
        </div>
        <div class="grid text-center" style="--bs-columns: 4; --bs-gap: 5rem;margin-top:10px">
            <div class="g-col-2">
                <div class="row" style="width:100%;height:150px;">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="col-12" style="font-size:75px;font-weight: bold;text-align: center;margin-bottom:10px;margin-top:30px">
                                    <marquee direction="left" scrollamount="8" behavior="scroll">
                                    <!-- 在此處輸入跑馬燈内容 -->
                                    歡迎來到數教交流網 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    114級系學會長卓志勳在此向大家問好！
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="col-2" style="width:100%;">
                    <div class="bordered">
                        <div class="row">
                            <div class="col-12" style="font-size:40px;font-weight: bold;margin-bottom:10px ">重要公告</div>
                            <div class="col-2" style="font-size:24px;font-weight: bold;margin-bottom:10px">公告日期</div>
                            <div class="col-2" style="font-size:24px;font-weight: bold;text-align: left;margin-bottom:10px">公告單位</div>
                            <div class="col-8" style="font-size:24px;font-weight: bold;text-align: left;margin-bottom:10px">公告事項</div>
                            <div class="col-2">
                                <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy text-center">
                                    <a>2024-05-21</a>
                                    <a>2024-05-01</a>
                                    <a>2024-04-23</a>
                                    <a>2024-04-10</a>
                                    <a>2024-03-20</a>
                                    <a>2024-03-11</a>
                                    <a>2024-02-21</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy" style="text-align: left;margin-bottom:20px">
                                    <a>系學會</a>
                                    <a>系學會</a>
                                    <a>系辦</a>
                                    <a>系辦</a>
                                    <a>學生</a>
                                    <a>網站管理員</a>
                                    <a>學校</a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy" style="text-align: left;margin-bottom:20px">
                                    <a>恭喜114級系學會卓志勳會長卸任！！！</a>
                                    <a>系卡舉辦時間 05/10歡迎大家來參加~</a>
                                    <a>大三專題階段展報告時間於05/07 15:30開始報告</a>
                                    <a>大三專題階段展書面資料繳交時間於04/30截止</a>
                                    <a>請同學幫忙尋找溫彥橙同學 他已經消失很久了 提醒他盡快與他的組員聯絡！</a>
                                    <a style="color:red">請各位同學在此網站要有禮貌不要惡意攻擊其他同學，否則將停權一個月！</a>
                                    <a>02/28(三)228所以放假一天~</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
