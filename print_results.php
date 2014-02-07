<?php 

				foreach ($search as $row) {

					echo "<div class='results'>";
						echo "<div class='result_information'>";
							$title = $row->title;
							$publisher = $row->publisher;
							$accession_number = $row->accession_number;
							//$author = $row->author;
							echo "<ul>";
							echo "<li>".$title."</li>";
							echo "<li>".$publisher."</li>";
							//echo "<li>".$author."</li>";
							echo "</ul>";
						echo "</div>";
						?>
						<form method="post" accept-charset="utf-8">
							<input type="hidden" value="<?php echo $row->accession_number; ?>" id="accession_number" name="accession_number">
							<input type="button" value="Reserve"/>
							<input type="button" value="Bookmark"/>
						    <input type="submit" value="Edit" href="#myModal"/>
						</form>
						<?php
					echo "</div>";

				}
			 ?>