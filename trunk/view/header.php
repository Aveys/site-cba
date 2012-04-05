<div id="header">
				<div id="header-bg">
				<div id="header-txt">
					<div id="logo"></div>
					<div id="title">
						<h1>
							<?php echo $Title ?>
						</h1>
					</div>
					<div id="menuBar">
						<img src="themes/cba/images/sep_menu_top.png" />
						<a class="itemMenuBar" id="blog" href=<?php echo $Site ?>>Blog</a>
						<a class="itemMenuBar" id="tutoriel" href=<?php echo $Site."tuto/" ?>>Tutoriel</a>
						<span class="itemMenuBar" id="equipe" onMouseOver='survole_equipe_apercu(this,event)' onMouseOut='quitte_equipe_apercu(this)'>Equipe
							<span id="equipeListe">
								<span class="teamName"><a href=<?php echo $Site."?page=equipe&id=1" ?>>Arthur Veys</a></span></br>
								<span class="teamName"><a href=<?php echo $Site."?page=equipe&id=2" ?>>Mathieu Martin</a></span></br>
								<span class="teamName"><a href=<?php echo $Site."?page=equipe&id=3" ?>>Nathanaël Couret</a></span></br>
								<span class="teamName"><a href=<?php echo $Site."?page=equipe&id=4" ?>>Natacha Laborde</a></span></br>
								<span class="teamName"><a href=<?php echo $Site."?page=equipe&id=5" ?>>Thomas Rovayaz</a></span></br>
							</span>
						</span>
						<a class="itemMenuBar" id="port" href=<?php echo $Site."port/" ?>>Portfolio</a>
						<a class="itemMenuBar" id="contact" href=<?php echo $Site."?page=contact" ?>>Contact</a>
						<img src="themes/cba/images/sep_menu_bottom.png" />
					</div>

				</div>
				</div>
			</div>