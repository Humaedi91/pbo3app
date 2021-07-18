<li class="nav-item">
    <a class="nav-link" href="{{ asset('') }}{{ $child_category->linkmenu }}">
        <i class="far fa-circle nav-icon"></i>
        <p>{{ $child_category->namamenu }}</p>
    </a>
</li>
@if ($child_category->categories)
    <ul class="nav nav-treeview">
        @foreach ($child_category->categories as $childCategory)
            @include('layout.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
</li>