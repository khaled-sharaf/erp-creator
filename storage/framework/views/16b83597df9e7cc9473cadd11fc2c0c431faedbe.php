<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/favicon.ico" type="image/x-icon">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  

  <!-- Font Awesome Icons -->
  <?php echo Html::style('adminlte/plugins/fontawesome-free/css/all.min.css'); ?>
  <!-- Theme style -->
  <?php echo Html::style('adminlte/dist/css/adminlte.css', ['id' => 'style-adminlte']); ?>
  <!-- Google Font: Source Sans Pro -->
  

  <?php echo Html::style('admin/css/app.css'); ?>


  
  <?php echo Html::style('admin/css/main.css', ['id' => 'style-my-main']); ?>

  <style>
      .dataTables_wrapper .sorting {
      background-image: url("<?php echo e(url('/')); ?>/admin/images/sort_both.png");
    }
    .dataTables_wrapper .sorting_asc {
      background-image: url("<?php echo e(url('/')); ?>/admin/images/sort_asc.png");
    }
    .dataTables_wrapper .sorting_desc {
      background-image: url("<?php echo e(url('/')); ?>/admin/images/sort_desc.png");
    }

  </style>

  <?php echo $__env->yieldContent('css'); ?>

</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

  <div class="wrapper">

    <!-- Main content -->
      <div id="app" class="wrapper-app-vue"></div>
      <!-- /.content -->

    <!-- Main Footer -->


    
  </div>
  <!-- ./wrapper -->

  <script>
      // set auth user in object global in all file js
      window.csrf_token = '<?php echo e(csrf_token()); ?>';
      window.url = '<?php echo e(url("/")); ?>/';
      window.port = '<?php echo e($_SERVER["SERVER_PORT"] == "80" ? "php" : "serve"); ?>';
      window.cp_prefix = '<?php echo e(env("CP_PREFIX")); ?>';
      window.cp_prefix_api = '<?php echo e(env("CP_PREFIX_API")); ?>';
      window.js_locale_path = '<?php echo e(env("JS_LOCALE_PATH")); ?>';
      window.admin_prefix = '<?php echo e(url("/") . "/" . env("CP_PREFIX")); ?>';

      window.$auth = <?php echo json_encode(auth()->user(), 15, 512) ?>;
      window.$settings = <?php echo json_encode(getSettings(), 15, 512) ?>;
      window.$user_permissions = <?php echo json_encode(auth()->user()->getAllPermissions()->pluck('name')->toArray(), 15, 512) ?>;
      window.$permissions_active = <?php echo json_encode(config('acl.permissionsActive'), 15, 512) ?>;


        function initMap() {
            var show_my_map = document.getElementById('show_my_map'),
                elMap = document.getElementById('show_location_map'),
                latitude = window.parseFloat(show_my_map.getAttribute('data-lat')),
                longitude = window.parseFloat(show_my_map.getAttribute('data-long'));

            var uluru = {lat: latitude, lng: longitude};
            var map = new google.maps.Map(elMap, {
                zoom: 17,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }

        function initMapInForm() {
            var wrapperMap = document.querySelector('.myMap'),
                mapCanvas = document.querySelector(".myMap #map"),
                inputAddress = document.querySelector('.myMap #address'),
                eleErrorLocation = document.querySelector('.myMap .error_location'),
                btnRemoveLocation = document.getElementById('remove_location_in_form'),
                btnGetCurrentLocation = document.getElementById('get_current_location_in_form'),
                lat = window.parseFloat(wrapperMap.getAttribute('data-lat')),
                long = window.parseFloat(wrapperMap.getAttribute('data-long')),
                myCenter = new google.maps.LatLng(lat, long),
                mapOptions = {center: myCenter, zoom: 17},
                map = new google.maps.Map(mapCanvas,mapOptions),
                marker = new google.maps.Marker({
                    position: myCenter,
                    draggable: true,
                });
            var geocoder = new google.maps.Geocoder();
            var eleLat = document.getElementById('latitude_in_form'),
                eleLong = document.getElementById('longitude_in_form');
            inputAddress.addEventListener('keyup', function(e) {
                geocodeAddress(geocoder, map);
            })

            function geocodeAddress(geocoder, resultsMap) {
                var address = inputAddress.value;
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        resultsMap.setCenter(results[0].geometry.location);
                        resultsMap.setZoom(17);
                        eleLat.value = results[0].geometry.location.lat();
                        eleLong.value = results[0].geometry.location.lng();

                        marker.setMap(resultsMap);
                        marker.setPosition(results[0].geometry.location);

                        eleErrorLocation.style.display = 'none';
                    } else {
                        eleErrorLocation.style.display = 'block';
                    }
                });
            }

            marker.setMap(map);
            marker.addListener('dragend', function (event) {
                // eleLat.setAttribute('data-lat', event.latLng.lat());
                // eleLong.setAttribute('data-long', event.latLng.lng());
                eleLat.value = event.latLng.lat();
                eleLong.value = event.latLng.lng();
            })

            btnRemoveLocation.addEventListener('click', function() {
                eleLat.value = '';
                eleLong.value = '';
                const myCenter = new google.maps.LatLng(30.0444196, 31.23571160000006);
                map.setCenter(myCenter);
                map.setZoom(12);
                marker.setMap(map);
                marker.setPosition(myCenter);
                inputAddress.value = 'مصر، القاهرة';
            })

            btnGetCurrentLocation.addEventListener('click', function() {
                navigator.geolocation.getCurrentPosition(function(location) {
                    let latitude = location.coords.latitude
                    let longitude = location.coords.longitude

                    eleLat.value = latitude
                    eleLong.value = longitude

                    const myCenter = new google.maps.LatLng(latitude, longitude)
                    map.setCenter(myCenter)
                    map.setZoom(17)
                    marker.setMap(map)
                    marker.setPosition(myCenter)
                    inputAddress.value = ''
                })
            })
        }
  </script>

  <!-- REQUIRED SCRIPTS -->
  <?php echo Html::script('admin/js/app.js'); ?>
  <!-- AdminLTE App -->
  <?php echo Html::script('adminlte/dist/js/adminlte.js'); ?>

  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
          placeholder: 'Select a lead',
          allowClear: true
        });
    });
  </script>
  

</body>
</html>
<?php /**PATH D:\projects\Erp-new\erp-creator\resources\views/admin/cp_layout.blade.php ENDPATH**/ ?>