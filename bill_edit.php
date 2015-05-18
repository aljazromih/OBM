<?php
include_once './header.php';
include_once './db.php';
include_once './session.php';
if($_SESSION['logged'] != 1){
    header("Location: index.php");
}

$bill_id = $_GET['id'];
$_SESSION['bill_edit'] = $bill_id;

$query = "SELECT * FROM bills WHERE id = ".$bill_id.";";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
?>

<!-- Main -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Edit bill</h2>
				</header>
				<div class="container">
					<div class="row">
                                            <div class="12u">
                                                <form action="bill_update.php" method="post" enctype="multipart/form-data">
                                                    Name: <input type="text" name="name" required="required" value="<?php echo $row['name']; ?>" /><br />
                                                    Date: <input type="date" name="date" required="required" value="<?php echo $row['day']; ?>"/><br />
                                                    Currency:<select name="currency">
                                                        <?php
                                                        $query = "SELECT abb FROM currencies ORDER BY id ASC;";
                                                        $result = mysqli_query($link, $query);
                                                        $query2 = "SELECT abb FROM currencies WHERE id = '".$row['currency_id']."';";
                                                        $result2 = mysqli_query($link, $query2);
                                                        $row2 = mysqli_fetch_array($result2);
                                                        while ($row3 = mysqli_fetch_array($result)) {
                                                            if($row3['abb'] == $row2['abb']){
                                                                echo '<option selected = "selected" value = "' . $row3['abb'] . '">' . $row3['abb'] . '</option>';
                                                            }
                                                            else{
                                                                echo '<option value = "' . $row3['abb'] . '">' . $row3['abb'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select><br />
                                                    Value: <input type="number" name="value" required="required" min="0.00" step="any" value="<?php echo $row['value']; ?>"/><br />
                                                    Purpose: <select name="purpose">
                                                        <?php
                                                        $query = "SELECT name FROM purposes ORDER BY id ASC;";
                                                        $result = mysqli_query($link, $query);
                                                        $query2 = "SELECT name FROM purposes WHERE id = '".$row['purpose_id']."';";
                                                        $result2 = mysqli_query($link, $query2);
                                                        $row2 = mysqli_fetch_array($result2);
                                                        while ($row3 = mysqli_fetch_array($result)) {
                                                            if($row3['name'] == $row2['name']){
                                                                echo '<option selected = "selected" value = "' . $row3['name'] . '">' . $row3['name'] . '</option>';
                                                            }
                                                            else{
                                                                echo '<option value = "' . $row3['name'] . '">' . $row3['name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    Description: <textarea name="description" rows="4"><?php echo $row['description']; ?></textarea><br />
                                                    <!--<input type="file" name="file"/><br /><br />-->
                                                    <input type="submit" value="Update" />
                                                </form>
                                            </div>
					</div>
				</div>
			</section>

<?php
        include_once './footer.php';
?>