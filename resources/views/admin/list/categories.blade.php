

@extends('master.admin')

 @section('title','Categories')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Categories');
            	if(session('success'))
            	{
            		alert_success(session('success'));
            	}
            	?>
				
				<!-- Product Row One -->
				<div class="row">
       				
                  <?php
                    if(count($categories) <1)
                            {
                              alert_failure('No categories found ');
                            }

   

           panel_open('Categories');
                  ?>
            <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table display responsive product-overview mb-30" id="myTable">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>icon</th>
                            <th>category</th>
                            <th>picture</th>
                            <th>listings</th>
                            <th>Date Added</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($categories as $category)

                              
                              <tr>
                                <td class="txt-dark">{{ $category->id }}</td>
                                <td class="txt-dark"><i style="color:{{ $category->color }}" class="fa {{ $category->fa_icon }}"></i></td>
                                <td class="txt-dark" style="width:33%">{{ $category->title }}</td>
                                <td>
                                  <img src="{{ url(image_url_encode($category->featured_image)) }}" alt="{{ $category->title }}" width="80">
                                </td>
                                <td style="color:crimson"><strong>{{ $category->listing_count }}</strong></td>
                                <td>{{ date("D, d F Y",$category->create_time) }}</td>

                                <td><a href="{{ url('admin/form/edit/category/'.$category->id) }}" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"><i class="zmdi zmdi-edit txt-warning"></i></a>

                                  <!-- <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-danger"></i></a> -->

                                </td>
                              </tr>

                          @endforeach
                          
                          
        
                        </tbody>
                      </table>
                    </div>
                    </div>  
  <?php
                
  panel_close();
  ?>          
        
                  
				<!-- /Product Row Four -->
				
			</div>
			
		
			
@endsection