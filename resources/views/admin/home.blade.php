@extends('admin.layouts.app')
{{-- web title --}}
@section('title', "Admin Page")
{{-- dashboard title --}}
@section('option-title','Dashboards')

@section('content')
@include('admin.includes.success')
<div class="alerts">
  <!-- each alert -->
  <div class="alert">
    <div class="total-pc">
      <span class="amount">{{count($customers)}}</span>
      <span class="amount-label">Customers</span>
    </div>
    <div class="statistic">
      <div class="first-row">
        <i class="fa-solid fa-caret-up"></i>
        <span class="percent">+30%</span>
      </div>
      <div class="last-row">last month</div>
    </div>
  </div>
  <!-- end alert -->
  <!-- each alert -->
  <div class="alert">
    <div class="total-pc">
      <span class="amount">{{count($books)}}</span>
      <span class="amount-label">Books</span>
    </div>
    <div class="statistic">
      <div class="first-row">
        <i class="fa-solid fa-caret-up"></i>
        <span class="percent">+30%</span>
      </div>
      <div class="last-row">last month</div>
    </div>
  </div>
  <!-- end alert -->
  <!-- each alert -->
  <div class="alert">
    <div class="total-pc">
      <span class="amount">{{count($orders)}}</span>
      <span class="amount-label">Orders</span>
    </div>
    <div class="statistic">
      <div class="first-row">
        <i class="fa-solid fa-caret-up"></i>
        <span class="percent">+30%</span>
      </div>
      <div class="last-row">last month</div>
    </div>
  </div>
  <!-- end alert -->
</div>
<!-- end alerts -->

<!-- forms -->
{{-- <div class="forms">
  <div class="form">
    <form action="#">
      @csrf
      <div class="form-header">
        <h2>create post</h2>
      </div>
      <div class="form-body">
        <div class="input-group">
          <label for="title">title</label>
          <input type="text" name="title" id="title" placeholder="Enter title..." required />
        </div>
        <div class="input-group">
          <label for="body">body</label>
          <textarea name="body" id="body" required placeholder="Enter body..." rows="2" spellcheck="true"></textarea>
        </div>
        <div class="input-group">
          <label for="author_id">Authors</label>
          <select required name="author_id" id="author_id">
            <option value="" selected disabled hidden>
              Choose author...
            </option>
            <option value="1">Lim Vichet</option>
            <option value="2">Seu Samith</option>
            <option value="3">Mao Samphors</option>
            <option value="4">Phok Rathanak</option>
          </select>
        </div>
      </div>
      <div class="form-footer">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</div> --}}
@endsection