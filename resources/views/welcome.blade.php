<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head.tinymce-config/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
       <h1>TinyMCE integration on Laravel BINI.BINIS</h1>
       <x-forms.tinymce-editor/>
       
       <label for="title"> Title </lable>
       <input id="title" type="text" style="margin-bottom: 30px; margin-top: 20px" />  
        <br />

       <label for="title"> Description </lable>
       <br />
       <textarea id="description" name="w3review" rows="4" cols="50" style="margin-bottom: 30px;"></textarea>

       <br />
       <button id="generate_page" onclick="generatePage()"> Generate Page </button>


       <table class="table" style="margin-top:50px;">
            <thead>
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
                    <td> <a href="{{ route('file.download', ['filename' => $item->title.'.html']) }}">Download</a></td>
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
        }

    </script>
</html>
