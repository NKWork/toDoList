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
                            <td>{{$d['name']}} ({{$d['comment_count']}}) <button id='myBtn' onclick="showModalFunk({{json_encode($d,TRUE)}})">update</button> </td>
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
   