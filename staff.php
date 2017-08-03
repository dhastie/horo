<?php

$staff = $_POST["staff"];

$sql = "SELECT * FROM fd_contact WHERE staff=1";
$result = $conn->query($sql);
?>
<select name='staff' id="staff"  onchange="this.form.submit()">

<option value="0">Tous</option>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
		
        <option <?php if($staff == $row["uid"]) echo "selected='selected'";?>  value="<?php echo $row["uid"]; ?>" ><?php echo utf8_encode($row["prenom"]) . " " . utf8_encode($row["nom"]) ?></option>
        
        
		<?php
    }
}

echo "</select>";

?>
