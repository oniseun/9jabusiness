

@extends('master.admin')

 @section('title','Search Listings')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Search Listings');
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

   

panel_open('You searched for "'.htmlentities($search_string).'" ');
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

                                  <a class="btn btn-info" href="{{ url('admin/form/edit/listing/'.$listing->id) }}" title="Edit Listing" data-toggle="tooltip">edit listing</a>



                                  <a class="btn btn-succces" href="{{ url('listing/'.$listing->url) }}" title="Edit Listing" data-toggle="tooltip">view page</a>


                                  <form method="post" action="{{ url('admin/action/delete/listing') }}">
                                    @csrf
                                    <?php
                                    hidden_field('id',$listing->id);
                                    ?>
                                  <button class="btn btn-danger"  title="Delete Listing" data-toggle="tooltip">Move to trash</button>
                                  </form>

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