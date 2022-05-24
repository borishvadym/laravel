<li class="breadcrumb-item {{ $active ? 'active' : '' }}">
    @if(isset($active) && $active)
        {{ $label ?? 'LABEL' }}
    @else
        <a href="{{ $link ?? '' }}">{{ $label ?? 'LABEL' }}</a>
    @endif
</li>
