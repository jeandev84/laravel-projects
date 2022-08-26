<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>


<section style="padding-top: 60px;">
   <div class="container-fluid">
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       All Posts  <a href="{{ route('post.add') }}" class="btn btn-success">New Post</a>
                   </div>
                   <div class="card-body">

                       @if(Session::has('post_deleted'))
                           <div class="alert alert-success" role="alert">
                               {{ Session::get('post_deleted') }}
                           </div>
                       @endif

                       <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                           <tbody>
                               @foreach($posts as $post)
                                   <tr>
                                       <td>{{ $post->id }}</td>
                                       <td>{{ $post->title }}</td>
                                       <td class="col-md-6">{{ $post->body }}</td>
                                       <td>
                                           <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-info">
                                                Details
                                           </a>
                                           <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-success">
                                               Edit
                                           </a>
                                           <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-danger">
                                               Delete
                                           </a>
                                       </td>
                                   </tr>
                               @endforeach
                           </tbody>
                       </table>

                       <!-- Pagination -->
                       {{-- {{ $posts->links() }} --}}
                       <!-- End Pagination -->

                   </div>
               </div>
           </div>
       </div>
   </div>
</section>


</body>
</html>
