<ul>
@foreach($childs as $child)
   <li>
        {{ $child->title }}<i class="ik ik-trash-2 f-16 text-red" onclick="deleteMenu({{$child->id}})"></i>
        @if(count($child->childs))
                                <i class="ik ik-arrow-down-circle"></i>
            @include('menu.manageChild',['childs' => $child->childs])
        @endif
   </li>
@endforeach
</ul>