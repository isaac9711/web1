<html>
    <head>
    </head>
    <body>
        <h1>boardAddAction.php</h1>
        <?php
            $board_pw = $_POST["boardPw"];
            $board_title = $_POST["boardTitle"];
            $board_content = $_POST["boardContent"];
            $board_user = $_POST["boardUser"];
            echo "board_pw : " . $board_pw . "<br>";
            echo "board_title : " . $board_title . "<br>";
            echo "board_content : " . $board_content . "<br>";
            echo "board_user : " . $board_user . "<br>";
            $conn = mysqli_connect("localhost", "root", "java0000","jjdev");
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            $sql = "INSERT INTO board (board_pw, board_title, board_content, board_user, board_date) values ('".$board_pw."','".$board_title."','".$board_content."','".$board_user."',now())";
            $result = mysqli_query($conn,$sql);
            if($result) {
                echo "입력 성공: ".$result;
            } else {
                echo "입력 실패: ".mysqli_error($conn);
            }
            mysqli_close($conn);
            header("Location: http://localhost/board_list.php");
        ?>
    </body
</html>