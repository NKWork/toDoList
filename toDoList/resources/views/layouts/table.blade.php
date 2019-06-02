<div>
      <table class="table table-bordered " style='height:325px;' >
        <tbody>
          <tr style="vertical-align: top;">
          @if(!empty($statuses))
            @foreach($statuses as $status)
              <td >
                <table class="table table-bordered ">
                  <thead >
                    <th style="padding:20px;">{{$status->name}}</th>
                  </thead>
                  @if(!empty($data[$status->id]))
                    <tbody>
                        @foreach($data[$status->id] as $d)
                          <tr>
                            <td><a onclick="showModalFunk({{json_encode($d,TRUE)}})">{{$d['name']}} ({{$d['comment_count']}})</a> </td>
                          </tr>
                        @endforeach
                    </tbody>
                  @endif
                </table>
              </td>
            @endforeach
          @endif
          </tr>
        </tbody>
      </table>
      @if(!empty($links))
        {{$links->links()}}
      @endif
    </div>
   