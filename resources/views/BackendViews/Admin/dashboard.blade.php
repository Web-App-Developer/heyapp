@extends('BackendViews.Admin.layouts.master')

@section('adminContent')      
@include('BackendViews.Admin.layouts.partials.sidebar')
      
<!-- yield content here -->
<h3 class="text-center"><b>Welcome</b>- Admin, have a good day!</h3>
	
	
	@php
	    $getTotal = (\App\OnlineRegistration::get());
	    $getTotalNew = (\App\OnlineRegistration::where('status', 'New')->count());
	    $getTotalInProgress = (\App\OnlineRegistration::where('status', 'In progress')->count());
	    $getTotalSolved = (\App\OnlineRegistration::where('status', 'Solved')->count());
	    $getTotalTrash = (\App\OnlineRegistration::where('status', 'Trash')->count());
	@endphp
	
    <div class="table-responsive" style="margin-top: 40px">
    	<table class="table" style="text-align: center !important;">
    		<thead style="background: #ddd; border-bottom: 3px solid #444;">
    			<tr>
    				<th>Total</th>
    				<th>Inbox</th>
    				<th>In Progress</th>
    				<th>Solved</th>
    				<th>Trashed</th>
    			</tr>
    		</thead>
    		<tbody>
    			<td>{{count($getTotal)}}</td>
    			<td>{{$getTotalNew}}</td>
    			<td>{{$getTotalInProgress}}</td>
    			<td>{{$getTotalSolved}}</td>
    			<td>{{$getTotalTrash}}</td>
    		</tbody>
    	</table>
    </div>

@endsection     