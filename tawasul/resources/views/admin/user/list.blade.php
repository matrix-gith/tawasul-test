
@extends('admin.innertemplate')
@section('title','User List')
@section('content')

    <section class="content-header">

       <h1>
        User list
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        @include('admin.includes.messages')
        <div class="btn btn-default pull-right button-custom">
        <a  href="{{ URL::Route('user_sync') }}"><i class="fa fa-refresh"> Sync</i></a>
        </div>
      </div>

        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body new-padding new-marg">
            	<div class="data-table table-responsive">
              <table id="dataTable" class="table">
                <thead>
                <tr>
                  <th>Display name</th>
                  <th>Title</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th class="no-sort"></th>
                 
                </tr>
                </thead>
                <tbody>
                @if($user_list->count()>0)	 
                @foreach($user_list as $user)
                <tr>
                  <td>{{ $user->display_name}}</td>
                  <td>{{ $user->title}}</td>
                  <td> {{ $user->email}} </td>
                  <td align="center"><a href="javascript:void(0)" class="status link" data-model = "User" data-id="{{ $user->id }}" title="Click to change Status">
                  @if($user->status == 'Active') <span class="ion-checkmark"></span>
                  @else
                  <span class="ion-android-close"></span>
                  @endif
                  </a> </td> 
                  <td align="center"><a class="link edits" href="{{ URL::Route('user_details',$user->id ) }}" class="user_view" title="Click to view details"><span class="ion-eye"></span> </a> 
                  <a class="link edits" href="{{ URL::Route('user_addedit_role',$user->id ) }}" class="user_view" title="Click to assign role"><span class="fa fa-group"></span> </a> 
                  </td>   
                  
                </tr>
                @endforeach
                @endif
                
                

                

                </tbody>
                
              </table>
              	</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


  @endsection
