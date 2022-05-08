<!-- Sidebar -->
<div id="sidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @foreach( $menus as $menu )
        <a href="/{{ $menu->slug }}" @if (Request::is($menu->slug.'/*') || Request::is($menu->slug))class="active"@endif>{{ $menu->label }}</a>
    @endforeach
</div>

