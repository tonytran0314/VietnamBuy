<?php
    include 'db-connector.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vietnam Buy</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/getItem-index.css">
        <link rel="stylesheet" href="style/page-list.css">
    </head>
    <body>
        
        <?php include 'menu.php'; ?>
        
        <main>
            <div class="content-container">
                <?php 
                    if (!isset($_GET['pageno']) or $_GET['pageno'] == 1)
                        include 'index-slides.php'; 
                ?>
                <div class="items-list-container">
                    <?php
                        $sql_countItems = " SELECT * FROM items;";
                        $result_countItems = $conn->query($sql_countItems);
                        $totalItems = $result_countItems->num_rows;
                        $itemsPerPage = 10;
                        $numOfPage = ceil($totalItems / $itemsPerPage);
                        if (isset($_GET['pageno']) and $_GET['pageno'] <= $numOfPage) 
                            $pageno = $_GET['pageno'];
                        else if (!isset($_GET['pageno']) or $_GET['pageno'] > $numOfPage) {
                            $pageno = 1;
                            //header("location: index.php?pageno=1");
                        }
                        $excludeRecords = ($pageno-1) * $itemsPerPage;
                        $sql_getAllItems = "SELECT * FROM items ORDER BY item_id DESC LIMIT $excludeRecords, $itemsPerPage;";
                        $result_getAllItems = $conn->query($sql_getAllItems);
                    ?>

                    <?php 
                        if ($result_getAllItems->num_rows > 0) {
                            while($row = $result_getAllItems->fetch_assoc()) {
                                echo "<div class='card'>";
                                    echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                        echo "<div>";
                                            echo "<img src='imgs/".$row['item_img']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                            echo "<h4>".$row['item_name']."</h4>";
                                            echo "<p>Giá: $".$row['item_price']."</p>";  
                                        echo "</div>";
                                    echo "</a>";
                                echo "</div>";
                            }
                        } else echo "0 results";
                    ?>
                </div>
                <div class="clear-float"></div>
                
                <div class="page-list-container">
                    <ul class="page-list-ul">
                        <?php
                            for ($count = 1; $count <= $numOfPage; $count++) {
                                echo "<li><a href='index.php?pageno=".$count."' >".$count."</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="my-clearfix"></div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
        
        <?php include 'footer.php'; ?>
    </body>
    <?php $conn->close(); ?>
</html>