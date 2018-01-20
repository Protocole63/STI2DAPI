<li class="{{ Request::is('data*') ? 'active' : '' }}">
    <a href="{!! route('data.index') !!}"><i class="fa fa-edit"></i><span>Data</span></a>
</li>

<li class="{{ Request::is('heats*') ? 'active' : '' }}">
    <a href="{!! route('heats.index') !!}"><i class="fa fa-edit"></i><span>Heats</span></a>
</li>

<li class="{{ Request::is('foods*') ? 'active' : '' }}">
    <a href="{!! route('foods.index') !!}"><i class="fa fa-edit"></i><span>Foods</span></a>
</li>

<li class="{{ Request::is('acids*') ? 'active' : '' }}">
    <a href="{!! route('acids.index') !!}"><i class="fa fa-edit"></i><span>Acids</span></a>
</li>

