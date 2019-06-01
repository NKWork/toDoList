<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div >
    <input class="form-control" id='inputUpd' type="text" name='newName' value=''>
    </div>
    <div>
    <input class="form-control" id='description' type='text' name='description' value=''>
    </div>
    <div class="input-group" style='width:100%;'>
    <textarea class="form-control" id='comment' type="text" name='comment' value=''></textarea>
    </div>
    <select class="custom-select" id='status_id' name='status_id'>
            @foreach($statuses as $status)
                  <option value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
    </select> 
    <p id='p' style="display:none;"></p>
        <br>
 
      <div class='comments-area' id='comments'></div>
        <input class="btn btn-primary" onclick="updateDepartment()" type="submit" value="Submit">
  </div>
</div>