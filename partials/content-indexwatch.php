<?php



//$_datas = stockMarket::request(array('AAPL','GOOG','YHOO','NDAQ'),date('Y-m-d'));
$_datas = stockMarket::request(array('AAPL','GOOG','YHOO','^GSPC'));

?>
<section class="dark nopadding noborder" id="scroll-market">
	<div class="container black-bg border-bottom">
		<div class="row liner-bottom">
			<div class="col-sm-12 col-md-3 padding-10 nomargin">
				<small class="uppercase primary-color block nomargin">Index Watch</small>
				<span class="uppercase size-18 font-proxima nopadding nomargin">Stock Market</span>
				<form action="<?=site_url('/stockwatch/stocksearch/')?>" method="get" class="margin-bottom-0">
					<div class="input-group input-group-sm ">
						<input type="search" name="tvwidgetsymbol" placeholder="Search stocks quotes (e.g AAPL)" class="form-control input-sm text-uppercase" value="">
						<span class="input-group-btn">
							<button class="btn btn-white noradius" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			<div class="col-sm-12 col-md-9 nopadding nomargin primary-bg noborder trading-graph">

				<div class="row box-gradient box-black noborder nopadding primary-bg">
					<?php

					foreach($_datas as $_stock => $_info){
						?>
						<div class="col-xs-6 col-sm-3 padding-10">

							<div class="text-center pull-left">
								<a href="#"><?php echo $_stock;?></a><br>
								<span class="text-white"><?php echo $_info['bid'];?></span>
							</div>
							<div class="text-center width-60 pull-right text-gray">
								<?php echo $_info['change_percent'];?><br/>
								<?php echo $_info['change'];?>
								<?php
								$_perc = (float)$_info['change'];
								if($_perc > 0){
									echo '<span class="text-green"> <i class="fa fa-long-arrow-up"></i><span> ';
								}elseif($_perc < 0){
									echo '<span class="text-red"> <i class="fa fa-long-arrow-down"></i><span> ';
								}else{
									echo '<span class="text-white"> <i class="fa fa-exchange"></i><span> ';
								}?>

							</div>
							<div class="clearfix"></div>
							<div class=" sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
								1,3,1,-1,0,2,1,3,1,-1,0,2,1,0,2,1,3,1,-1,0,2,1
							</div>
						</div>
						<?php
					}
					?>
				</div>


			</div>

		</div>


	</div>
</section>
