
    <ul>
    {{ $user->name }} ({{ $user->id }})
    @foreach ($user->children as $child)
            <li><x-user-list :user="$child" /></li>
    @endforeach
    </ul>

