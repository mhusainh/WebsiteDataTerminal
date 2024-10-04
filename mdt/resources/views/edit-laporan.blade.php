<x-header>{{ $title }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    <div class="buat-laporan-container">
        <div class="halaman-buat-laporan">
            <div class="title-buat-laporan">Ubah Laporan Barang Hilang</div>
            <div class="warning-buat-laporan">
                <div>Perlu diingat, meskipun membagikan foto barang yang hilang dapat mempercepat penemuan barang
                    tersebut
                    dengan bantuan orang lain, hal ini juga bisa membuat Pencuri atau pihak yang tidak bertanggung jawab
                    mungkin akan semakin waspada jika mengetahui bahwa barang tersebut sedang dicari. Sebaiknya bagikan
                    dengan hati-hati dan pertimbangkan ke mana serta kepada siapa informasi tersebut disebarkan.</div>
                <div><img src="{{ asset('img/warning.png') }}" alt=""></div>
            </div>
            <form action="{{ route('upload.barang') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="detail-barang">
                    <div class="title-detail-barang">
                        <div class="title-detail-barang1">Detail Barang</div>
                    </div>
                    <div class="detail-input-barang">
                        <div class="nama-barang">
                            <div class="title-barang">Nama Barang</div>
                            <div class="input-barang"><input type="text"
                                    placeholder="{{ $barangHilang->nama_barang }}" maxlength="30" name="nama_barang"
                                    id="nama_barang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis nama barang maks. 30 karakter</div>
                                <div class="maksimal-penulisan">0/30</div>
                            </div>
                        </div>
                        <div class="lokasi-barang">
                            <div class="title-barang">Lokasi barang hilang</div>
                            <div class="input-barang"><input type="text"
                                    placeholder="{{ $barangHilang->alamat_barang }}" maxlength="60" name="alamat_barang"
                                    id="alamat_barang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis alamat terakhir barang sebelum hilang maks. 60
                                    karakter
                                </div>
                                <div class="maksimal-penulisan">0/60</div>
                            </div>
                        </div>
                        <div class="terakhir-barang">
                            <div class="title-barang">Terakhir terlihat</div>
                            <div class="input-barang">
                                <input type="text"
                                    placeholder="{{ \Carbon\Carbon::parse($barangHilang->created_at)->format('d/m/Y') }}"
                                    oninput="formatDate(this)" maxlength="10" name="tanggal_hilang" id="tanggal_hilang">
                            </div>
                        </div>
                        <div class="foto-barang">
                            <div class="title-barang">Foto Barang</div>
                            <div class="input-gambar">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="input-barang-1">
                                        <img id="img{{ $i }}"
                                            src="{{ !empty($barangHilang->{'gambar_barang' . $i}) ? Storage::url($barangHilang->{'gambar_barang' . $i}) : asset('img/addfoto' . $i . '.png') }}"
                                            alt="" onclick="triggerFileInput('fileInput{{ $i }}')">
                                        <input type="file" id="fileInput{{ $i }}" accept="image/*"
                                            style="display: none;"
                                            onchange="previewImage(this, 'img{{ $i }}')"
                                            name="gambar_barang{{ $i }}">
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="deskripsi-barang">
                            <div class="title-barang">Deskripsi barang hilang</div>
                            <div class="input-barang">
                                <textarea rows="5" maxlength="380" name="deskripsi_barang" id="deskripsi_barang"></textarea>
                            </div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis nama barang maks. 380 karakter</div>
                                <div class="maksimal-penulisan">0/380</div>
                            </div>
                        </div>
                    </div>
                    <div class="button-kirim-laporan">
                        <div><button type="submit" name="kirim">Kirim</button></div>
                    </div>
            </form>
        </div>
    </div>
    </div>


    <script>
        function updateCharacterCount(inputElement, counterElement, maxChars) {
            inputElement.addEventListener('input', function() {
                let currentLength = inputElement.value.length;
                counterElement.textContent = `${currentLength}/${maxChars}`;
                if (currentLength > maxChars) {
                    counterElement.classList.add('over-limit');
                } else {
                    counterElement.classList.remove('over-limit');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const namaBarangInput = document.querySelector('.nama-barang input');
            const namaBarangCounter = document.querySelector('.nama-barang .maksimal-penulisan');
            updateCharacterCount(namaBarangInput, namaBarangCounter, 30);

            const lokasiBarangInput = document.querySelector('.lokasi-barang input');
            const lokasiBarangCounter = document.querySelector('.lokasi-barang .maksimal-penulisan');
            updateCharacterCount(lokasiBarangInput, lokasiBarangCounter, 60);

            const deskripsiBarangInput = document.querySelector('.deskripsi-barang textarea');
            const deskripsiBarangCounter = document.querySelector('.deskripsi-barang .maksimal-penulisan');
            updateCharacterCount(deskripsiBarangInput, deskripsiBarangCounter, 380);
        });

        function formatDate(input) {
            let value = input.value.replace(/[^0-9]/g, '')
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            if (value.length > 5) {
                value = value.substring(0, 5) + '/' + value.substring(5);
            }
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            input.value = value;
        }

        function triggerFileInput(inputId) {
            document.getElementById(inputId).click();
        }

        // Fungsi untuk memuat dan menampilkan pratinjau gambar yang dipilih
        function previewImage(fileInput, imgId) {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(imgId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <x-Footer></x-Footer>
</body>

</html>
