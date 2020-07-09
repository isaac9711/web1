<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>board_list.php</title>
        <link rel="stylesheet" href="/css/bootstrap.css">
    </head>
    <body>
        <h1 class="display-4">board_list.php</h1>
        
        <?php
            $currentPage = 1;
            if (isset($_GET["currentPage"])) {
                $currentPage = $_GET["currentPage"];
            }
 
            $conn = mysqli_connect("localhost", "root");
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }

            $sqlCount = "SELECT count(*) FROM board";
            $resultCount = mysqli_query($conn,$sqlCount);
            if($rowCount = mysqli_fetch_array($resultCount)){
                $totalRowNum = $rowCount["count(*)"];
            }

            if($resultCount) {
                echo "행 갯수 조회 성공 : ". $totalRowNum."<br>";
            } else {
                echo "결과 없음: ".mysqli_error($conn);
            }
                        
            $rowPerPage = 5; 
            $begin = ($currentPage -1) * $rowPerPage;
            $sql = "SELECT board_no, board_title, board_user, board_date FROM board order by board_no desc limit ".$begin.",".$rowPerPage."";
            $result = mysqli_query($conn,$sql);
            if($result) {
                echo "조회 성공";
            } else {
                echo "결과 없음: ".mysqli_error($conn);
            }
        ?>
        <table class="table table-bordered">
            <tr>
                <td>board_no</td>
                <td>board_title</td>
                <td>board_user</td>
                <td>board_date</td>
                <td>수정</td>
                <td>삭제</td>
            </tr>
            <?php
                while($row = mysqli_fetch_array($result)){ 
            ?>
                <tr>
                    <td>
                        <?php
                            echo $row["board_no"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "<a href='/board_detail.php?board_no=".$row["board_no"]."'>";
                            echo $row["board_title"];
                            echo "</a>";
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["board_user"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["board_date"];
                        ?>
                    </td>
                        <?php
                            echo "<td><a href='/board_update_form.php?board_no=".$row["board_no"]."'>수정</a></td>";
                            echo "<td><a href='/board_delete_form.php?board_no=".$row["board_no"]."'>삭제</a></td>";
                        ?>
                </tr>
            <?php
                }
            ?>
        </table>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            if($currentPage > 1 ) { 
                echo "<a class='btn btn-primary' href ='/board_list.php?currentPage=".($currentPage-1)."'>이전</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
 
            $lastPage = ($totalRowNum-1) / $rowPerPage;
 
            if (($totalRowNum-1) % $rowPerPage !=0) { 
                $lastPage += 1;
            }
            if($currentPage < $lastPage) { 
                echo "<a class='btn btn-primary' href='/board_list.php?currentPage=".($currentPage+1)."'>다음</a>";
            }
            mysqli_close($conn);
        ?>
        &nbsp;&nbsp;
        <a class="btn btn-primary" href="/board_add_form.php">글 쓰기</a>
        <br><br><br><br><br>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>