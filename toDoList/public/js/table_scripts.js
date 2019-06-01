
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
      //comments.innerHTML='asdasdasdasdasdsads';description
      document.getElementById('inputUpd').value=info['name'];
      document.getElementById('description').value=info['description']; 
      document.getElementById('status_id').value=info['status_id'];  
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