<?php
include_once './header.php';
include_once './db.php';
?>
<section id="main" class="wrapper style1">
    <div class="container">
        <div class="row">
            <div class="4u">
                <h2>Login</h2>
                <hr />
                <section>
                    <form action="login_check.php" method="post">
                        Email: <input type="text" name="email" required="required" /><br />                           
                        Password: <input type="password" name="pass" required="required" /><br />
                        <input type="submit" value="Login" class="button special" />
                        <input type="reset" value="Cancel" class="button alt" />            
                    </form>
                </section>
            </div>
            <div class="8u skel-cell-important">
                <h2>Register</h2>
                <hr />
                <section>
                    <form action="user_insert.php" method="post">
                        First Name: <input type="text" name="name" required="required" /><br />
                        Surname: <input type="text" name="surname" required="required" /><br />
                        Email: <input type="email" name="email" required="required" /><br />                       
                        Password: <input type="password" name="pass1" required="required" /><br />
                        Reenter password: <input type="password" name="pass2" required="required" /><br />
                        Country:<select name="cu">
                            <?php
                            $query = "SELECT name FROM countries ORDER BY name ASC";
                            $result = mysqli_query($link, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value = "' . $row['name'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <br/>
                        <input type="submit" value="Register" class="button special" />
                        <input type="reset" value="Cancel" class="button alt" />            
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
<?php
include_once './footer.php';
?>