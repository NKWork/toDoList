<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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

<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <input id='inputUpd' type="text" name='newName' value=''>
  <input id='description' type='text' name='description' value=''>
  <input id='comment' type="text" name='comment' value=''>
  <select id='status_id' name='status_id'>
                <option value="1">toDo</option>
                <option value="2">doing</option>
                <option value="3">done</option>
            </select> 
  <p id='p' style="display:none;"></p>
      <br>
    <div id='comments'>
    </div>
      <input onclick="updateDepartment()" type="submit" value="Submit">
</div>
</div>

  <div class="wrapper">
    <button id="button">Create task</button>
    <div class="form">
            <input id='name' type='text' name='name'>
            <input id='descriptionN' type='text' name='descriptionN'>
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
            @foreach($statuses as $status)
              <td >
                <table>
                  <thead >
                    <th>{{$status->name}}</th>
                  </thead>
                  @if(!empty($data[$status->id]))
                    <tbody>
                        @foreach($data[$status->id] as $d)
                          <tr>
                            <td>{{$d['name']}} <button id='myBtn' onclick="showModalFunk({{json_encode($d,TRUE)}})">update</button> </td>
                          </tr>
                        @endforeach
                    </tbody>
                  @endif
                </table>
              </td>
            @endforeach
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
           description = $('#descriptionN').val();
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

    function showModalFunk(info){

      var c='';
       var modal = document.getElementById('myModal');
       var span = document.getElementsByClassName("close")[0];
       var comments=document.getElementById('comments');
       var p = document.getElementById('p');
        modal.style.display = "block";
         window.onclick = function(event) {
             if (event.target == modal) {
                 modal.style.display = "none";
             }
         }
         span.onclick = function() {
         modal.style.display = "none";
         }
         $.ajax({
            url:"/dashboard/getcomments/"+info['id'],
            success: function(responce){ 
              com=JSON.parse(responce);
              console.log(com)
              for(i=0;i<com.length;i++){
               c+="<p>"+com[i].text_comment+"</p>";
                
              }
              $('#comments').html(c);
            }
        })
         p.innerHTML=info['id'];
         comments.innerHTML='asdasdasdasdasdsads';
         document.getElementById('inputUpd').value=info['name'];   
    }


    function updateDepartment(){
        id=$('#p').text();
        
        newName = $('#inputUpd').val();
        comment = $('#comment').val();
        description=$('#description').val();
        status_id=$('#status_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        type: 'PUT',
            url: '/dashboard/update/'+id,
            data: {
               newName:newName,
               comment:comment,
               description:description,
               status_id:status_id,
            },
            dataType: 'json',
            success: function(data) {
                $(".close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>

<style>
    body {font-family: Arial, Helvetica, sans-serif;}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>