<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head.tinymce-config/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
       <h1 align="center">TinyMCE integration on Laravel</h1>
       <x-forms.tinymce-editor/>
       
       <label for="title"> Title </lable>
       <input id="title" type="text" style="margin-bottom: 30px; margin-top: 20px" />  
        <br />

       <label for="title"> Description </lable>
       <br />
       <textarea id="description" name="description" rows="4" cols="50" style="margin-bottom: 30px;"></textarea>

       <br />
       <button id="generate_page" onclick="generatePage()"> Generate Page </button>


       <table class="table table-striped" style="margin-top:50px;">
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
                    <td><a href="{{ route('file.download', ['filename' => $item->title.'.html']) }}">Download  |  <a href="http://localhost:8000/storage/{{$item->title}}.html">View</a></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
