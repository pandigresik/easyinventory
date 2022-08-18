{!! Menu::new()->add(\Spatie\Menu\Link::to('#', '<i class="nav-icon cil-speedometer"></i>
        &nbsp;Dashboard
        <span class="badge badge-info">NEW</span>')->addClass('nav-link'))->withoutWrapperTag() !!}
{!! $menu !!}