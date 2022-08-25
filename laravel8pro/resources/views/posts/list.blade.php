<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Posts
                        </div>
                        <div class="card-body">
                            <table class="table">
                                 <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->body }}</td>
                                            <td>
                                                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-success">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--      <div class="container mt-3">--}}
{{--          <h1>Posts</h1>--}}
{{--          <div class="post-list">--}}
{{--              <div class="row">--}}
{{--                  @foreach($posts as $post)--}}
{{--                      <div class="col-4">--}}
{{--                          <div class="card mb-3">--}}
{{--                              <div class="card-header">--}}
{{--                                  <h3>{{ $post->title }}</h3>--}}
{{--                              </div>--}}
{{--                              <div class="card-body">--}}
{{--                                  <p>{{ $post->body }}</p>--}}
{{--                              </div>--}}
{{--                          </div>--}}
{{--                      </div>--}}
{{--                  @endforeach--}}
{{--              </div>--}}
{{--          </div>--}}
{{--      </div>--}}

</body>
</html>
