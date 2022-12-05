@extends('Layout.App')
@section('title','File Manager')
@section('content')
<!-- DashBoard Content -->
<div class="dashboard-content-area">
  <!-- Status Section -->
  <section class="dashboard-status-area">
    <div class="row"> 
        <iframe src="/filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
  </section>
</div>
@endsection 