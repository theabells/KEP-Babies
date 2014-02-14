<?php 

				foreach ($search as $row) {

					echo "<div class='results'>";
						echo "<div class='result_information'>";
							$title = $row->title;
							$publisher = $row->publisher;
							$accession_number = $row->accession_number;
							echo "<ul>";
							echo "<li>".$title."</li>";
							echo "<li>".$publisher."</li>";
							echo "</ul>";
						echo "</div>";
						?>
						<form method="post" accept-charset="utf-8" action="http://localhost/cmsc128/index.php/site/update">
							<input type="hidden" value="<?php echo $row->accession_number; ?>" id="accession_number" name="accession_number">
							<input type="button" value="Reserve"/>
						    <input type="submit" value="Edit" />
						</form>
						<form method="post" accept-charset="utf-8" action="http://localhost/cmsc128/index.php/site/bookmark">
							<input type="hidden" value="<?php echo $row->accession_number; ?>" id="accession_number" name="accession_number">
							<input type="hidden" value="gjpgagno@gmail.com" id="email" name="email"><!-- Hard coded email; MUST change to session-->
							<input type="submit" value="Bookmark"/>
						</form>
						<?php
					echo "</div>";

				}
			 ?>
