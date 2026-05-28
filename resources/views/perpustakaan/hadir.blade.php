<x-kiosk>
    <x-slot name="title">Daftar Hadir</x-slot>

    <style>
        .kf-wrap { max-width: 540px; margin: 0 auto; }
        .kf-back  {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--k-navy); font-size: 14px; font-weight: 600;
            text-decoration: none; margin-bottom: 24px;
        }
        .kf-back:hover { text-decoration: underline; }

        .kf-card {
            background: #fff; border-radius: 18px;
            padding: 36px 32px;
            box-shadow: 0 4px 20px rgba(30,58,138,.09);
        }
        .kf-card-title { font-size: 22px; font-weight: 800; color: var(--k-navy); margin-bottom: 4px; }
        .kf-card-sub   { font-size: 13px; color: #64748b; margin-bottom: 28px; }

        .kf-field  { margin-bottom: 20px; }
        .kf-label  {
            display: block; font-size: 13px; font-weight: 700;
            color: #374151; margin-bottom: 7px;
        }
        .kf-label span { color: #ef4444; }
        .kf-input, .kf-select {
            width: 100%; padding: 12px 14px;
            border: 1.5px solid #e5e7eb; border-radius: 9px;
            font-size: 15px; font-family: inherit; color: #1e293b;
            background: #fff; outline: none;
            transition: border-color .15s, box-shadow .15s;
            box-sizing: border-box;
        }
        .kf-input:focus, .kf-select:focus {
            border-color: var(--k-navy2);
            box-shadow: 0 0 0 3px rgba(30,58,138,.1);
        }
        .kf-error { color: #ef4444; font-size: 12px; margin-top: 5px; }

        .kf-submit {
            width: 100%; padding: 14px;
            background: var(--k-navy); color: #fff;
            border: none; border-radius: 10px;
            font-size: 16px; font-weight: 800;
            cursor: pointer; font-family: inherit;
            margin-top: 6px;
            transition: background .15s;
        }
        .kf-submit:hover { background: var(--k-navy2); }

        .kf-jenis-toggle {
            display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px;
            margin-bottom: 20px;
        }
        .kf-jenis-btn {
            padding: 10px 4px; border-radius: 9px; border: 2px solid #e5e7eb;
            background: #fff; font-family: inherit; font-size: 13px; font-weight: 600;
            color: #64748b; cursor: pointer; text-align: center;
            transition: border-color .15s, color .15s, background .15s;
        }
        .kf-jenis-btn.active { border-color: var(--k-navy); color: var(--k-navy); background: #eff6ff; }

        /* Autocomplete */
        .kf-ac-wrap { position: relative; }
        .kf-ac-dropdown {
            position: absolute; top: calc(100% + 4px); left: 0; right: 0; z-index: 50;
            background: #fff; border: 1.5px solid #e5e7eb; border-radius: 10px;
            box-shadow: 0 8px 28px rgba(30,58,138,.14);
            max-height: 260px; overflow-y: auto;
            display: none;
        }
        .kf-ac-dropdown.open { display: block; }
        .kf-ac-item {
            padding: 11px 14px; cursor: pointer;
            display: flex; align-items: center; gap: 10px;
            transition: background .1s;
        }
        .kf-ac-item:hover, .kf-ac-item.focused { background: #eff6ff; }
        .kf-ac-item + .kf-ac-item { border-top: 1px solid #f1f5f9; }
        .kf-ac-avatar {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            background: var(--k-navy); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
        }
        .kf-ac-avatar.guru { background: var(--k-orange); }
        .kf-ac-nama  { font-size: 14px; font-weight: 700; color: #1e293b; }
        .kf-ac-nama mark { background: #fef08a; border-radius: 2px; padding: 0 1px; font-weight: 800; }
        .kf-ac-sub   { font-size: 12px; color: #64748b; }
        .kf-ac-empty { padding: 14px 16px; font-size: 13px; color: #94a3b8; text-align: center; }
        .kf-ac-loading { padding: 14px 16px; font-size: 13px; color: #94a3b8; text-align: center; }

        /* Badge anggota terdaftar */
        .kf-ac-confirmed {
            display: none; align-items: center; gap: 6px;
            margin-top: 7px; padding: 7px 12px;
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 7px;
            font-size: 12px; font-weight: 600; color: #15803d;
        }
        .kf-ac-confirmed.show { display: flex; }
        .kf-ac-confirmed i { font-size: 13px; }
    </style>

    <div class="kf-wrap">
        <a href="{{ route('perpustakaan.index') }}" class="kf-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Menu Utama
        </a>

        <div class="kf-card">
            <div class="kf-card-title">Isi Daftar Hadir</div>
            <div class="kf-card-sub">Catat kunjungan Anda ke perpustakaan hari ini</div>

            <form method="POST" action="{{ route('perpustakaan.hadir.simpan') }}" id="hadir-form">
                @csrf

                {{-- Pilih Jenis Pengunjung --}}
                <label class="kf-label">Saya adalah <span>*</span></label>
                <div class="kf-jenis-toggle">
                    <button type="button" class="kf-jenis-btn active" data-jenis="siswa">
                        <i class="fas fa-user-graduate" style="display:block;font-size:20px;margin-bottom:4px;"></i>
                        Siswa
                    </button>
                    <button type="button" class="kf-jenis-btn" data-jenis="guru">
                        <i class="fas fa-chalkboard-teacher" style="display:block;font-size:20px;margin-bottom:4px;"></i>
                        Guru/Staf
                    </button>
                    <button type="button" class="kf-jenis-btn" data-jenis="umum">
                        <i class="fas fa-user" style="display:block;font-size:20px;margin-bottom:4px;"></i>
                        Tamu
                    </button>
                </div>
                <input type="hidden" name="jenis_pengunjung" id="jenis_pengunjung" value="siswa">

                {{-- Nama dengan Autocomplete --}}
                <div class="kf-field">
                    <label for="nama" class="kf-label">Nama Lengkap <span>*</span></label>
                    <div class="kf-ac-wrap">
                        <input type="text" id="nama" name="nama" class="kf-input"
                               placeholder="Ketik nama untuk mencari..."
                               value="{{ old('nama') }}" autocomplete="off" required>
                        <div class="kf-ac-dropdown" id="ac-dropdown" role="listbox"></div>
                    </div>
                    <div class="kf-ac-confirmed" id="ac-confirmed">
                        <i class="fas fa-check-circle"></i>
                        <span id="ac-confirmed-text">Terdaftar sebagai anggota perpustakaan</span>
                    </div>
                    @error('nama') <div class="kf-error">{{ $message }}</div> @enderror
                </div>

                <input type="hidden" name="kelas" id="kelas-hidden" value="{{ old('kelas') }}">

                {{-- Keperluan --}}
                <div class="kf-field">
                    <label for="keperluan" class="kf-label">Keperluan <span>*</span></label>
                    <select id="keperluan" name="keperluan" class="kf-select" required>
                        <option value="">— Pilih Keperluan —</option>
                        <option value="Membaca" {{ old('keperluan') === 'Membaca' ? 'selected' : '' }}>Membaca Buku</option>
                        <option value="Meminjam Buku" {{ old('keperluan') === 'Meminjam Buku' ? 'selected' : '' }}>Meminjam Buku</option>
                        <option value="Mengembalikan Buku" {{ old('keperluan') === 'Mengembalikan Buku' ? 'selected' : '' }}>Mengembalikan Buku</option>
                        <option value="Belajar / Mengerjakan Tugas" {{ old('keperluan') === 'Belajar / Mengerjakan Tugas' ? 'selected' : '' }}>Belajar / Mengerjakan Tugas</option>
                        <option value="Mencari Referensi" {{ old('keperluan') === 'Mencari Referensi' ? 'selected' : '' }}>Mencari Referensi</option>
                        <option value="Lainnya" {{ old('keperluan') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('keperluan') <div class="kf-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="kf-submit">
                    <i class="fas fa-check-circle"></i> Isi Daftar Hadir
                </button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    <script>
    (function () {
        const SEARCH_URL = '{{ route('perpustakaan.anggota.cari') }}';

        const btns        = document.querySelectorAll('.kf-jenis-btn');
        const hiddenJenis = document.getElementById('jenis_pengunjung');
        const kelasHidden = document.getElementById('kelas-hidden');
        const namaInput   = document.getElementById('nama');
        const dropdown    = document.getElementById('ac-dropdown');
        const confirmed   = document.getElementById('ac-confirmed');
        const confirmedTxt = document.getElementById('ac-confirmed-text');

        let currentJenis = 'siswa';
        let debounceTimer = null;
        let focusedIndex  = -1;
        let lastResults   = [];

        // ── Jenis toggle ────────────────────────────────────────────
        function setJenis(jenis) {
            currentJenis = jenis;
            btns.forEach(b => b.classList.toggle('active', b.dataset.jenis === jenis));
            hiddenJenis.value = jenis;

            if (jenis === 'umum') {
                namaInput.placeholder = 'Masukkan nama lengkap Anda';
                closeDropdown();
                clearConfirmed();
            } else {
                namaInput.placeholder = 'Ketik nama untuk mencari...';
            }

            clearConfirmed();
            closeDropdown();
        }

        btns.forEach(b => b.addEventListener('click', () => {
            setJenis(b.dataset.jenis);
            namaInput.value  = '';
            kelasHidden.value = '';
        }));

        setJenis('siswa');

        // ── Autocomplete ─────────────────────────────────────────────
        namaInput.addEventListener('input', function () {
            if (currentJenis === 'umum') return;
            clearConfirmed();
            clearTimeout(debounceTimer);
            const q = this.value.trim();
            if (q.length < 2) { closeDropdown(); return; }
            showLoading();
            debounceTimer = setTimeout(() => fetchResults(q), 280);
        });

        namaInput.addEventListener('keydown', function (e) {
            if (!dropdown.classList.contains('open')) return;
            const items = dropdown.querySelectorAll('.kf-ac-item');
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                focusedIndex = Math.min(focusedIndex + 1, items.length - 1);
                updateFocus(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                focusedIndex = Math.max(focusedIndex - 1, 0);
                updateFocus(items);
            } else if (e.key === 'Enter' && focusedIndex >= 0) {
                e.preventDefault();
                selectMember(lastResults[focusedIndex]);
            } else if (e.key === 'Escape') {
                closeDropdown();
            }
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.kf-ac-wrap')) closeDropdown();
        });

        function fetchResults(q) {
            const url = SEARCH_URL + '?q=' + encodeURIComponent(q) + '&jenis=' + currentJenis;
            fetch(url)
                .then(r => r.json())
                .then(data => {
                    lastResults  = data;
                    focusedIndex = -1;
                    if (data.length === 0) {
                        showEmpty();
                    } else {
                        renderResults(data, q);
                    }
                })
                .catch(() => closeDropdown());
        }

        function renderResults(results, q) {
            dropdown.innerHTML = '';
            results.forEach((m, i) => {
                const item = document.createElement('div');
                item.className = 'kf-ac-item';
                item.setAttribute('role', 'option');

                const initial  = m.nama.charAt(0).toUpperCase();
                const isGuru   = m.jenis === 'guru';
                const subLabel = isGuru ? (m.kelas || 'Guru/Staf') : ('Kelas ' + (m.kelas || '—'));

                item.innerHTML =
                    '<div class="kf-ac-avatar' + (isGuru ? ' guru' : '') + '">' + initial + '</div>' +
                    '<div>' +
                        '<div class="kf-ac-nama">' + highlight(m.nama, q) + '</div>' +
                        '<div class="kf-ac-sub">' + subLabel + ' &nbsp;·&nbsp; ' + m.kode_anggota + '</div>' +
                    '</div>';

                item.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                    selectMember(m);
                });
                dropdown.appendChild(item);
            });
            openDropdown();
        }

        function showLoading() {
            dropdown.innerHTML = '<div class="kf-ac-loading"><i class="fas fa-circle-notch fa-spin"></i> Mencari...</div>';
            openDropdown();
        }

        function showEmpty() {
            dropdown.innerHTML = '<div class="kf-ac-empty"><i class="fas fa-user-slash"></i> Tidak ditemukan di daftar anggota</div>';
            openDropdown();
        }

        function selectMember(m) {
            namaInput.value   = m.nama;
            kelasHidden.value = m.kelas || '';
            closeDropdown();

            const label = m.jenis === 'guru'
                ? 'Terdaftar sebagai Guru/Staf &nbsp;·&nbsp; ' + m.kode_anggota
                : 'Anggota ' + (m.kelas ? 'Kelas ' + m.kelas + ' &nbsp;·&nbsp; ' : '') + m.kode_anggota;

            confirmedTxt.innerHTML = label;
            confirmed.classList.add('show');
        }

        function clearConfirmed() {
            confirmed.classList.remove('show');
        }

        function updateFocus(items) {
            items.forEach((el, i) => el.classList.toggle('focused', i === focusedIndex));
            if (items[focusedIndex]) items[focusedIndex].scrollIntoView({ block: 'nearest' });
        }

        function openDropdown()  { dropdown.classList.add('open'); }
        function closeDropdown() { dropdown.classList.remove('open'); focusedIndex = -1; }

        function highlight(text, q) {
            if (!q) return escHtml(text);
            const idx = text.toLowerCase().indexOf(q.toLowerCase());
            if (idx === -1) return escHtml(text);
            return escHtml(text.slice(0, idx)) +
                   '<mark>' + escHtml(text.slice(idx, idx + q.length)) + '</mark>' +
                   escHtml(text.slice(idx + q.length));
        }

        function escHtml(str) {
            return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }
    })();
    </script>
    </x-slot>
</x-kiosk>
