<tr>
    <td>{{ $item->id }}.</td>
    <td>{{ $item->title }}</td>
    <td>{{ $item->slug }}</td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->quantity }}</td>
    <td>{{ $item->sort_order }}</td>
    <td>@if($item->status) {{ __('admin.enabled') }} @else {{ __('admin.disabled') }} @endif</td>
    <td>
        <a class="btn btn-app bg-success" href="{{ route('admin.products.edit', ['product' => $item->id]) }}">
            <i class="fas fa-pen"></i> {{ __('admin.edit') }}
        </a>
        <form class="d-inline" method="post" action="{{ route('admin.products.destroy', ['product' => $item->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('{{ __('admin.delete_confirmation') }}') ? true : false;">
                <i class="fas fa-minus"></i> {{ __('admin.remove') }}
            </button>
        </form>
    </td>
</tr>
