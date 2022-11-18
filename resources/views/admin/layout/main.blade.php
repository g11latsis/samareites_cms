@include('admin.layout.header')

<body style="background-color: #ebebeb">
    
    @yield('main')

    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/popper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('js/admin/main2.js') }}"></script>
    <script src="{{ asset('js/admin/main3.js') }}"></script>
    <script>

      function seenByAdmin(){
          $("#seen-alert-badge").hide();

          $.ajax({
              type: 'GET',
              url: '/admin/toggle/alert',
              data: 'aa',
              dataType: 'json',
              success: function(data){
                  console.log(data);
              }
          });
      }

      function seenByRa(){
          $("#seen-alert-badge").hide();

          $.ajax({
              type: 'GET',
              url: '/ra/toggle/alert',
              data: 'aa',
              dataType: 'json',
              success: function(data){
                  console.log(data);
              }
          });
      }

    </script>
  </body>
</html>