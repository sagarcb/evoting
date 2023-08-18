<?php
include_once "unauthenticated_redirection.php";
include_once "php/db.php";

$voteCastStatus = checkVoterVoteCastStatus($voterid, $conn);
$isVotEnable = false;
if ($voteCastStatus) {
    $electionDetailsQuery = "SELECT * FROM `electioninfo` WHERE electionstatus=1";
    $result = mysqli_query($conn, $electionDetailsQuery);
    $data = mysqli_fetch_assoc($result);
    $electionIsOpen = false;
    $postDetails = [];
    $voterBatch = $_SESSION['voterinfo']['batch'];
    if (!empty($data)) {
        $electionIsOpen = true;
        $getPostDataQuery = "SELECT postinfo.*, c.candidatename,c.candidateimage,c.candidateid FROM `postinfo` 
                                LEFT JOIN candidateinfo c on postinfo.postid = c.postid
                                WHERE postinfo.posttype=0 OR postinfo.posttype='$voterBatch'";
        $result = mysqli_query($conn, $getPostDataQuery);
        if (!empty($result)) {
            $isVotEnable = true;
            while ($row = $result->fetch_assoc()) {
                $postid = $row['postid'];
                if (!isset($data[$postid])) {
                    $postDetails[$postid]['post_title'] = $row['postdescription'];
                    $postDetails[$postid]['multiple_person'] = $row['multiple_person'];
                    $postDetails[$postid]['post_id'] = $postid;
                }
                if ($row['candidateid']) {
                    $postDetails[$postid]['candidates'][] = [
                        'candidatename' => $row['candidatename'],
                        'candidateimage' => $row['candidateimage'],
                        'candidateid' => $row['candidateid']
                    ];
                }
            }
        }
    }
}

function checkVoterVoteCastStatus($voterid, $conn) {
    $query = "SELECT * FROM `voterinfo` WHERE voterid='$voterid'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if (!empty($data) && $data['votecaststatus'] == 0) {
        return true;
    }
    return false;
}

?>




<?php include 'header.php'?>
<div class="container">
    <?php include 'navbar.php' ?>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .main-content .main-heading {
            background: #198754;
            height: 56px;
            color: #FFFFFF;
            padding-top: 0.65%;
            margin-bottom: 20px;
        }

        .main-content .vote-completed-section {
            text-align: center;
        }

        .main-content .vote-completed-section button {
            background: #198754;
            border-radius: 5px;
            cursor: pointer;
            color: #FFFFFF;
            border: none;
            height: 50px;
            width: 19%;
        }

        .main-content .post-details-section {
            border: 1px solid #54537C;
            border-radius: 10px;
        }

        .post-details-section .heading {
            background: #54537C;
            border-radius: 8px 8px 0 0;
            height: 50px;
            color: white;
            padding-left: 1%;
            padding-top: 0.7%;
        }

        .post-details-section .post-body {
            padding-left: 1%;
        }

        .post-body .vote-section {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
            margin-bottom: 5px;
        }

        .vote-input-box {
            width: 25px;
        }

        .submit-voting-section {
            border: 1px solid #54537C;
            border-radius: 10px;
            padding: 17px;
            margin-bottom: 10px;
        }

        .submit-voting-body {
            width: 55%;
            margin-left: auto;
            margin-right: auto;
        }

        #submit-vote-btn {
            background: #198754;
            border-radius: 5px;
            cursor: pointer;
            color: #FFFFFF;
            border: none;
            height: 50px;
            width: 20%;
        }

    </style>

    <div class="main-content">
        <div class="main-heading">
            <div class="container">
                <h3>Ballot Position</h3>
            </div>
        </div>
        <div class="container">
            <div class="body">
                <?php if ($voteCastStatus) {?>
                    <?php if ($electionIsOpen && !empty($postDetails)) { ?>
                        <?php foreach ($postDetails as $postDetail) { ?>
                            <div class="post-details-section" style="margin-bottom: 10px">
                                <div class="heading">
                                    <h4><?=$postDetail['post_title']?> :</h4>
                                </div>
                                <div class="post-body">
                                    <p class="disclaimer">Select only <span style="font-weight: bold"><?=$postDetail['multiple_person'] > 0 ? $postDetail['multiple_person'] : 1?></span> candidate</p>
                                    <div class="vote-section">
                                        <?php if (!empty($postDetail['candidates'])) {
                                                foreach ($postDetail['candidates'] as $candidate) { ?>
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-md-1" style="text-align: right;">
                                                <input class="form-control vote-input-box checkbox-<?=$postDetail['post_id']?>" type="checkbox" data-candidateid="<?=$candidate['candidateid']?>" data-postid="<?=$postDetail['post_id']?>">
                                            </div>
                                            <div class="col-md-5" style="padding-top: 1%; margin-right: 0; padding-right: 0">
                                                <?=$candidate['candidatename']?>
                                            </div>
                                            <div class="col-md-6" style="margin-left: 0; padding-left: 0">
                                                <?php
                                                $candidateImage = "../Dashboard/candidate/candidate_images/avatar.jpg";
                                                if ($candidate['candidateimage']) {
                                                    $candidateImage = "../Dashboard/candidate/candidate_images/" . $candidate['candidateimage'];
                                                }
                                                ?>
                                                <img height="50px" width="50px" src="<?=$candidateImage?>" alt="">
                                            </div>
                                        </div>
                                         <?php } }else { ?>
                                            <p class="ml-auto mr-auto text-center">No Candidates Available...</p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    let multiplePersonCount = <?=$postDetail['multiple_person']?>;
                                    function countSelectedCheckboxes() {
                                        return $(".checkbox-<?=$postDetail['post_id']?>:checked").length;
                                    }

                                    $(".checkbox-<?=$postDetail['post_id']?>").on("change", function() {
                                        if (countSelectedCheckboxes() > multiplePersonCount) {
                                            this.checked = false;
                                            Toastify({
                                                text: `You can't select more than ${multiplePersonCount} persons.`,
                                                duration: 3000,
                                                gravity: "top",
                                                position: "center",
                                                close: true,
                                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Customize background color
                                                stopOnFocus: true,
                                            }).showToast();
                                        }
                                    });
                                })
                            </script>
                        <?php }?>

                        <div class="submit-voting-section">
                            <div class="submit-voting-body">
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-4">
                                        Submit your login email:
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" id="loginEmail">
                                    </div>
                                </div>
                                <div class="ml-auto mr-auto text-center">
                                    <button class="btn"  id="submit-vote-btn">Submit Vote</button>
                                </div>
                            </div>

                        </div>
                    <?php }else{
                        if ($electionIsOpen) {?>
                        <div class="vote-completed-section" style="margin-top: 15px">
                            <img src="./img/vote_closed.png" alt="" style="width: 14%">
                            <h3>No Posts are available right now!</h3>
                            <a href="dashboard.php"><button>Back To Dashboard-></button></a>
                        </div>
                    <?php }else { ?>
                        <div class="vote-completed-section" style="margin-top: 15px">
                            <img src="./img/vote_closed.png" alt="" style="width: 14%; margin-bottom: 5px">
                            <h3 style="margin-bottom: 20px">Poll is inactive now..!</h3>
                            <a href="dashboard.php"><button>Back To Dashboard-></button></a>
                        </div>

                    <?php } ?>
                <?php }}else {?>
                    <div class="vote-completed-section">
                        <img src="./img/vote-completed.gif" alt="" style="width: 14%">
                        <h3>You have already submitted your vote!</h3>
                        <a href="dashboard.php"><button>Back To Dashboard-></button></a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php include 'copyright.php'?>
<?php include 'footer.php'?>

<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    <?php if (!$isVotEnable) { ?>
    .footer {
        position: absolute !important;
        bottom: 0 !important;
        width: 100% !important;
    }
    <?php } ?>
</style>

<script>
    $(document).ready(function () {
        $('#submit-vote-btn').on('click', function () {
            var votedCheckedBoxes = $("input[type=checkbox]:checked");
            var loginEmail = $('#loginEmail').val();
            let dataArray = [];
            if (loginEmail) {
                if (votedCheckedBoxes.length > 0) {
                    $(votedCheckedBoxes).each(function (index, element) {
                        dataArray.push({
                            candidateid: $(element).data('candidateid'),
                            postid: $(element).data('postid'),
                            voterid: <?=$voterid?>
                        })
                    })

                    $.ajax({
                        url: 'vote-submission.php',
                        type: 'POST',
                        data: {
                            data: dataArray,
                            loginemail: loginEmail,
                            voter_id: <?=$voterid?>
                        },
                        success: function (data) {
                            let resp = JSON.parse(data);
                            if (resp.status) {
                                window.location.href = "dashboard.php";
                            }else {
                                toastMessage(resp.msg);
                            }
                        },
                        error: function (error) {
                            console.log(error)
                            toastMessage(error);
                        }
                    })
                }else {
                    toastMessage('No voting option is selected!')
                }
            }else {
                toastMessage('Please enter your login email!')
            }


        });

        function toastMessage(msg) {
            Toastify({
                text: msg,
                duration: 3000,
                gravity: "top",
                position: "center",
                close: true,
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Customize background color
                stopOnFocus: true,
            }).showToast();
        }
    })
</script>
