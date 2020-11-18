<html>
    <head>
        <title>Test</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Hello</h1>


        <script>
             $.ajax({
                 url:"{{url('api/currencies')}}",
                 type:"get",
                
                 success:function(response){
                    console.log(response);
                 },
                 error:function(error){
                    console.log(error);
                 }

             })
        </script>
    </body>
</html>