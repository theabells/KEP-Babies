<?php 

				foreach ($results as $row) {

					echo "<div class='results'>";
						echo "<div class='result_information'>";
							$title = $row->title;
							$publisher = $row->publisher;
							$accession_number = $row->accession_number;
							echo "<ul>";
							echo "<li>Accession number: ".$row->accession_number."</li>";
							echo "<li>Title: ".$title."</li>";
							echo "<li>Publisher: ".$publisher."</li>";
							echo "<ul>Author(s):</ul>";
								foreach($results2 as $row2){
									if($row2->accession_number==$accession_number){
										$author= $row2->author;
										echo "<li>".$author."</li>";
									}
								}
							echo "</ul>";
						echo "</div>";
						?>
						<form method="post" accept-charset="utf-8" action="http://localhost/cmsc128/index.php/site/delete_bookmark">
							<input type="submit" value="Remove bookmark"/>
						</form>
						<?php
					echo "</div>";

				}
			 ?>
