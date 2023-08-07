<?php
include_once "unauthenticated_redirection.php";
include_once "php/db.php";

$voteCastStatus = checkVoterVoteCastStatus($voterid, $conn);

if ($voteCastStatus) {
    $electionDetailsQuery = "SELECT * FROM `electioninfo` WHERE electionstatus=1";
    $result = mysqli_query($conn, $electionDetailsQuery);
    $data = mysqli_fetch_assoc($result);
    $electionIsOpen = false;
    $postDetails = [];
    $voterBatch = 3;
    if (!empty($data)) {
        $electionIsOpen = true;
        $getPostDataQuery = "SELECT postinfo.*, c.candidatename,c.candidateimage,c.candidateid FROM `postinfo` 
                                LEFT JOIN candidateinfo c on postinfo.postid = c.postid
                                WHERE postinfo.posttype=0 OR postinfo.posttype='$voterBatch'";
        $result = mysqli_query($conn, $getPostDataQuery);
        if (!empty($result)) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .main-content {
            border: 1px solid #eeebeb;
            background: #fffcf5;
            padding-top: 1%;
            padding-bottom: 10%;
        }

        .post-details {
            width: 70%;
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
        }
        .candidate-card {
            padding: 5px;
        }

        .candidate {
            display: flex;
        }
        .candidate * {
            margin-left: 5px;
        }
        .candidate-name {
            margin-top: auto;
            font-weight: bold;
        }
        .candidateImage img {
            border-radius: 25px;
        }
        .vote-input-box {
            width: 25px;
        }

    </style>

    <div class="main-content">
        <h3 style="text-align: center">Voting Panel</h3>
        <hr>
        <div class="post-details">
            <?php
            if ($voteCastStatus) {
            if ($electionIsOpen && !empty($postDetails)) { ?>
            <ul>
                <?php foreach ($postDetails as $postDetail) { ?>
                <li>
                    <h4 style="margin-bottom: 0; padding-bottom: 0">Post Name: <?=$postDetail['post_title']?></h4>
                    <p style="padding-top: 0; margin-top: 0"><span>Disclaimer:</span> Select only <span style="font-weight: bold"><?=$postDetail['multiple_person'] > 0 ? $postDetail['multiple_person'] : 1?></span> persons.</p>
                    <div class="row">
                        <?php
                            if (!empty($postDetail['candidates'])) {
                                foreach ($postDetail['candidates'] as $candidate) {
                        ?>
                        <div class="col-md-6 candidate-card">
                           <div class="candidate">
                               <input class="vote-input-box checkbox-<?=$postDetail['post_id']?>" type="checkbox" data-candidateid="<?=$candidate['candidateid']?>" data-postid="<?=$postDetail['post_id']?>">
                               <p class="candidate-name"><?=$candidate['candidatename']?></p>
                               <div class="candidateImage">
                                   <?php
                                        $candidateImage = "../Dashboard/candidate/candidate_images/avatar.jpg";
                                        if ($candidate['candidateimage']) {
                                            $candidateImage = "../Dashboard/candidate/candidate_images/" . $candidate['candidateimage'];
                                        }
                                   ?>
                                   <img height="50px" width="50px" src="<?=$candidateImage?>" alt="">
                               </div>
                           </div>
                        </div>
                        <?php } }else { ?>
                                <p class="ml-auto mr-auto">No Candidates Available...</p>
                        <?php } ?>
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
                                        position: "right",
                                        close: true,
                                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Customize background color
                                        stopOnFocus: true,
                                    }).showToast();
                                }
                            });
                        })
                    </script>
                </li>
                    <hr>
                <?php }?>
            </ul>
                <div class="ml-auto mr-auto text-center">
                    <button class="btn btn-primary"  id="submit-vote-btn">Submit Vote</button>
                </div>
            <?php }else {
                if ($electionIsOpen) {
                ?>
                    <p class="ml-auto mr-auto text-center">No Posts Available</p>
                    <?php }else { ?>
                    <p class="ml-auto mr-auto text-center">No Election is Active right now...</p>
            <?php }}}else { ?>
                <p class="ml-auto mr-auto text-center">You have already submitted your vote!</p>
                <p class="ml-auto mr-auto text-center"><a class="ml-auto mr-auto text-center" href="dashboard.php">Go back To Home</a></p>
            <?php } ?>
        </div>
    </div>
</div>
<?php include 'footer.php'?>

<script>
    $(document).ready(function () {
        $('#submit-vote-btn').on('click', function () {
            var votedCheckedBoxes = $("input[type=checkbox]:checked");
            let dataArray = [];
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
                        data: dataArray
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

        });

        function toastMessage(msg) {
            Toastify({
                text: msg,
                duration: 3000,
                gravity: "top",
                position: "right",
                close: true,
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Customize background color
                stopOnFocus: true,
            }).showToast();
        }
    })
</script>
