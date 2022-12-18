<html>
    <head>
        <meta charset="utf-8">
    </head>
<body>
 
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <thead>
                    <tr>
                        <th>IAMGE</th>
                     
                    </tr>
                </thead>
                <?php
                    require_once './func/dbconfig.php';
                    $query = "select * from post";
                    $query_run = mysqli_query($conn, $query);
                    
                    while($row = mysqli_fetch_array($query_run))
                    {
                        echo '<img src="data:image;base64,'.base64_encode($row['Image']).'" alt="Image" style="width: 300px; height: 300px;">';       
                    }
                ?>
            </table>
        <form>
</body>
</html>