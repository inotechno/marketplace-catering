<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        @foreach ($menuUsers as $menu)
            <li class="menu-title" key="t-{{ Str::slug($menu['title']) }}">{{ $menu['title'] }}</li>

            @foreach ($menu['menus'] as $subMenu)
                @if (isset($subMenu['subMenus']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="{{ $subMenu['icon'] }}"></i>
                            <span key="t-{{ Str::slug($subMenu['name']) }}">{{ $subMenu['name'] }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach ($subMenu['subMenus'] as $subSubMenu)
                                <li>
                                    <a href="{{ url($subSubMenu['url']) }}"
                                        key="t-{{ Str::slug($subSubMenu['name']) }}">
                                        {{ $subSubMenu['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ url($subMenu['url']) }}" class="waves-effect">
                            <i class="{{ $subMenu['icon'] }}"></i>
                            <span key="t-{{ Str::slug($subMenu['name']) }}">{{ $subMenu['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        @endforeach
    </ul>
</div>
