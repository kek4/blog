<!--sidebar-menu-->
<div id="sidebar">
  <ul>
     <li><a href="{{ route('post.index') }}">Dashboard</a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>recette</span></a>
      <ul>
        <li><a href="{{ route('post.create') }}">Créer recette</a></li>
        <li><a href="{{ route('post.posts') }}">Liste</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->
