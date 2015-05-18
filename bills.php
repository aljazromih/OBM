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
					<h2>Bills</h2>
					<p>See all of your bills in one place</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="8u">
                                                    <section>
                                                        <table border="1" style="width:100%" border-radius="25px">
                                                            <tr>
                                                              <th>Name</th>
                                                              <th>Purpose</th>		
                                                              <th>Date</th>		
                                                              <th>Value</th>
                                                              <th></th>
                                                              <th></th>
                                                            </tr>
                                                            <?php
                                                                $query = "SELECT b.id, b.name AS bname, p.name AS pname, b.day, b.value, c.abb FROM bills b INNER JOIN purposes p ON p.id = b.purpose_id"
                                                                        ." INNER JOIN currencies c ON c.id = b.currency_id WHERE b.user_id = ".$_SESSION['user_id']." ORDER BY b.day DESC;";
                                                                $result = mysqli_query($link, $query);
                                                                while($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<tr class="clickableRow"  href="bills.php?bill='.$row['id'].'"><td>'.$row['bname'].'</td>'
                                                                            . '<td>'.$row['pname'].'</td>'
                                                                            . '<td>'.date('d.m.Y',strtotime($row['day'])).'</td>'
                                                                            . '<td>'.$row['value']." ".$row['abb'].'</td>'
                                                                            . '<td><a href="bill_edit.php?id='.$row['id'].'"><button type="button" class="button small special">Edit</button></a><a href="bill_delete.php?id='.$row['id'].'"><button type="button" class="button small alt">Delete</button></a></td></tr>';
                                                                }
                                                            ?>
                                                        </table>
                                                    </section>
						</div>
						<div class="4u">
							<section>
                                                            <?php
								if(isset($_GET['bill'])){
                                                                    $query = "SELECT name, description, image_path FROM bills WHERE id = ".$_GET['bill']." AND user_id = ".$_SESSION['user_id'].";";
                                                                    $result = mysqli_query($link, $query);
                                                                    
                                                                    if(mysqli_num_rows($result) == 1){
                                                                        $row = mysqli_fetch_assoc($result);
                                                                        echo '<div class="desc"><h3>'.$row['name'].'</h3>'
                                                                                . '<p>'.$row['description'].'<p></div><br />';
                                                                        if($row['image_path'] != ''){
                                                                            echo '<a href="'.$row['image_path'].'" data-lightbox="bill_image" data-title="'.$row['name'].'"><img src="'.$row['image_path'].'" alt="slika" width="300px"/></a>';
                                                                        }
                                                                    }
                                                                    else{
                                                                        header("Location: bills.php");
                                                                    }
                                                                }
                                                            ?>
							</section>
                                                    <style>
                                                        div.desc {
                                                            border: solid 1px rgba(144, 144, 144, 0.25);
                                                            border-radius: 20px;
                                                            padding: 10px 40px;
                                                            background-color: rgba(144, 144, 144, 0.075);
                                                        }
                                                    </style>
						</div>
					</div>
					<hr class="major" />
					<div class="row">
                                            
					</div>
				</div>
			</section>
                <script>
                    $(document).ready(function($) {
                        $(".clickableRow").click(function() {
                            window.document.location = $(this).attr("href");
                        });
                    });
                </script>
<?php
include_once './footer.php';
?>