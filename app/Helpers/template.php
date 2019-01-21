<?php

function set_active_url($path,$class='active')
{
	
	if(\Request::path() == '/' && strlen(\Request::path()) == 1 && $path == '/')
	{
		
		 return ' class="'.$class.'" ';
	}
	elseif($path == '/' && strlen(\Request::path()) > 1 && str_contains(\Request::path(), $path))
	{
		return NULL;
	}
	else
	{
		return str_contains(\Request::path(), $path) ? ' class="'.$class.'" ': '';
	}
	
}

function image_url_encode($url)
{
	return implode('/', array_map('urlencode', explode('/', $url)));
}


function small_listing($listing)
{

foreach($listing as $details):

	$color = $details->color ;
	$icon =  $details->icon ;
	$location = strlen($details->city_name) > 0 ? $details->city_name . ' , ' . $details->state_name : $details->state_name  ;
	$title = htmlentities($details->title);
	$image = htmlentities(url(image_url_encode($details->featured_image)));
	$url = url('listing/'.$details->url);

	?>
	<div class="item col-md-4 col-sm-6 col-xs-12" ><!-- .ITEM -->
	<div class="listing-item clearfix">
		<div class="figure">
			<span style="background-image:url(<?=$image?>);" class="listing-image-small" alt="listing item"></span>

			<div class="listing-overlay">
				<a href="<?=$url?>" class="listing-overlay-inner rgba-bg<?=$color?>-1">
					<div class="overlay-content">
						<ul>
						</ul>
					</div>
				</a>
			</div>
		</div>

		<div class="listing-content clearfix" style="height:110px;padding-top: 25px">
			<div class="listing-meta-cat">
				<a class="bg<?=$color?>-1" href="#"><i class="fa <?=$icon?> white"></i></a>
			</div>
			<div class="listing-title">
				<h6><a href="<?=$url?>"><?=$title?></a></h6>
			</div>
			
			<div class="listing-location pull-left"><!-- location-->
				<a href="#"><i class="fa fa-map-marker"></i> <?=$location?></a>
			</div><!-- location end-->
			<!-- Rating Column
			<div class="star-rating pull-right">
				<div class="score-callback" data-score="5"></div>
			</div>
				--> 
		</div>
	</div>
	<div class="listing-border-bottom bg<?=$color?>-1"></div>
</div><!-- /.ITEM -->
	<?php
endforeach;
}


function large_listing($listing)
{
foreach($listing as $details):
	$color = $details->color ;
	$icon =  $details->icon ;
	$location = strlen($details->city_name) > 0 ? $details->city_name . ' , ' . $details->state_name : $details->state_name  ;
	$title = htmlentities($details->title);
	$image = htmlentities(url(image_url_encode($details->featured_image)));
	$url = url('listing/'.$details->url);

	?>
	<div class="item col-md-4 col-sm-6 col-xs-12" ><!-- .ITEM -->
	<div class="listing-item clearfix">
		<div class="figure">
			<span style="background-image:url(<?=$image?>);" class="listing-image-small" alt="listing item"></span>

			<div class="listing-overlay">
				<a href="<?=$url?>" class="listing-overlay-inner rgba-bg<?=$color?>-1">
					<div class="overlay-content">
						<ul>
						</ul>
					</div>
				</a>
			</div>
		</div>

		<div class="listing-content clearfix" style="height:110px;padding-top: 25px">
			<div class="listing-meta-cat">
				<a class="bg<?=$color?>-1" href="#"><i class="fa <?=$icon?> white"></i></a>
			</div>
			<div class="listing-title">
				<h6><a href="<?=$url?>"><?=$title?></a></h6>
			</div>
			
			<div class="listing-location pull-left"><!-- location-->
				<a href="#"><i class="fa fa-map-marker"></i> <?=$location?></a>
			</div><!-- location end-->
			<!-- Rating Column
			<div class="star-rating pull-right">
				<div class="score-callback" data-score="5"></div>
			</div>
				--> 
		</div>
	</div>
	<div class="listing-border-bottom bg<?=$color?>-1"></div>
</div><!-- /.ITEM -->
	<?php
endforeach;
}


function featured_listing($listing)
{
foreach($listing as $details):

	$color = $details->color ;
	$icon =  $details->icon ;
	$location = strlen($details->city_name) > 0 ? $details->city_name . ' , ' . $details->state_name : $details->state_name  ;
	$title = htmlentities($details->title);
	$image = htmlentities(url(image_url_encode($details->featured_image)));
	$url = url('listing/'.$details->url);

	?>

					<li class="item"><!-- .ITEM -->
							<div class="feature-item">
								<div class="figure">

									<span style="background-image:url(<?=$image?>);" class="listing-image-large" alt="listing item"></span> 

									<div class="feature-overlay">
										<a href="<?=$url?>"  class="feature-overlay-inner rgba-bg<?=$color?>-1">
											<div class="overlay-content">
												<ul class="feature-links">
													
												</ul>
											</div>
										</a>
									</div>
								</div>
								<div class="feature-content clearfix" style="height: 110px; padding-top: 25px;">
									<div class="feature-meta-cat">
										<a class="bg<?=$color?>-1" href="#"><i class="fa <?=$icon?> white"></i></a>
									</div>
									<div class="feature-title">
										<h6><a href="<?=$url?>"><?=$title?></a></h6>
									</div>
									<div class="feature-location pull-left"><!-- location-->
										<a href="#"><i class="fa fa-map-marker"></i> <?=$location?></a>
									</div><!-- location end-->
									<!-- <div class="star-rating pull-right">
										<div class="score-callback" data-score="5"></div>
									</div> -->
								</div>
							</div>
							<div class="listing-border-bottom bg<?=$color?>-1"></div>
						</li><!-- /.ITEM -->


	<?php
	endforeach;
}

function section_title($title,$margin_bottom = '0')
{
	return '<div class="section-title-wrap margin-bottom-'.$margin_bottom.'">
							<h4>'.$title.'</h4>
							<div class="title-divider">
								<div class="line"></div>
								<i class="fa fa-star-o"></i>
								<div class="line"></div>
							</div>
				</div>';
	
}

function panel_open($title)
{
	?>
	  <div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark"><?=$title?></h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
	<?php
}


function panel_close()
{
?>
	</div>
</div>
							
</div>

<?php
}

function textbox($label,$name,$value="")
{
	?>
	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	
	<input type="text" name="<?=$name?>" class="form-control" id="<?=$name?>" value="<?=htmlentities($value)?>" placeholder="<?=$label?>">
	</div>
	<?php
}

function hidden_field($name,$value="")
{
	?>
	<input type="hidden" name="<?=$name?>" class="form-control" id="<?=$name?>" value="<?=htmlentities($value)?>" >
	<?php
}

function password($label,$name)
{
	?>
	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	
	<input type="password" name="<?=$name?>" class="form-control" id="<?=$name?>"  placeholder="<?=$label?>">
	</div>
	<?php
}

function textbox2($icon,$label,$name,$value="")
{
	?>
	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	<div class="input-group">
	<div class="input-group-addon"><i class="<?=$icon?>"></i></div>
	<input type="text" name="<?=$name?>" class="form-control" id="<?=$name?>" value="<?=htmlentities($value)?>" placeholder="<?=$label?>">
	</div>
	
	</div>
	<?php
}

function email2($label,$name,$value="")
{
	?>
	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	<div class="input-group">
	<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
	<input type="text" name="<?=$name?>" class="form-control" id="<?=$name?>" value="<?=htmlentities($value)?>" placeholder="<?=$label?>">
	</div>
	
	</div>
	<?php
}

function password2($label,$name)
{
	?>

	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	<div class="input-group">
	<div class="input-group-addon"><i class="icon-lock"></i></div>
	
	<input type="password" name="<?=$name?>" class="form-control" id="<?=$name?>"  placeholder="<?=$label?>"></div>
	
	</div>
	<?php
}

function textarea($label,$name,$value="",$height=150)
{
	?>
	<div class="form-group">
	<label class="control-label mb-10" for="<?=$name?>"><?=$label?></label>
	<textarea class="form-control" style="height:<?=$height?>px" name="<?=$name?>" id="<?=$name?>" placeholder="<?=$label?>"><?=htmlentities($value)?></textarea>
	
	</div>
	<?php
}

function upload_image($label,$name,$default_file=NULL,$max_size = '5M')
{
	?>
	<div class="form-group">
															
		<label class="control-label mb-10" for="<?=$name?>"><strong><?=$label?></strong></label>

	<div class="mt-40">
		<input type="file" data-default-file="<?=$default_file?>" placeholder="<?=$label?>" name="<?=$name?>" data-max-file-size="<?=$max_size?>" id="<?=$name?>" class="dropify" accept=".jpg,.png"/>
	</div>
	</div>
	<?php
}

function upload_file($label,$name,$default_file=NULL,$accept=NULL,$max_size = '5M')
{
	?>
	<div class="form-group">
															
		<label class="control-label mb-10" for="<?=$name?>"><strong><?=$label?></strong></label>

	<div class="mt-40">
		<input type="file" data-default-file="<?=$default_file?>" placeholder="<?=$label?>" name="<?=$name?>" data-max-file-size="<?=$max_size?>" id="<?=$name?>" class="dropify" accept="<?=$accept?>"/>
	</div>
	</div>
	<?php
}

function dash_counter($icon,$count,$label,$affix=NULL)
{
	?>
					<div class="col-md-3">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-dark block counter"><?=$affix?><span class="counter-anim"><?=$count?></span></span>
													<span class="weight-500 uppercase-font block font-13"><?=$label?></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="<?=$icon?> data-right-rep-icon txt-light-grey"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
	<?php
}

function bread_crumb($title)
{
	?>
					<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h4 class="txt-dark"><?=$title?></h4>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="/dashboard">Dashboard</a></li>
						<li class="active"><span><?=$title?></span></li>
						
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
	<?php
}

function bread_crumb_edit($list_page=[],$title)
{
	?>
					<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h4 class="txt-dark"><?=$title?></h4>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="/dashboard">Dashboard</a></li>
						<li><a href="<?=url($list_page[0])?>"><?=$list_page[1]?></a></li>
						<li class="active"><span><?=$title?></span></li>
						
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
	<?php
}

function form_button($submit_label,$link='/dashboard',$second_text='Cancel')
{
	?>
					<button type="submit" class="btn btn-success mr-10"><?=$submit_label?></button>
					<a href="<?=url($link)?>"  class="btn btn-default"><?=$second_text?></a>
	<?php
}

function alert_success($message)
{
	$message = is_array($message) ? implode('<br>',$message) : $message ;
	?>
	<div class="row">
		<div class="col-md-12">
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?=$message?></p> 
			<div class="clearfix"></div>
		</div>
	</div>
	
</div>
	<?php
}

function alert_failure($message)
{
	$message = is_array($message) ? implode('<br>',$message) : $message ;
	?>
	<div class="row">
		<div class="col-md-12">
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="zmdi zmdi-block pr-15 pull-left"></i><p class="pull-left"><?=$message?></p>
			<div class="clearfix"></div>
		</div>
		</div>
	</div>

	<?php
}

function no_data($database,$form_link)
{
	?>

	<div class="col-md-8 col-md-offset-2">
	<div class="well well-lg card-view">
		<center>
		<h1 class="mb-15">No Record Found for {{ $database }}</h1>
		<h5>To add record in {{ $database }} click the button below</h5><br>
		<a class="btn btn-info" href="{{ url($form_link) }}">Add record to {{ $database }} </a>
		</center>
	</div>
	</div>
	<?php
}

function selected($data,$value)
{
	return $data == $value ? 'selected="selected"' : NULL;
}

function search_form($title,$url ,$search_string = NULL,$input_name = 'search_string')
{
		panel_open($title);

		?>

		<div class="form-wrap">
			<form action="<?=url($url)?>" method="post" enctype="multipart/form-data">
					@csrf

					<div class="row">
						
						<div class="col-md-10">
							
							<input type="text" name="<?=$input_name?>" class="form-control"value="<?=htmlentities($search_string)?>" placeholder="<?=$title?>">
							
						</div>


						<div class="col-md-2">

								<button type="submit" class="btn btn-success btn-block stretch mr-10">
									<i class="fa fa-search" aria-hidden="true"></i></button>
							

						</div>

					</div>		

				</form>
			</div>

		<?php
		panel_close();

}

function opening_hours_options($active = NULL)
{
	$open_hours = range(1,24);
	$open_min = ['00',15,30,45,59];
	$options = "<option  value=\"\">closed</option>";

	foreach($open_hours as $hours):
			$ampm = 'AM';
			$h = $hours;

			if($hours > 12)
			{
				$ampm = 'PM' ;
				$h = $hours - 12 ;
			}

		foreach ($open_min as $min):
			$time = "$h:$min $ampm";
			$selected = $active == $time ? ' selected="selected" ' : '';
			$options.=	
			"<option $selected value=\"$time\">$time</option>";

		endforeach;

	endforeach;

	return $options;
}


function pricing_options($active = NULL)
{
	$prices = [100,1000,10000,100000,1000000,10000000,100000000,1000000000];
	$selected = $active == NULL ? ' selected="selected" ' : '';
	$options = "<option $selected value=\"\"></option>";

	foreach($prices as $price):
		$formatted_price = number_format($price);
		$selected = $active == $price ? ' selected="selected" ' : '';
		$options.=	"<option $selected value=\"$price\">N $formatted_price</option>";

	endforeach;

	return $options;
}

function tab_next_prev_link($prev = NULL,$next = NULL)
{
	?>
	<hr>
	<center>
		<?php
		if($prev !== NULL)
		{
			?>
					<a data-toggle="tab" href="#<?=$prev?>"  class="btn btn-default">&laquo; Previous</a>
		
		<?php
		}
		if($next !== NULL)
		{
		?>
					<a  data-toggle="tab" href="#<?=$next?>"  class="btn btn-default">Next &raquo;</a>
		<?php
		}
		?>
	</center>
	<?php
}