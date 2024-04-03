<?php
    include 'database.php';
   
    //proses show data
    $q_select ="select * from task where taskid = '".$_GET['id']."'";
    $run_q_select = mysqli_query($conn, $q_select);
    $d = mysqli_fetch_object($run_q_select);
    
    //Proses Edit Data
    if(isset($_POST['edit'])){
        
        $q_update ="update task set tasklabel ='".$_POST['tugas']."' where taskid = '".$_GET['id']."' ";
        $run_q_update = mysqli_query($conn, $q_update);

        header('Refresh:0; url=index.php');
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do List</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            background: #c31432;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #240b36, #c31432);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #240b36, #c31432);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .container {
            width: 590px;
            height: 100vh;
            margin: 0 auto;
        }
        .header{
            padding: 15px;
            color: white;
        }
        .header .title{
            display: flex;
            align-items: center;
            margin-bottom: 7px;
        }
        .header .title i{
            font-size: 20px;
            margin-right: 10px;
            color:white;
        }
        .header .title span{
            font-size: 24px;
        }
        .header .description {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .content{
            padding: 15px;
        }
        .card {
            background-color: aquamarine;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .input-control{
            width: 100%;
            display: block;
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .tombol1 {
            text-align: right;
        }
        button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            background-color: #c31432;
            color: white;
            border: 1px solid;
            border-radius: 3px;
        }
        .task-item {
            color: white;
            display: flex;
            justify-content: space-between;
        }
        .tombol2 {
            color: orange;
        }
        .tombol3 {
            color : red;
        }
        .task-item.done span{
            text-decoration: line-through;
            color: white;

        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div class="title">
            <a href="index.php"><i class='bx bx-chevron-left'></i></a>
            <span>Back</span>
            </div>
            <div class="description">
                <?= date("l, d M Y")?>
            </div>
        </div>
            <div class="content">

            <div class="card">

                <form action="" method="post">
                    <input type="text" name="tugas" class="input-control" placeholder="Edit task" value="<?= $d->tasklabel?>">
                        <div class="tombol1">
                            <button type="submit" name="edit">Edit</button>
                        </div>
                </form>
            </div>

            </div>

       

    </div>

</body>

</html>