<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
    <style>
    .wrapper {
      width: 100%;
      height: 50px;
      background-color: white;
    }

    .form {
      width: 100%;
      margin: 0 auto;

      height: 0px;

      background-color: aquamarine;

      transition: height 1s;
      overflow: hidden;
    }

    .form--open {
      height: 35px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <button id="button">Create task</button>
    <div class="form">
            <input id='name' type='text' name='name'>
            <input id='description' type='text' name='description'>
            <select id='status' name='status'>
                <option value="1">toDo</option>
                <option value="2">doing</option>
                <option value="3">done</option>
            </select> 
            <button onclick='addTask()'>Submit</button>
    </div>
  </div>
    <div>
    <table>
          
          <tbody>
            <tr style="vertical-align: top;">
            @if($data)
              @foreach ($data as $key=>$dat)
                  @if($key==1)
                  <td>
                  <table>
                        <thead>
                          <th>TODO</th>
                        </thead>
                        <tbody>
                    @foreach($dat as $d)
                      @if($d)
                          <tr><td>{{ $d }}</td></tr>
                      @endif
                    @endforeach
                    <tbody>
                      </table>
                      </td>
                  @endif
                  @if($key==2)
                  <td>
                  <table>
                        <thead>
                          <th>DOING</th>
                        </thead>
                        <tbody>
                    @foreach($dat as $d)
                      @if($d)
                          <tr><td>{{ $d }}</td></tr>
                      @endif
                    @endforeach
                    <tbody>
                        </table>
                        </td>
                  @endif
                  @if($key==3)
                  <td>
                  <table>
                        <thead>
                          <th>DONE</th>
                        </thead>
                        <tbody>
                    @foreach($dat as $d)
                      @if($d)
                          <tr><td>{{ $d }}</td></tr>
                      @endif
                    @endforeach
                    <tbody>
                      </table>
                      </td>
                  @endif
              @endforeach
            @endif
            </tr>
          </tbody>
        </table>
        {{$links->links()}}
  </div>
   
  <script>
    const button = document.querySelector('#button');
    const form = document.querySelector('.form');

    button.addEventListener('click', (e) => {
        e.stopPropagation();
        e.preventDefault();
      form.classList.toggle('form--open');
    });
  </script>  
</body>
</html>
<script>
    function addTask(){
           name=$('#name').val();
           description = $('#description').val();
           status=$( "#status option:selected" ).val();
           console.log(name,description,status);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/dashboard/add',
            data: {
                name: name,
                description: description,
                status: status,    
            },
            dataType: 'json',
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
