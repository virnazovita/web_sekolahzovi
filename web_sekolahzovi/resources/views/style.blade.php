<style>
    .app { display: flex; min-height: 100vh; }
    .main { flex: 1; min-width: 0; background: #f7f8fc; }
    .konten { padding: 32px; max-width: 1100px; font-family: system-ui, -apple-system, 'Segoe UI', sans-serif; color: #101828; font-size: 14px; }

    .judul-halaman { font-size: 32px; font-weight: 800; letter-spacing: -.5px; line-height: 1.15; margin: 0; }
    .sub-halaman { color: #667085; margin: 6px 0 0; }
    .kepala-halaman { display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; }

    .btn { display: inline-flex; align-items: center; padding: 9px 16px; border-radius: 8px; border: 1px solid #e4e7ec; background: #fff; font: inherit; font-size: 12.5px; font-weight: 600; cursor: pointer; color: #101828; text-decoration: none; }
    .btn:hover { background: #f2f4f7; }
    .btn-utama { background: #1554d8; border-color: #1554d8; color: #fff; }
    .btn-utama:hover { background: #0f45b8; }

    /* Tombol aksi edit & hapus */
    .aksi { display: flex; gap: 8px; }
    .aksi form { margin: 0; }
    .btn-ikon { width: 34px; height: 34px; border-radius: 8px; background: #fff; display: grid; place-items: center; cursor: pointer; border: 1px solid; padding: 0; }
    .btn-ikon svg { width: 16px; height: 16px; }
    .btn-edit { color: #1554d8; border-color: #1554d8; }
    .btn-edit:hover { background: #eaf0ff; }
    .btn-hapus { color: #d92d3a; border-color: #d92d3a; }
    .btn-hapus:hover { background: #fdecee; }

    .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; }
    .alert-success { background: #e8f7ee; color: #14683a; border: 1px solid #b7e4c7; }
    .alert-error { background: #fdecee; color: #a11b26; border: 1px solid #f5b8be; }
    .alert ul { margin: 0 0 0 18px; padding: 0; }

    .kartu { background: #fff; border: 1px solid #e4e7ec; border-radius: 12px; }
    .tabel-bungkus { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; font-size: 12px; color: #667085; font-weight: 600; padding: 12px 16px; background: #fafbfd; border-bottom: 1px solid #e4e7ec; }
    td { padding: 14px 16px; border-bottom: 1px solid #e4e7ec; vertical-align: middle; }
    tr:last-child td { border-bottom: 0; }
    .thumb { width: 64px; height: 44px; border-radius: 6px; object-fit: cover; background: #e9ecf3; display: block; }
    .judul-artikel { font-weight: 600; }
    .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; background: #eef2fb; color: #26428b; font-size: 11.5px; font-weight: 600; }
    .kosong { text-align: center; padding: 48px 16px; color: #667085; }

    /* Form */
    .form-kartu { padding: 24px; }
    .baris-atas { display: grid; grid-template-columns: 300px 1fr; gap: 24px; }
    .baris-dua { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .field label, .label { font-size: 12px; font-weight: 700; }
    .form-kartu input[type=text], .form-kartu input[type=date], .form-kartu select { width: 100%; box-sizing: border-box; padding: 9px 12px; border: 1px solid #e4e7ec; border-radius: 6px; font: inherit; font-size: 12.5px; background: #f7f8fc; color: #101828; }
    .form-kartu input:focus, .form-kartu select:focus, .editor:focus { outline: 2px solid rgba(21, 84, 216, .35); border-color: #1554d8; }
    .catatan { font-size: 11px; color: #667085; margin: 6px 0 0; }
    hr.pemisah-form { border: 0; border-top: 1px solid #e4e7ec; margin: 8px 0 24px; }

    .dropzone { position: relative; border: 1.5px dashed #b8bfcc; border-radius: 6px; background: #fbfcfe; min-height: 200px; display: grid; place-items: center; text-align: center; cursor: pointer; overflow: hidden; padding: 16px; margin-top: 6px; }
    .dropzone input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
    .dropzone .petunjuk { font-size: 11px; color: #667085; }
    .dropzone .petunjuk strong { color: #101828; }
    .dropzone img.preview { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: none; }
    .dropzone.ada-gambar img.preview { display: block; }
    .dropzone.ada-gambar .isi { visibility: hidden; }

    .editor-bungkus { border: 1px solid #e4e7ec; border-radius: 6px; overflow: hidden; }
    .toolbar { display: flex; align-items: center; gap: 2px; padding: 6px 8px; background: #eef2fb; border-bottom: 1px solid #e4e7ec; }
    .toolbar button { width: 28px; height: 28px; border: 0; background: transparent; border-radius: 4px; cursor: pointer; font: inherit; font-size: 12px; font-weight: 700; }
    .toolbar button:hover { background: #dbe4f7; }
    .toolbar .pemisah { width: 1px; height: 16px; background: #c9d2e6; margin: 0 6px; }
    .editor { min-height: 220px; padding: 14px; background: #f7f8fc; font-size: 13px; }
    .editor:empty::before { content: attr(data-placeholder); color: #98a2b3; }
    .editor img { max-width: 100%; height: auto; }

    .form-aksi { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #e4e7ec; }

    @media (max-width: 860px) {
        .app { flex-direction: column; }
        .konten { padding: 20px 16px; }
        .baris-atas, .baris-dua { grid-template-columns: 1fr; }
        .judul-halaman { font-size: 26px; }
    }
</style>