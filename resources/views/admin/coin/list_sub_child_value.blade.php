<p>{{$name . ': ' . $value }}</p>
@if(!empty($sub_list))
    <ul>
        @foreach($sub_list as $key => $list)
            @include("admin.coin.list_sub_child_value", $list)
        @endforeach
    </ul>
@endif