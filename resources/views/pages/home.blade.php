@extends('layouts.default')

@section('content')
<style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>


<div class="row" style="margin-top: 20px;">
<div class="input-field col s6">
    <select>
      <option value="" disabled selected>Kecamatan</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
    </select>
    <label>Kecamatan</label>
  </div>

 <div class="input-field col s6">
    <select>
      <option value="" disabled selected>Arho</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
    </select>
    <label>Arho</label>
  </div>
</div>
<div class="row">

<div class="col s6">
 <table class="bordered striped responsive-table">
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th>Item Price</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
          </tr>
        </tbody>
      </table>
</div>

<div class="col s6">
<div id="map"></div>
</div>


</div>
 

@stop

@push('scripts')

<script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtYiajc1RrGCJtWnaBSwVlJGhND6delcQ&callback=initMap">
    </script>

@endpush