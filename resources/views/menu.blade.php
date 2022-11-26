<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('main') ? 'text-bg-secondary' : '' }}"
        href="{{ route('main') }}"><strong>Главная</strong></a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('news.categories') ? 'text-bg-secondary' : '' }}"
        href="{{ route('news.categories') }}"><strong>Новости</strong></a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('about') ? 'text-bg-secondary' : '' }}" href="{{ route('about') }}"><strong>О
            проекте</strong></a>
</li>
@if (Auth::user()->is_admin ?? 0)
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.index') ? 'text-bg-secondary' : '' }}"
            href="{{ route('admin.index') }}"><strong>Админка</strong></a>
    </li>
@endif
