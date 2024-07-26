<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head.tinymce-config/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .50rem; background-color: #eff1f2;">
          <div class="card-body py-20 px-50 px-md-5">
       <h1 align="center">TinyMCE integration on Laravel</h1>
       <x-forms.tinymce-editor/>

       @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

            <div class="d-flex flex-row align-items-center">
       <label for="title" class="form-label mt-4"> Title </lable>
       <input type="title" class="form-control" id="title" placeholder="Enter a title" autocomplete="off">  
       
       <br />

       <label for="description" class="form-label mt-10"> Description </lable>
       <textarea id="description" class="form-control" id="description" placeholder="Enter a description" rows="4" cols="200" style="margin-bottom: 30px;"></textarea>  

       <button id="generate_page" onclick="generatePage()" class="btn btn-secondary"> Generate Page </button>
    </div>
       <table class="table table-striped" style="margin-top:20px;">
            <thead class="table-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)

                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}.html</td>
                    <!-- <td><a class="btn btn-info" href="{{ route('file.download', ['filename' => $item->title.'.html']) }}"> Download <a class="btn btn-success" href="http://localhost:8000/storage/{{$item->title}}.html">View</a></a></td> -->
                    <td><a class="btn btn-info" href="{{ route('file.download', ['filename' => $item->title.'.html']) }}">Download</a>
                    <a class="btn btn-success" href="http://localhost:8000/storage/{{$item->title}}.html">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>

    <script>
        function generatePage() {
            let content = tinymce.activeEditor.getContent("myeditorinstance");
            let page_title = document.getElementById('title').value;
            let page_description = document.getElementById('description').value;

            $.ajax({
                    url: '{{ route("page.save") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "title" : page_title,
                        "description" : page_description,
                        "content" : content,
                    },
                    success: function(response) {
                        alert('Page created successfully!');
                        console.log(response);
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
                location.reload();
        }

    </script>
</html>
