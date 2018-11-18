<ul class="navbar-nav mr-auto">
    @foreach ($categories as $category)
        <li class="nav-item">
            <a href="{{ url('category') . '/' . $category->id }}" class="nav-link">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
