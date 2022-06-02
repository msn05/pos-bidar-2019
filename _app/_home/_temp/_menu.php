<div class="left-side-menu">
	<div class="h-100" data-simplebar>
		<div id="sidebar-menu">
			<ul id="side-menu">
				<li class="menu-title">Navigation</li>
				<li>
					<a href="web.php">
						<i class="mdi mdi-home"></i>
						<span> Dashboards </span>
					</a>
				</li>

				<li class="menu-title mt-2">Apps</li>
				<?php if($LevelNya == 1){?>
					<li>
						<a href="?Halaman=_users">
							<i class="mdi mdi-account-box-multiple-outline"></i>
							<span> Users </span>
						</a>
					</li>
				<?php }
				if ($LevelNya == 1 || $LevelNya ==3 ) {?>
					<li>
						<a href="#sidebarMultilevel" data-toggle="collapse">
							<i class="mdi mdi-cloud-tags box-multiple-outline"></i>
							<span> Jasa </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarMultilevel">
							<ul class="nav-second-level">
								<li>
									<a href="?Halaman=_ketentuan_jasa">
										<i class="box-multiple-outline"></i>
										<span> Ketentuan Perhitungan </span>
									</a>
								</li>
								<li>
									<a href="?Halaman=_jasa">
										<i class="box-multiple-outline"></i>
										<span> Daftar Jasa </span>
									</a>
								</li>
								<li>
									<a href="?Halaman=_keterangan_tarif">
										<i class="box-multiple-outline"></i>
										<span> Daftar Ketentuan Tarif </span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<?php
				} if($LevelNya == 2 || $LevelNya == 1){?>
					<li>
						<a href="?Halaman=_Bea_jasa">
							<i class="mdi mdi-cart-arrow-right box-multiple-outline"></i>
							<span> Bea Jasa </span>
						</a>

					</li>

					<li>
						<a href="#sidebarMultilevel1" data-toggle="collapse">
							<i class="mdi mdi-book-account box-multiple-outline"></i>
							<span> Pelanggan </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarMultilevel1">
							<ul class="nav-second-level">
								<li>
									<a href="?Halaman=_pengirim">
										<i class="box-multiple-outline"></i>
										<span> Pengirim </span>
									</a>
								</li>
								<li>
									<a href="?Halaman=_penerima">
										<i class="box-multiple-outline"></i>
										<span> Penerima </span>
									</a>
								</li>

							</ul>
						</div>
					</li>
				<?php } if($LevelNya == 1 || $LevelNya ==2){?>
					<li>
						<a href="?Halaman=_pembayaran">
							<i class="mdi mdi-bank-plus box-multiple-outline"></i>
							<span> Pembayaran </span>
						</a>

					</li>
				<?php }?>
				<?php if ($LevelNya ==1) {?>
					<li>
						<a href="?Halaman=_pengiriman">
							<i class="mdi mdi-send-lock-outline box-multiple-outline"></i>
							<span> Pengiriman </span>
						</a>

					</li>
					<?php
				} if($LevelNya == 4){?>
					<li>
						<a href="?Halaman=_laporan">
							<i class="mdi mdi-file box-multiple-outline"></i>
							<span> Laporan </span>
						</a>
					</li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
