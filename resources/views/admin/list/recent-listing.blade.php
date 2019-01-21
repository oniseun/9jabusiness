

@extends('master.admin')

 @section('title','Recent Listings')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Recent Listings');
            	if(session('success'))
            	{
            		alert_success(session('success'));
            	}
            	?>
				
				<!-- Product Row One -->
				<div class="row">
       				
                  <?php
                    if(count($listings) <1)
                            {
                              alert_failure('No listings found ');
                            }

   

panel_open('Recent Listings '.(isset($page_num) ? '(Page '.$page_num.')' : '' ));
                  ?>
            <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table display responsive product-overview mb-30" id="myTable">
                        <thead>
                          <tr>
                            <th>Date Added</th>
                            <th>Business name</th>
                            <th>picture</th>
                            <th>Category</th>
                            <th>Location</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($listings as $listing)

                              
                              <tr>
                                <td>{{ date("D, d M Y",$listing->create_time) }}</td>
                                <td class="txt-dark" style="width:33%">{{ $listing->title }}</td>
                                <td>
                                  <img src="{{ url(image_url_encode($listing->featured_image)) }}" alt="{{ $listing->title }}" width="80">
                                </td>
                                <td><strong>{{ $listing->category_name }}</strong></td>
                                <td>{{ $listing->state_name }}/{{ $listing->city_name }}</td>
                                

                                <td>

                                  <a class="btn btn-info " href="{{ url('admin/form/edit/listing/'.$listing->id) }}" title="Edit Listing" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>

                                  <a class="btn btn-success" href="{{ url('listing/'.$listing->url) }}" title="view" data-toggle="tooltip" target="_blank"><i class="fa fa-eye"></i></a>


                                  <form method="post" action="{{ url('admin/action/delete/listing') }}">
                                    @csrf
                                    <?php
                                    hidden_field('id',$listing->id);
                                    ?>
                                  <button class="btn btn-danger"  title="Delete Listing" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                  </form>

                                </td>
                              </tr>

                          @endforeach
                          
                          
        
                        </tbody>
                      </table>
                    </div>
                    </div>

                    <center>
                      @if(isset($page_num) && $page_num >= 3)
                          <a href="{{ url('admin/list/recent/listing') }}" class="btn btn-default"  title="First Page" data-toggle="tooltip">&laquo; First Page &raquo;</a> 
                      @endif
                      
                      @if(count($listings) >= 1)
                          <?php
                              $first_time = $listings[0]->create_time;

                              $last_time = $listing->create_time;

                              $page_num = isset($page_num) ? $page_num : 1;
                          ?>
                          

                          @if($page_num >=2)
                          <a href="{{ url('admin/list/recent/listing/prev/'.$first_time.'/'.($page_num - 1 )) }}" class="btn btn-default"  title="prev" data-toggle="tooltip">&laquo; prev</a> 
                          @endif

                          &nbsp; 

                          @if(count($listings) >= 15)
                          <a href="{{ url('admin/list/recent/listing/next/'.$last_time.'/'.($page_num + 1 )) }}" class="btn btn-default"  title="next" data-toggle="tooltip">next &raquo;</a>
                          @endif

                      @endif
                    </center>  
  <?php
                
  panel_close();
  ?>          
        
                  
				<!-- /Product Row Four -->
				
			</div>
			
		
			
@endsection