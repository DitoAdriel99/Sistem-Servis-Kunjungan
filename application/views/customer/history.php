<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default articles">
			<div class="panel-heading">
				History
				<ul class="pull-right panel-settings panel-button-tab-right">
					<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
							<em class="fa fa-cogs"></em>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>
								<ul class="dropdown-settings">
									<li><a href="#">
											<em class="fa fa-cog"></em> Settings 1
										</a></li>
									<li class="divider"></li>
									<li><a href="#">
											<em class="fa fa-cog"></em> Settings 2
										</a></li>
									<li class="divider"></li>
									<li><a href="#">
											<em class="fa fa-cog"></em> Settings 3
										</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
			</div>
			<div class="panel-body articles-container">
				<div class="article border-bottom">
					<div class="col-xs-12">
						<?php foreach ($history as $row) : ?>
						<div class="row">
							<div class="col-xs-2 col-md-2 date">
								<div class="large"><?= $row->id_pesanan ?></div>
								<div class="text-muted"><?= $row->tanggal_pesanan ?></div>
							</div>
							<div class="col-xs-10 col-md-10">
								<h4><a href="<?= base_url() . "customer/history/bukti/".$row->id_pesanan ?>">Bukti Pembayaran</a></h4>
								<p>Keluhan: <?= $row->nama_keluhan ?>, Detail Keluhan: <?= $row->detail_keluhan ?></p>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="clear"></div>
				</div>
				<!--End .article-->
			</div>
		</div>
		<!--End .articles-->
	</div>
	<!--/.col-->
</div>

<script>

	ambilData();
	
	function ambilData(){
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "customer/history/getHistory"?>',
			dataType: 'json',
			success: function(data){
				console.log(data)
				var baris = '';
				for (var i=0; i<data.length; i++){
					baris +='<div class="col-xs-2 col-md-2 date">'+
					'<div class="large">'+(i+1)+'</div>'+
					'<div class="text-muted">'+Jun+'</div>'+
					'</div>'+
					'<div class="col-xs-10 col-md-10">'+
					'<h4>'+'<a href="#">'+ dd +'</a>'+'</h4>'+
								'<p>'+Lt +'</p>'+
					'</div>'
				}
				$('target').html(baris);
			}
		});
	}

</script>
