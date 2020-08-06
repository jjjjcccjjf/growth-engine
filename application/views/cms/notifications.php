<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<!--       <div class="page-header">
				<h4 class="page-title">Forms</h4>
			</div> -->
			<div class="row">
				<div class="col-md-8">
					<div class="card card-round">
						<div class="card-body">
							<div class="card-title fw-mediumbold">Notifications</div>
							<div class="card-list">
								<?php if(@$all_notifs): foreach ($all_notifs as $value): ?>
									<div class="item-list">
										<button class="btn btn-icon btn-primary btn-round btn-xs">
										<i class="<?php echo $value->icon ?>"></i>
										</button>
										<div class="info-user ml-3">
											<a href="<?php echo $value->link ?>">
												<label style="font-weight:bold; cursor:pointer;"><?php echo $value->header ?></label>
												<div class="status" style="color:whitesmoke"><?php echo $value->body ?></div>
											</a>
										</div>
										<p >
											<?php echo $value->created_at_f ?>
										</p>
									</div>
								<?php endforeach; else: ?>
									<div class="item-list" >
										<h3>All caught up! <i class="fa fa-bell"> &nbsp;</i>There are no new notifications.</h3>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>