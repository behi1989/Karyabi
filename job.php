<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>

<!-- Job -->
	<section id="jobs">
		<div class="container text-center">
			<div class="right-slide col-md-3">
				<div class="pnlljob">
<?php
$DB = new DB();
$Adv = new Adv();
$rec = $Adv->ShowAdvInJobs();
foreach($rec as $rows)
{
?>
					<img src="./_upload/adv/ads/<?php echo $rows['_advPic']; ?>" class="img-responsive" style="width: 300px;height: 250px">
<?php
}
?>
				</div>
			</div>
			
			<div class="more-job col-md-9 col-xs-12">
				<div class="panel pnljob">
					<div class="panel-heading">
						<h4><i class="fa fa-sort-amount-desc"></i> آرشیو آگهی کاریابی </h4>
						
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
							<tr>
								<th style="text-align: right;width: 120px;padding: 10px"><i class="fa fa-calendar" style="color: #F24D16"></i> تاریخ</th>
								<th style="text-align: right"><i class="fa fa-navicon" style="color: #F24D16"></i> عنوان آگهی</th>
							</tr>
							</thead>
		<?php
			$advtaeed = 1;
			$DB = new DB();
			$viewAD = new ViewAD();
			/* Paging */
			$row_count = $viewAD->ViewADsPaging($advtaeed);
			$item_count = 20;
			$current_page = isset($_GET['page_id']) && is_numeric($_GET['page_id']) ? $_GET['page_id'] : 1;
			$link = '?page_id=:id:';
			$start = $item_count * ($current_page - 1);
			$end = $item_count;
			/* End Paging */
			$res = $viewAD->ViewADs($advtaeed,$start,$end);
			foreach($res as $rows)
			{	
		?>
							<tbody>
								<tr onClick="window.open('./morejob.php?id=<?php echo $rows['_id'] ?>');">
									<td><?php echo jdate('y/m/d',$rows['_addDate']) ?></td>
									<td><?php 
											if($rows['_advType']==1){echo $rows['_jobTitle']."&nbsp;<span style=color:#F24D16;font-size:10px> ویژه </span>";}else if($rows['_advType']==0){echo $rows['_jobTitle'];} ?></td>
								</tr>
		<?php
			}
		?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer" style="text-align: left">
						<div class="paging" style="margin-top: -15px">
							<div id="paginationJob">
								<?php echo paging2($row_count , $item_count , $current_page , $link) ?>
							</div>
						</div>
						<hr style="width: 100%;border-color: #f1f1f1;margin-top: -15px">
						<div style="margin-top: -10px;">
							<button type="button" class="btn btn-info"><i class="fa fa-print"></i> پرینت</button>
							<button type="button" class="btn btn-success"><i class="fa fa-share-alt"></i> اشتراک گذاری</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
 	
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>
    
  </body>
</html>