<div style="display: flex; gap: 4px">

    @if ($status == 'berjalan')
        <a href={{ route('admin.sewa-kamar.edit', $id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.sewa-kamar.checkout1', $id) }}" class="btn btn-info">Checkout</a>
    @else
        <a href="{{ route('admin.sewa-kamar.detail', $id) }}" class="btn btn-info">Detail</a>
    @endif
</div>
