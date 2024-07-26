<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head.tinymce-config/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="antialiased">
       <h1>OJT TinyMCE in Laravel BINI.BINIS</h1>
       <x-forms.tinymce-editor/>
    
       
       <label for="title"> Title </lable>
       <input id="title" type="text" style="margin-bottom: 30px; margin-top: 20px" />  
        <br />

       <label for="title"> Description </lable>
       <br />
       <textarea id="description" name="w3review" rows="4" cols="50" style="margin-bottom: 30px;">Bini.Binis mahiwagang salamin</textarea>

       <br />
       <button id="generate_page" onclick="generatePage()"> Generate Page </button>
    </body>

    <script>
    
        function generatePage() {
            let content = tinymce.activeEditor.getContent("myeditorinstance");
            let page_title = document.getElementById('title').value;
            let page_description = document.getElementById('description').value;

            $.ajax({
                    url: '{{ route("page.save") }}', // Laravel named route
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
                        // Handle success (e.g., update the UI or redirect)
                    },
                    error: function(xhr) {
                        // Handle error
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
        }

    </script>

</html>
