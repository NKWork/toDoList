<div id="myModal" class="modal">
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
      <div id='comments'></div>
        <input onclick="updateDepartment()" type="submit" value="Submit">
  </div>
</div>