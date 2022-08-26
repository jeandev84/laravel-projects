<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>


<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>
                    <div class="card-body">
                        @if(Session::has('post_updated'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('post_updated') }}
                            </div>
                        @endif

                        <form action="{{ route('post.update', ['id' => $post->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Enter Post Title">
                            </div>

                            <div class="form-group">
                                <label for="body">Post Description</label>
                                <textarea name="body" class="form-control" id="body" rows="3">{{ $post->body }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Update Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
