<?php
include_once './header.php';
include_once './db.php';
include_once './session.php';
if($_SESSION['logged'] != 1){
    header("Location: index.php");
}
?>

<!-- Main -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Add your purpose</h2>
				</header>
				<div class="container">
					<div class="row">
                                            <div class="12u">
                                                <form action="purpose_insert.php" method="post" enctype="multipart/form-data">
                                                    Name: <input type="text" name="name" required="required" /><br />
                                                    <input type="submit" value="Add purpose" class="button special" />
                                                    <input type="reset" value="Cancel" class="button alt" />
                                                </form>
                                            </div>
					</div>
				</div>
			</section>

<?php
        include_once './footer.php';
?>