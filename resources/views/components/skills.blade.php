@props(['skills'])


<ul class="flex">
  @foreach($skills as $skill)
  <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
    <a href="/?skill={{$skill->name}}">{{$skill->name}}</a>
  </li>
  @endforeach
</ul>