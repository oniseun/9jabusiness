<?php
use App\Auth;
?>

@extends('master.admin')

 @section('title','Admin List')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Admin List');
            	if(session('success'))
            	{
            		alert_success(session('success'));
            	}
            	?>
				
				<!-- Product Row One -->
				<div class="row">
       				
                  <?php
                    if(count($admins) <1)
                            {
                              alert_failure('No listings found ');
                            }

   

panel_open('Listings');
                  ?>
            <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table display responsive product-overview mb-30" id="myTable">
                        <thead>
                          <tr>
                            <th>Last Seen</th>
                            <th>Admin name</th>
                            <th>Listings</th>
                            <th>sex</th>
                            <th>picture</th>
                            <th>email</th>
                            <th>Phone Number</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($admins as $admin)

                              
                              <tr>
                                <td>{{ date("D, d M Y",strtotime($admin->date_created)) }}</td>
                                <td class="txt-dark" style="width:20%">{{ $admin->name }}</td>
                                <td class="txt-dark">{{ $admin->listing_count }}</td>
                                <td class="txt-dark">{{ $admin->sex }}</td>
                                <td>
                                  <img src="{{ url(image_url_encode($admin->photo)) }}" alt="{{ $admin->name }}" width="80">
                                </td>
                                <td><strong>{{ $admin->email }}</strong></td>
                                <td>{{ $admin->phone }}</td>
                                

                                <td style="width:20%">
                                  @if( Auth::level() < 3 && Auth::higher_admin($admin->id) && $admin->banned == 'no'&& Auth::id() != $admin->id)
        
                                   <form method="post" action="{{ url('admin/action/ban/admin') }}">
                                    @csrf
                                    <?php
                                    hidden_field('id',$admin->id);
                                    ?>
                                  <button class="btn btn-danger"  title="ban Admin" data-toggle="tooltip">Ban Admin</button>
                                  </form>
                                  @endif

                                  @if( Auth::level() < 3 && Auth::higher_admin($admin->id) && $admin->banned == 'yes' && Auth::id() != $admin->id )
                                  <form method="post" action="{{ url('admin/action/unban/admin') }}">
                                    @csrf
                                    <?php
                                    hidden_field('id',$admin->id);
                                    ?>
                                  <button class="btn btn-warning"  title="Unban Admin" data-toggle="tooltip">Unban Admin</button>
                                  </form>
                                  @endif


                                  <a class="btn btn-success" href="{{ url('author/'.$admin->url) }}" title="View Page" data-toggle="tooltip">view page</a>

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