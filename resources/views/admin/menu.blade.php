<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.index') ? 'text-bg-secondary' : '' }}"
        href="{{ route('admin.index') }}"><strong>Админка
            главная</strong></a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.news.categories') ? 'text-bg-secondary' : '' }}"
        href="{{ route('admin.news.categories') }}"><strong>Новости</strong></a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'text-bg-secondary' : '' }}"
        href="{{ route('admin.users.index') }}"><strong>Пользователи</strong></a>
</li>

<div class="btn-group dropend">
    <button class="btn dropdown-toggle nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>Разное</strong>
    </button>

    <ul class="dropdown-menu">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.download.json') ? 'text-bg-secondary' : '' }}"
                href="{{ route('admin.download.json') }}"><strong>Скачать новости</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.download.image') ? 'text-bg-secondary' : '' }}"
                href="{{ route('admin.download.image') }}"><strong>Скачать картинку</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.ajax') ? 'text-bg-secondary' : '' }}"
                href="{{ route('admin.ajax') }}"><strong>Ajax</strong></a>
        </li>
    </ul>
</div>
