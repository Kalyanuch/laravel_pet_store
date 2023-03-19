<tr>
    <td>{{ $item->id }}.</td>
    <td>{{ $title_prefix }}{{ $item->title }}</td>
    <td>{{ $item->slug }}</td>
    <td>@if($item->status) {{ __('admin.enabled') }} @else {{ __('admin.disabled') }} @endif</td>
    <td>
        <a class="btn btn-app bg-success" href="{{ route('admin.categories.edit', ['category' => $item->id]) }}">
            <i class="fas fa-pen"></i> {{ __('admin.edit') }}
        </a>
        <form class="d-inline" method="post" action="{{ route('admin.categories.destroy', ['category' => $item->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('{{ __('admin.delete_confirmation') }}') ? true : false;">
                <i class="fas fa-minus"></i> {{ __('admin.remove') }}
            </button>
        </form>
    </td>
</tr>
