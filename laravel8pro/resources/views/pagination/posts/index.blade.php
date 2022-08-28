<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Infinite Scroll Pagination</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>

  <section style="padding-top:60px;">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <h2 class="text-center">
                       Infinite Scroll Pagination
                   </h2>
               </div>
               <div class="col-md-12" id="post-data">
                    @include('pagination.ajax.posts.list')
               </div>
           </div>
       </div>
  </section>

  <!-- Loading -->
  <div class="ajax-load text-center" style="display: none;">
     <p><img src="{{ asset('assets/img/loader.gif') }}" alt="loader" style="width: 150px;"> Loading More Posts</p>
  </div>

  <script>
     function loadMoreData(page)
     {
          // console.log('OK');

          $.ajax({
             url: '?page='+ page,
             type: 'GET',
             beforeSend: function () {
                 $(".ajax-load").show();
             }
          })
          .done(function (data) {
               if(data.html === " ") {
                   $('.ajax-load').html('No more records found.');
                   return;
               }

               $('.ajax-load').hide();
               $("#post-data").append(data.html);
          })
          .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("Server not responding...")
          });
     }

     let page = 1;

     $(window).scroll(function () {

         if($(window).scrollTop() + $(window).height() >= $(document).height()) {
             page++;
             loadMoreData(page)
             /*
             setTimeout(function () {
                 loadMoreData(page)
             }, 500)
             */
         }
     })

  </script>
</body>
</html>
