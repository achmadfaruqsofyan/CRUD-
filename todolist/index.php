<?php
include 'database.php';

// Proses Input Data
if (isset($_POST['add'])) {
    $q_insert = "insert into task (tasklabel, taskstatus) value (
            '" . $_POST['tugas'] . "',
            'open'
        )";
    $run_q_insert = mysqli_query($conn, $q_insert);

    if ($run_q_insert) {
        header('Refresh:0 url=index.php');
    }
}

//proses show data
$q_select = "select * from task order by taskid desc";
$run_q_select = mysqli_query($conn, $q_select);

//proses Hapus Data
if (isset($_GET['delete'])) {

    $q_delete = "delete from task where taskid= '" . $_GET['delete'] . "' ";
    $run_q_delete = mysqli_query($conn, $q_delete);

    header('Refresh:0; url=index.php');
}

//Proses Update Data Close or Open
if (isset($_GET['done'])) {
    $status = 'close';
    if ($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "update task set taskstatus ='" . $status . "' where taskid = '" . $_GET['done'] . "' ";
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

        .header {
            padding: 15px;
            color: white;
        }

        .header .title {
            display: flex;
            align-items: center;
            margin-bottom: 7px;
        }

        .header .title i {
            font-size: 20px;
            margin-right: 10px;
        }

        .header .title span {
            font-size: 24px;
        }

        .header .description {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .content {
            padding: 15px;
        }

        .card {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            background: #0F2027;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .input-control {
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
            color: red;
        }

        .task-item.done span {
            text-decoration: line-through;
            color: white;

        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div class="title">
                <i class='bx bxs-balloon'></i>
                <span>To Do List</span>
            </div>
            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>
        <div class="content">

            <div class="card">

                <form action="" method="post">
                    <input type="text" name="tugas" class="input-control" placeholder="Add task">
                    <div class="tombol1">
                        <button type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>

            <?php
            if (mysqli_num_rows($run_q_select) > 0) {
                while ($r = mysqli_fetch_array($run_q_select)) {
            ?>
                    <div class="card">
                        <div class="task-item <?= $r['taskstatus'] == 'close' ? 'done' : '' ?>">
                            <div>
                                <input type="checkbox" onclick="window.location.href='?done= <?= $r['taskid'] ?> &status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                                <span><?= $r['tasklabel'] ?></span>
                            </div>
                            <div>
                                <a href="edit.php?id=<?= $r['taskid'] ?>" class="tombol2" title="edit"><i class="bx bx-edit"></i></a>
                                <a href="?delete=<?= $r['taskid'] ?> " class="tombol3" title="delete" onclick="return confirm('Yakin Hapus ini ?')"><i class="bx bx-trash"></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div> Belum Ada Task</div>
            <?php } ?>

        </div>



    </div>

</body>

</html>