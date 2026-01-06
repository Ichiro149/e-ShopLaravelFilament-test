@props([
    'items' => [] // Array of ['label' => 'Name', 'url' => '/path'] or just ['label' => 'Name'] for last item
])

<nav class="breadcrumbs-component" aria-label="Breadcrumb">
    <ol class="breadcrumbs-list">
        <li class="breadcrumbs-item">
            <a href="{{ route('home') }}" class="breadcrumbs-link">
                <svg viewBox="0 -960 960 960" fill="currentColor" width="18" height="18">
                    <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/>
                </svg>
                <span>{{ __('breadcrumbs.home') }}</span>
            </a>
        </li>

        @foreach($items as $item)
            <li class="breadcrumbs-item">
                <span class="breadcrumbs-separator">/</span>
                @if(isset($item['url']))
                    <a href="{{ $item['url'] }}" class="breadcrumbs-link">{{ $item['label'] }}</a>
                @else
                    <span class="breadcrumbs-current">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
