
@extends('master.admin')

 @section('title','Edit Categories')
 @section('content')

<!-- Main Content -->
<div class="container-fluid">
<?php
bread_crumb_edit(['admin/list/categories' ,' Categories'],'Edit Category');

if(session('failure'))
{
alert_failure(session('failure'));
}
if(session('success'))
{
alert_success(session('success'));
}

?>

<!-- Product Row One -->
<div class="row">

<div class="col-md-8">
<?php
panel_open('Add Category');
$colors =['blue','green','red','orange','yellow','purple','brown'];
?>
			<div class="form-wrap">
				<form action="{{ url('admin/edit/category') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="row">
						
						<div class="col-md-7">

							<div class="form-group">
							<label class="control-label mb-10">Color</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="color">
									@foreach($colors as $color)
									<option <?=selected($info->color,$color)?> value="{{ $color }}">{{ $color}}</option>
									@endforeach
								</select>
							</div>
							<?php
							hidden_field('id',$info->id);
							textbox('Fa icon','fa_icon',$info->fa_icon);

							textbox('Category Name','title',$info->title);

							//textarea('Category Description','description',NULL,150);

							?>
							
						</div>


						<div class="col-md-5">

							<?php
								upload_image('Category Image','featured_image',url(image_url_encode($info->featured_image)));
							?>

						</div>

					</div>													

					<hr>

					<?php

								form_button('update category');

						?>	

				</form>
			</div>
<?php
panel_close();
?>

			
		


</div>
					
</div>	
<!-- /Product Row Four -->

</div>

			
		
@endsection