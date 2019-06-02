<div class="wrapper">
    <div class="form">
            <input placeholder='Input task name' id='name' type='text' name='name' required>
            <input placeholder='Input description' id='descriptionN' type='text' name='descriptionN' required>
            <select id='status' name='status'>
            @foreach($statuses as $status)
                  <option value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
            </select> 
            <button class="btn btn-primary" onclick='addTask()'>Submit</button>
    </div>
  </div>