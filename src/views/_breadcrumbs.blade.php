<nav>
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">home</a>
        </li>

        @foreach(request()->breadcrumbs()->links() as $link)
        <li class="breadcrumb-item">
            <a href="{{$link->url()}}">{{ $link->linkText() }}</a>
        </li>
        @endforeach
    </ul>
</nav>
