<?php
require('db.php');

if (empty($_POST["id"])) {
    die();
}

$applicant_id = $_POST["id"];

$sql = "SELECT * FROM radio_q2_hunt_2020 WHERE id = {$applicant_id}";
$result = mysqli_query($conn, $sql) or die("ajax failed");
$output = '';

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        if ($row['apply_for'] == "RJ") {
            $rjinfo = "";
            $otherinfo = "display: none";
        } else {
            $otherinfo = "";
            $rjinfo = "display: none";
        }

        $output .= "<h2><u>Applicant Details</u> ({$row['apply_for']}) <a class='pay_done'> {$row['payment']}</a></h2>
        <div class='left'>
        <div class='tdata'>
            <p class='ttitle'>Full Name:</p>
            <p class='tvalue'>{$row['full_name']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Date of Birth:</p>
            <p class='tvalue'>{$row['date_of_birth']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Present Address:</p>
            <p class='tvalue'>{$row['present_address']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Department:</p>
            <p class='tvalue'>{$row['department']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Mobile Number:</p>
            <p class='tvalue'>{$row['phone_number']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Email:</p>
            <p class='tvalue'>{$row['email']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Extra Curricular Activities:</p>
            <p class='tvalue'>{$row['extra_curriculum_activities']}</p>
        </div>
        <div style='{$rjinfo}' class='tdata'>
            <p class='ttitle'>Why do you want to be RJ:</p>
            <p class='tvalue'>{$row['why_do_you_want_to_be_rj']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>'Not giveing salary' Opinion:</p>
            <p class='tvalue'>{$row['opinion_about_radio']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Connection Type:</p>
            <p class='tvalue'>{$row['broadband_status']}</p>
        </div>
    </div>
    <div class='right'>
        <div class='tdata'>
            <p class='ttitle'>Nick Name:</p>
            <p class='tvalue'>{$row['nick_name']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Gender:</p>
            <p class='tvalue'>{$row['gender']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Permanent Address:</p>
            <p class='tvalue'>{$row['permanent_address']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Session:</p>
            <p class='tvalue'>{$row['session']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Payment Number:</p>
            <p class='tvalue'>{$row['payment_phone_number']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>FB Profile:</p>
            <p class='tvalue'><a href='{$row['fb_profile']}' target='_blank'>{$row['fb_profile']}</a></p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Why do you want to join?</p>
            <p class='tvalue'>{$row['why_do_you_want_to_join']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Can you make friend easily?</p>
            <p class='tvalue'>{$row['can_you_make_friend_easily']}</p>
        </div>
        <div class='tdata'>
            <p class='ttitle'>Do you have PC?</p>
            <p class='tvalue'>{$row['pc_status']}</p>
        </div>
        <div style='{$rjinfo}' class='tdata'>
            <p class='ttitle'>Audio File:</p>
            <p class='tvalue'>
                <audio class='audio' controls>
                    <source src='{$row['uploaded_file']}' type='audio/mp3' />
                </audio>
            </p>
        </div>
        <div style='{$otherinfo}' class='tdata'>
            <p class='ttitle'>Work Links:</p>
            <p class='tvalue'>{$row['worklink']}</p>
        </div>
    </div>";
    }

    mysqli_close($conn);
    echo $output;
} else {
    echo 'No Data Found!';
}
