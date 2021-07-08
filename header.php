	<div id="navbar" class="navbar navbar-danger  ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="./" class="navbar-brand">
						<small>

							<img src="assets/images/siayalogo.png" height="52px" width="290px">
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="ligh-green dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="<?php echo $displayName." Photo";?>" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $displayName;?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<?php
						        if (in_array($user, $rs->RoleUsers("SysManager"))) {
						          $syslink = $rs->Modurl('ManageUsers');
						          $syslink = str_replace('view=edit', 'view=list', $syslink);
						         echo "<li><a href='$syslink'><i class='ace-icon fa fa-cog'></i>Settings</a></li>";
						        }
						         ?>
								<li>
									<a href="<?php echo $rs->Modurl('UserProfile');?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
