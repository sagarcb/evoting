<?php

class ResetDataClass
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "evoting";
    public function conn(): bool|mysqli
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($conn->connect_error) {
            return false;
        }
        return $conn;
    }

    public function deleteBallotPaperInfo($ballotNo, $voterId): bool {
        $query = "DELETE FROM `ballotpaperinfo` WHERE ballotnumber='$ballotNo' AND voterid='$voterId'";

        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function resetVoterInfoToNotCasted($voterId): bool {
        $query = "UPDATE `voterinfo` SET votecaststatus = 0 WHERE voterid='$voterId'";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function resetAllVoteCastInfoToNotCasted(): bool {
        $query = "UPDATE `voterinfo` SET votecaststatus = 0";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function deleteAllVoteCast(): bool {
        $query = "DELETE FROM `votecastinfo`";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function deleteAllBallotInfo(): bool {
        $query = "DELETE FROM `ballotpaperinfo`";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function deleteAllCandidate(): bool {
        $query = "DELETE FROM `candidateinfo`";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function deleteAllPosts(): bool {
        $query = "DELETE FROM `postinfo`";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function deleteAllVoters(): bool {
        $query = "DELETE FROM `voterinfo`";
        if ($this->conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function resetAllCastedVote(): bool { //Action A
        if ($this->deleteAllVoteCast() && $this->deleteAllBallotInfo() && $this->resetAllVoteCastInfoToNotCasted()) {
            return true;
        }
        return false;
    }

    public function candidateReset(): bool { //Action B
        if ($this->resetAllCastedVote() && $this->deleteAllCandidate()) {
            return true;
        }
        return false;
    }

    public function resetPost(): bool { //Action C
        if ($this->resetAllCastedVote() && $this->candidateReset() && $this->deleteAllPosts()) {
            return true;
        }
        return false;
    }

    public function voterReset(): bool { //Action D
        if ($this->resetAllCastedVote() && $this->deleteAllVoteCast()) {
            return true;
        }
        return false;
    }

    public function deleteVoter(): bool { //Action E
        if ($this->resetAllCastedVote() && $this->candidateReset() && $this->deleteAllVoters()) {
            return true;
        }
        return false;
    }

    public function resetElection(): bool {
        if ($this->resetAllCastedVote() && $this->candidateReset() && $this->resetPost() && $this->voterReset()) {
            return true;
        }
        return false;
    }


}