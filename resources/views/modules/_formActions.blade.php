<div style="display: flex; gap: 4px">
    <a href="{!! $editUrl !!}" class="btn btn-warning">Edit</a>
    <form action=" {!! $deleteUrl !!} " method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">
            Hapus
        </button>
    </form>
</div>
