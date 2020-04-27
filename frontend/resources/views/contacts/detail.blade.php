<div class="modal-header center-align">
   	<h4>Detail Contact</h4>
</div>

<div class="modal-content">
	<div class="row">
		<div class="col s5">
			<ul class="collection">
				<li class="collection-item">Name</li>
				<li class="collection-item">Number</li>
				<li class="collection-item">Address</li>
				<li class="collection-item">Birthplace</li>
				<li class="collection-item">Birthday</li>
				<li class="collection-item">Info</li>
			</ul>
		</div>
		<div class="col s2 center-align right-val">
			<i class="large material-icons">chevron_right</i>
		</div>
		<div class="col s5">
			<ul class="collection">
				<li class="collection-item l-item">{{ $res->name }}</li>
				<li class="collection-item l-item">{{ $res->number }}</li>
				<li class="collection-item l-item">{{ $res->address }}</li>
				<li class="collection-item l-item">{{ $res->birthplace }}</li>
				<li class="collection-item l-item">{{ Carbon\Carbon::parse($res->birthday)->format('Y/m/d') }}</li>
				<li class="collection-item l-item">{{ $res->info }}</li>
			</ul>
		</div>
	</div>
</div>

<style type="text/css">
	.l-item {
		height: 43px !important;
	}

	.right-val {
		height: 258px !important;
		max-height: 100% !important;
		margin-top: 8px;
	}

	.right-val>i{
		line-height: 258px !important;
	}
</style>