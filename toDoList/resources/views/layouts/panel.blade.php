<div class="wrapper">
    <div class="form">
            <input id='name' type='text' name='name'>
            <input id='descriptionN' type='text' name='descriptionN'>
            <select id='status' name='status'>
            @foreach($statuses as $status)
                  <option value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
            </select> 
            <button class="btn btn-primary" onclick='addTask()'>Submit</button>
    </div>
  </div>