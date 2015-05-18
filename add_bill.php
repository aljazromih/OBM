<?php
include_once './header.php';
include_once './db.php';
include_once './session.php';
if ($_SESSION['logged'] != 1) {
    header("Location: index.php");
}
?>

<!-- Main -->
<section id="main" class="wrapper style1">
    <header class="major">
        <h2>Add bill</h2>
    </header>
    <div class="container">
        <div class="row">
            <div class="12u">
                <a href="purpose_add.php"><button class="button small special">Add purpose</button></a><br /><br />
            </div>
            <div class="12u">
                <form action="bill_insert.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="6u">
                            Name: <input type="text" name="name" required="required" />
                        </div>
                        <div class="6u">
                            Date: <br /><input type="date" name="date" required="required" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="3u">
                            Currency:<select name="currency">
                                <?php
                                $query = "SELECT abb FROM currencies ORDER BY id ASC;";
                                $result = mysqli_query($link, $query);
                                $query2 = "SELECT c.abb FROM currencies c INNER JOIN countries co ON c.id = co.currency_id INNER JOIN users u ON co.id = u.country_id WHERE u.id = '" . $_SESSION['user_id'] . "';";
                                $result2 = mysqli_query($link, $query2);
                                $row2 = mysqli_fetch_array($result2);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['abb'] == $row2['abb']) {
                                        echo '<option selected = "selected" value = "' . $row['abb'] . '">' . $row['abb'] . '</option>';
                                    } else {
                                        echo '<option value = "' . $row['abb'] . '">' . $row['abb'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="3u">
                            Value: <br /><input type="number" name="value" required="required" min="0.00" step="any" />
                        </div>
                        <div class="6u">
                            Purpose: <select name="purpose">
                                <?php
                                $query = "SELECT name FROM purposes WHERE visible = '1' OR user_id = '" . $_SESSION['user_id'] . "' ORDER BY id ASC;";
                                $result = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option  value = "' . $row['name'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="12u">
                            Description: <textarea name="description" rows="4"></textarea>
                        </div>
                    </div>
                    <br />
                    <input type="file" name="file"/><br /><br />
                    <input type="submit" value="Add bill" class="button special" />
                    <input type="reset" value="Cancel" class="button alt" />
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include_once './footer.php';
?>