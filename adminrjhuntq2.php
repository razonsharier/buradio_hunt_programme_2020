<?php
session_start();
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');

require('db.php');

$filterid = "p";
if (isset($_GET['filter'])) {
    $filterid = $_GET['filter'];
}

if (isset($_POST['receive'])) {
    $getid = $_POST['receive'];
    $recqury = "UPDATE radio_q2_hunt_2020 SET payment = 'Paid' WHERE id = '$getid'";
    mysqli_query($conn, $recqury);
} else {
}
if (isset($_POST['undorec'])) {
    $getid = $_POST['undorec'];
    $recunqury = "UPDATE radio_q2_hunt_2020 SET payment = '' WHERE id = '$getid'";
    mysqli_query($conn, $recunqury);
} else {
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BURADiO - RJ HUNT, 2020 - Admin Panel</title>
    <link rel="shortcut icon" href="img/logo/favicon.ico">

    <style>
        body,
        html {
            margin: 0;
        }

        select,
        button {
            margin: 0 auto;
            max-width: 120px;
            width: 100%;
            position: relative;
        }

        input {
            width: 30px;
        }

        #containbody {
            margin: 0 auto;
            max-width: 900px;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 80px;
            background-color: #ffffff;
            overflow: auto;
            text-align: center;
        }

        .abutton {
            padding: 0;
            border: 0;
            width: 40px;
            height: 20px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 13px;
            width: 400px;
        }

        td,
        th {
            padding: 10px;
            max-width: 400px;
            border: 1px solid #D9E4E6;
        }

        .responstable {
            margin: 1em 0;
            width: 100%;
            overflow: hidden;
            background: #FFF;
            color: #024457;
            margin-bottom: 50px;
        }

        .responstable tr {
            border: 1px solid #D9E4E6;
            height: 30px;
            width: 400px;
            width: 100%;
            text-align: left;
            padding: 10px;
        }

        .responstable th {
            border: 1px solid #D9E4E6;
            background-color: rgb(92, 187, 224);
            color: #ffffff;
        }

        .responstable tr:nth-child(odd) {
            background-color: #EAF3F3;

        }

        .responstable td:first-child {
            display: table-cell;
            text-align: left;
            border-right: 1px solid #D9E4E6;
        }

        select {
            color: #44443d;
            padding: 0px;
            border: 1px solid rgb(203, 203, 203);
            height: 30px;
            width: 100%;
            outline: none;
            font-size: 14px;
            text-align: left;
            background-color: #f5f5f5;
            max-width: 250px;
            border-radius: 7px;
            margin-top: 3px;
            margin-left: 3px;
        }

        option {
            padding: 10px;
        }

        #modal {
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
            font-family: Arial, Helvetica, sans-serif;
            overflow: auto;
        }

        #modal-form {
            background: #fff;
            width: 700px;
            position: relative;
            top: 5%;
            padding: 15px;
            border-radius: 4px;
            margin: 0 auto;
            overflow: auto;
        }

        #close-btn {
            background: orangered;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            cursor: pointer;
            float: right;
            margin-top: -10px;
            margin-right: -10px;
        }

        .left {
            display: inline-block;
            font-size: 16px;
            float: left;
            width: 340px;
        }

        .right {
            display: inline-block;
            float: right;
            width: 340px;
        }

        .tdata {
            border-bottom: 1px solid #eee;
        }

        .ttitle {
            font-size: 12px;
        }

        .tvalue {
            margin-top: -10px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 0px;
        }

        .audio {
            margin-top: 0px;
            width: 200px;
            height: 30px;
            margin-bottom: 2px;
        }

        .pay_done {
            background-color: #fec107;
            color: #ffffff;
            padding: 5px 20px;
            border-radius: 3px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div id="containbody">
        <h2><strong>
                <h2 style="text-align: left;">BURADiO - RJ HUNT, 2020 (Admin)</h2>
            </strong></h2>
        <div style="text-align: left;">
            <form action="" method="GET">
                <select name="filter" style="width: 350px;" onchange="javascript:this.form.submit()">
                    <option value="0" hidden>Filter Database</option>
                    <option value="p">All</option>
                    <option value="RJ">Radio Jocky</option>
                    <option value="Video Editor">Video Editor</option>
                    <option value="Graphics Designer">Graphics Designer</option>
                </select>
            </form>
        </div>

        <table class="responstable">
            <tbody>
                <tr>
                    <th style="width: 20px;">Serial</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th style='width: 120px'>Designation</th>
                    <th style='width: 120px'>Payment Status</th>
                    <th style='width: 100px'>Details</th>
                </tr>

                <?php
                $sqlr = "SELECT * FROM radio_q2_hunt_2020 WHERE extra_f like '$filterid' OR apply_for like '$filterid' ORDER BY id DESC";
                $resultr = mysqli_query($conn, $sqlr);
                $countr = mysqli_num_rows($resultr);
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {

                    if ($rowr['payment'] == "Paid") {
                        $statusb = "display: none"; //hide button
                        $statust = "display: block"; //show text
                    } else {
                        $statusb = "display: block"; //show button
                        $statust = "display: none"; //hide text
                    }

                ?>
                    <tr>
                        <td><?php echo @$snr += 1; ?></td>
                        <td><?php echo $rowr['full_name'] ?></td>
                        <td>
                            <?php echo $rowr['phone_number'] ?>
                            <br />
                            <?php echo $rowr['payment_phone_number'] ?>
                        </td>
                        <td><?php echo $rowr['apply_for'] ?></td>
                        <form action="" method="post">
                            <td>
                                <div>
                                    <p title="<?php echo $rowr['id'] ?>" style="<?php echo $statust ?>"><?php echo $rowr['payment'] ?> -<button class="abutton" value="<?php echo $rowr['id'] ?>" type="submit" name="undorec"><em>Undo</em></button></p>
                                    <button style="<?php echo $statusb ?>" value="<?php echo $rowr['id'] ?>" title="<?php echo $rowr['id'] ?>" type="submit" name="receive">Receiving</button>
                                </div>
                            </td>
                        </form>
                        <td><button class="edit-btn" data-eid='<?php echo $rowr["id"] ?>' value="<?php echo $rowr['id'] ?>" type="submit" name="details" title="<?php echo $rowr['id'] ?>">Details</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="modal">
        <div id="modal-form">
            <div id="close-btn">X</div>
            <div id="details">

            </div>
        </div>
    </div>


    <script type="text/javascript" src="js/jquery.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".edit-btn", function() {
            $("#modal").show();
            var applicantId = $(this).data("eid");

            $.ajax({
                url: "details.php",
                type: "POST",
                data: {
                    id: applicantId
                },
                success: function(data) {
                    $("#modal-form #details").html(data);
                }
            })
        });

        $("#close-btn").on("click", function() {
            $("#modal").hide();
        });
    </script>

</body>

</html>