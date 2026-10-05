<h1 class="judul-halaman">Edit Artikel</h1>
<p class="sub-halaman">Perbarui informasi artikel yang sudah ada</p>

@if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $pesan)
                <li>{{ $pesan }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="form-artikel" action="{{ route('artikel.update', $artikel) }}" method="POST"
      enctype="multipart/form-data" class="kartu form-kartu" novalidate>
    @csrf
    @method('PUT')

    <div class="baris-atas">
        {{-- Thumbnail --}}
        <div>
            <span class="label">Foto / Thumbnail Artikel</span>
            <div id="dropzone" class="dropzone {{ $artikel->thumbnail ? 'ada-gambar' : '' }}">
                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp">
                <img id="preview" class="preview" alt="Pratinjau thumbnail"
                     src="{{ $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : '' }}">
                <div class="isi">
                    <div class="petunjuk"><strong>Upload a file</strong> or drag and drop</div>
                    <div class="petunjuk">JPG, PNG, WEBP up to 2MB</div>
                </div>
            </div>
            @if ($artikel->thumbnail)
                <p class="petunjuk">Kosongkan jika tidak ingin mengganti gambar.</p>
            @endif
        </div>

        {{-- Judul, kategori, tanggal --}}
        <div>
            <div class="field">
                <label for="judul">Judul Artikel</label>
                <input type="text" id="judul" name="judul" maxlength="200"
                       placeholder="Contoh: Kegiatan Pramuka Persami"
                       value="{{ old('judul', $artikel->judul) }}">
            </div>

            <div class="baris-dua">
                <div class="field">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat }}" @selected(old('kategori', $artikel->kategori) === $kat)>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="tanggal_publikasi">Tanggal Publikasi</label>
                    <input type="date" id="tanggal_publikasi" name="tanggal_publikasi"
                           value="{{ old('tanggal_publikasi', optional($artikel->tanggal_publikasi)->format('Y-m-d')) }}">
                </div>
            </div>
        </div>
    </div>

    <hr class="pemisah-form">

    {{-- Konten --}}
    <div class="field">
        <span class="label">Konten Artikel</span>
        <div class="editor-bungkus">
            <div class="toolbar">
                <button type="button" data-cmd="bold"><b>B</b></button>
                <button type="button" data-cmd="italic"><i>I</i></button>
                <button type="button" data-cmd="underline"><u>U</u></button>
                <span class="pemisah"></span>
                <button type="button" data-cmd="insertUnorderedList">&#8226;&#8801;</button>
                <button type="button" data-cmd="insertOrderedList">1.</button>
                <span class="pemisah"></span>
                <button type="button" data-cmd="createLink">&#128279;</button>
                <button type="button" data-cmd="insertImage">&#128444;</button>
            </div>
            <div id="editor" class="editor" contenteditable="true"
                 data-placeholder="Tulis konten artikel di sini..."></div>
        </div>
        {{-- Isi lama dimasukkan lewat textarea (aman, di-escape) lalu dipindah ke editor oleh JS --}}
        <textarea id="konten" name="konten" hidden>{{ old('konten', $artikel->konten) }}</textarea>
    </div>

    <div class="form-aksi">
        <a href="{{ route('artikel.index') }}" class="btn">Batal</a>
        <button type="submit" class="btn btn-utama">Simpan Perubahan</button>
    </div>
</form>

<script>
(function () {
    var zone = document.getElementById('dropzone');
    var input = document.getElementById('thumbnail');
    var preview = document.getElementById('preview');
    var editor = document.getElementById('editor');
    var kolomKonten = document.getElementById('konten');
    var form = document.getElementById('form-artikel');

    // Pindahkan isi lama ke editor
    editor.innerHTML = kolomKonten.value;

    // Preview thumbnail
    input.addEventListener('change', function () {
        var file = input.files[0];
        if (!file) return;
        if (['image/jpeg', 'image/png', 'image/webp'].indexOf(file.type) === -1) {
            alert('Format gambar harus JPG, PNG, atau WEBP.');
            input.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 2 MB.');
            input.value = '';
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            zone.classList.add('ada-gambar');
        };
        reader.readAsDataURL(file);
    });

    // Toolbar editor
    document.querySelectorAll('.toolbar button[data-cmd]').forEach(function (tombol) {
        tombol.addEventListener('mousedown', function (e) {
            e.preventDefault();
            var cmd = tombol.getAttribute('data-cmd');
            if (cmd === 'createLink') {
                var url = prompt('Masukkan alamat link (https://...)');
                if (url) document.execCommand('createLink', false, url);
            } else if (cmd === 'insertImage') {
                var src = prompt('Masukkan alamat gambar (https://...)');
                if (src) document.execCommand('insertImage', false, src);
            } else {
                document.execCommand(cmd, false, null);
            }
            editor.focus();
        });
    });

    // Salin isi editor ke textarea sebelum dikirim
    form.addEventListener('submit', function () {
        kolomKonten.value = editor.innerHTML.trim();
    });
})();
</script>