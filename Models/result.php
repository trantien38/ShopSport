<?php
    $result =$this->con->query($query);
    $data=array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
?>