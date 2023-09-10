<?php 
    include('./action/getData.php');
    session_start();
    // error_reporting(0);
    $id;
    if (isset($_COOKIE['account'],$_SESSION['id'])){ // check người dùng đang đăng nhập
        global $id;
        global $data;
        $id = $_SESSION['id'];
        getData($id);
        $_SESSION['id'] = $id;
    } else {
        global $data;
        // nếu $session setting của người dùng tồn tại thì sử dụng lại còn nếu không có
        // sẽ khởi tạo 1 session setting mặc định
        if (isset($_SESSION['setting'])){
            $data = $_SESSION['setting'];
        } else {
            $data = array(
                "id" => 3,
                "pomodoro" => 25,
                "shortbreak" => 5,
                "longbreak" => 10,
                "autoStartPomodoro" => 0,
                "autoStartBreak" => 0,
                "autoCheckTask" => 0,
                "longBreakInterval" => 2,
                "pomodoroColor" => '#313866',
                "shortBreakColor" => '#435334',
                "longBreakColor" => '#C8AE7D',
            );
            $_SESSION['setting'] = $data;
        }
    }
?>
<!DOCTYPE html>
<html lang="en" style="<?php 
            echo "
                --color: ".$data['pomodoroColor'].";
                --pomodoro: ".$data['pomodoroColor'].";
                --shortbreak: ".$data['shortBreakColor'].";
                --longbreak: ".$data['longBreakColor'].";
            ";
        ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time focus!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <div class="header">
            <a href="index.php" id="logo"><img src="image/tomato.png" alt="" style="width: 30px; aspect-ratio: 1 / 1; color: white; margin: 0 0 7px;"> Tomató</a>
            <div class="button">
                <button><i class="fa-solid fa-chart-simple"></i> Report</button>
                <button onclick="openSetting()"><i class="fa-solid fa-gear"></i> Setting</button>
                <?php if (isset($_COOKIE['account'])){
                    echo '<a id="logout" href="./action/logout.php"><i class="fa-solid fa-circle-user"></i> Logout</a>';
                } else echo '<button onclick="openLogin()"><i class="fa-solid fa-circle-user"></i> Login</button>' ?>
            </div>

            <form action="<?php
                 if(isset($_COOKIE['account'])) echo "./action/update.php";
                    else echo "./action/updateSession.php";
                 ?>" class="form-setting" id="form-setting" method="POST">
                <input type="hidden" name="pomodoroColor" id="pomodoroColor">
                <input type="hidden" name="shortBreakColor" id="shortBreakColor">
                <input type="hidden" name="longBreakColor" id="longBreakColor">
                <div class="form-head color2">
                    <b>Setting</b>
                    <div onclick="closeSetting()"><i class="fa-solid fa-xmark color2"></i></div>
                </div>
                <div class="form-separate"></div>
                <div class="form-time">
                    <i class="fa-solid fa-clock color1 icon"></i>
                    <span class="color1">TIMER</span>
                    <p class="color2 mb-1 mt-3">Time (minutes)</p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="color1 m-0">Pomodoro</p> 
                            <input type="number" value="<?php echo $data["pomodoro"] ?>" id="pomodoro-value" name="pomodoro-value" class="input-set-time color2">
                        </div>
                        <div>
                            <p class="color1 m-0">Short Break</p>
                            <input type="number" value="<?php echo $data["shortbreak"] ?>" id="shortbreak-value" name="shortbreak-value" class="input-set-time color2">
                        </div>
                        <div>
                            <p class="color1 m-0">Long Break</p>
                            <input type="number" value="<?php echo $data["longbreak"] ?>" id="longbreak-value" name="longbreak-value" class="input-set-time color2">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2">Auto Start Breaks</span>
                        <input type="checkbox" id="autostartbreak" name="autostartbreak" class="checkbox"
                            value="<?php 
                                if ($data["autoStartBreak"] == 1) echo "1"; else echo "0";
                            ?>"
                        >
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2" >Auto Start Pomodoro</span>
                        <input type="checkbox" id="autostartpomodoro" name="autostartpomodoro" class="checkbox"
                            value="<?php 
                                if ($data["autoStartPomodoro"] == 1) echo "1"; else echo "0";
                            ?>"
                        >
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2">Long Break interval</span>
                        <input type="number" id="longbreakinterval" name="longbreakinterval" value="<?php echo $data['longBreakInterval'] ?>" class="input-set-time color2">
                    </div>
                </div>
                <div class="form-separate"></div>
                <div class="tasks">
                    <i class="fa-solid fa-list-check icon"></i>
                    <span class="color1">TASKS</span>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2" >Auto Check Tasks</span>
                        <input type="checkbox" id="autochecktask" name="autochecktask" class="checkbox"
                        value="<?php
                            if ($data["autoCheckTask"] == 1) echo "1"; else echo "0"; 
                        ?>"
                        >
                    </div>
                </div>
                <div class="form-separate"></div>
                <div class="theme">
                    <i class="fa-solid fa-palette icon"></i>
                    <span class="color1">THEME</span>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2" >Color Themes</span>
                        <div class="d-flex gap-1">
                            <div id="pomodoro-color" class="box" state="pomodoro"></div>
                            <div id="shortbreak-color" class="box" state="shortbreak"></div>
                            <div id="longbreak-color" class="box" state="longbreak"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="color2" >Small Window</span>
                        <button style="background-color: #333333ae;" id="opensmallwindow">Open</button>
                    </div>
                </div>
                <div class="color-options" id="color-options">
                </div>
                <div style="float: right; padding: 20px;">
                    <input type="submit" value="save" class="savebtn" form="form-setting">
                </div>
            </form>
            <form action="action/login.php" class="form-login" id="form-login" method="POST">
                <div class="d-flex justify-content-center">
                    <h2 style="color: var(--color);">LOGIN</h2>
                    <div onclick="closeLogin()" class="closeBtn"><i class="fa-solid fa-xmark color2"></i></div>
                </div>
                <button><i class="fa-brands fa-google"></i> Login with Google</button><br>
                <div class="d-flex justify-content-between">
                    <div class="separate"></div>
                    <span class="color1">OR</span>
                    <div class="separate"></div>
                </div>
                <label class="color2 mt-3">Email: </label><br>
                <input type="text" placeholder="example@gmail.com" class="email" name="email" >
                <span class="description"></span><br>
                <label class="color2 mt-3">Password: </label><br>
                <input type="password" class="password" name="password">
                <span class="description"></span><br>
                <button stype="submit" class="submit">Login with email</button>
                <a href="#" class="color2 d-flex justify-content-center mb-3">Forgot password</a>
                <span class="color2" style="width: 100% !important; display: flex; justify-content: space-around;">
                    Do not have an account ? 
                    <span class="color3 " onclick="openSignup()">Create account</span>
                </span>
            </form>
            <form action="./authentication/" class="form-signup" id="form-signup" method="POST">
                <div class="d-flex justify-content-center">
                    <h2>CREATE  ACCOUNT</h2>
                    <div onclick="closeSignup()" class="closeBtn"><i class="fa-solid fa-xmark color2"></i></div>
                </div>
                <button><i class="fa-brands fa-google"></i> Signup with Google</button><br>
                <div class="d-flex justify-content-between">
                    <div class="separate"></div>
                    <span class="color1">OR</span>
                    <div class="separate"></div>
                </div>
                <label class="color2 mt-2">Name: </label><br>
                <input type="text" placeholder="Nguyen Van A" id="fullname" name="fullname">
                <span class="description"></span><br>
                <label class="color2 mt-2">Email: </label><br>
                <input type="text" placeholder="example@gmail.com" id="email" name="email">
                <span class="description"></span><br>
                <label class="color2 mt-2">Password: </label><br>
                <input type="password" id="password" name="password">
                <span class="description"></span><br>
                <label class="color2 mt-2">Confirm: </label><br>
                <input type="password" id="confirm-password">
                <span class="description"></span><br>
                <button stype="submit" class="submit">Signup with email</button>
                <span class="color2 mx-4">
                    Already have an account ?
                    <span class="color3" onclick="openLogin()">Log in</span>
                </span>
            </form>
        </div>
        <div class="navbar-separate1" id="navbar-separate1"></div>
        <div class="container">
            <nav class="navbar">
                <button id="1" class="nav-item active" mode="1">Pomodoro</button>
                <button id="2" class="nav-item" mode="2">Short Break</button>
                <button id="3" class="nav-item" mode="3">Long Break</button>
            </nav>
            <div class="time" id="time">
                25:00
            </div>
            <button class="btn-start" id="btn-start">START</button>
            <div id="btn-skip"><i class="fa-solid fa-forward"></i></div>
        </div>
        <div class="footer">
            <p>#1</p>
            <b id="title">Time to focus!</b>
            <div class="footer-task">
                <h4>Tasks </h4>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>
            <div class="navbar-separate2"></div>
        </div>
        
        <?php
    if(isset($_SESSION['id'])){
        $sql = "SELECT * FROM tasks WHERE userID = ".$_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        $taskID =0;
        while($row = mysqli_fetch_assoc($result)){
            
        ?>
        <div class="show-task mt-3 d-flex " style="padding:0; position:relative;" >
            <button class="btn-idTask" id="btn-idTask" style="background-color: white; height: 100px; width: 5%;" 
            onclick="chooseTask(<?php echo $row['taskID']; ?>)" ></button>
            <div style="width: 95%; padding: 10px;">
                <div class="d-flex w-100 justify-content-between">
                    <span>
                        <button><i class="fa-solid fa-circle-check"></i></button>
                        <b><?php echo $row['title']; ?></b>
                    </span>
                    <span>
                        <span class="currentTime" id="currentTime"> </span> / <span> <?php echo $row['finishTime']; ?></span>
                        <button><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    </span>
                </div>
                <div class="show-note">
                    <p><?php echo $row['description']; ?></p>
                </div>
            </div>
        </div>
<?php }
    }
?>
    <script>
        function checkCookie() {
            var id= document.cookie;
            if (id!="") {
                alert("Success ! " +id);
            } else {
                alert("Fail !" );
            }
        }
        function chooseTask(x){
            var idbd = x;
            var idtask = x-1;
            const collection = document.getElementsByClassName("btn-idTask");
            for (var i = 0; i < collection.length ; i++) {
                if(i == idtask){
                    collection[i].style.backgroundColor = "black";
                }
                else{
                    collection[i].style.backgroundColor = "white";
                }
            }
            document.cookie = "idtask =" + idbd;
            checkCookie();
            
        }
        const collect = document.getElementsByClassName("currentTime");
        var currentTime = 0;
        const ArrcurrentTime = [];
        for (var i = 0; i < collect.length ; i++) {
                collect[i].innerHTML = currentTime;
                ArrcurrentTime[i] = currentTime;
            }
            

    </script>
        <div class="task">
            <button class="btn-add-task" onclick="openAddTask()" id="btn-addTask"><b><i class="fa-solid fa-circle-plus"></i> Add Task</b></button>
        </div>
        <form action="./action/handleSaveTask.php" class="form-addTask" id="form-addTask" method="get">
            <div class="px-3">
                <input type="text" class="title mb-5" id="title" name="title" placeholder="What are you working on?" required></input>
                <b>Est Pomodoros</b><br>
                <input type="number" class="est mb-3" id="est" name="est" required><br>
                <span> <input type="text" id="note" name="note" class="note mb-2" placeholder="Some note"> </span> <span> + Add Project <i class="fa-solid fa-lock"></i> </span>
            </div>
            <div class="btn-Form-addTask mt-4">
                <button class="btn btn-light" onclick="closeAddTask()">Cancel</button>
                <button class="btn btn-dark me-3">Save</button>
            </div>
        </form>
        <div class="totalTime">
            <span class="me-1">Pomos: </span> <b>0/ <?php include('./time.php'); echo caculateEst(); ?></b>
            <span class="ms-4 me-1">Finish At: </span> <b> <?php caculateTime(); ?> </b>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <audio id="bell" src="./sound/bell.mp3" loop volume="1"></audio>
    <div id="message-inf">
    </div>
    <script type="module" src="./model/config.js"></script>
    <script src="./event/eventDom.js"></script>
    <script src="./event/togglemessage.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
    include('./handle/handlemessage.php');
?>
