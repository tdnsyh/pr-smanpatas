// Toggle deskripsi singkat dan lengkap
function toggleDeskripsi() {
    const deskripsi = document.getElementById('deskripsiSingkat');
    const button = document.getElementById('btnSelengkapnya');

    const isExpanded = deskripsi.style.maxHeight === 'none';

    deskripsi.style.maxHeight = isExpanded ? '120px' : 'none';
    button.innerText = isExpanded ? 'Selengkapnya' : 'Tampilkan Lebih Sedikit';
}

// Inisialisasi editor Quill dan proses submit form
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor', { theme: 'snow' });

    const form = document.getElementById('formCampaign');
    form.addEventListener('submit', function () {
        const deskripsiInput = document.getElementById('deskripsi');
        deskripsiInput.value = quill.root.innerHTML;
    });
});

// Preview gambar saat input berubah
const input = document.getElementById('gambar');
const previewContainer = document.getElementById('preview-container');
let fileList = [];

input.addEventListener('change', function (e) {
    fileList = Array.from(e.target.files); // Simpan file ke array
    updatePreview();
});

// Tampilkan preview gambar dan tombol hapus
function updatePreview() {
    previewContainer.innerHTML = "";

    fileList.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.className = "position-relative";

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = "rounded border";
            img.style.width = "250px";
            img.style.height = "auto";
            img.style.objectFit = "cover";

            const btn = document.createElement('button');
            btn.type = "button";
            btn.innerHTML = "&times;";
            btn.className = "btn btn-sm btn-danger position-absolute top-0 end-0";
            btn.style.zIndex = "2";
            btn.style.transform = "translate(50%, -50%)";

            btn.addEventListener('click', () => {
                fileList.splice(index, 1);       // Hapus dari list
                updateInputFiles();              // Perbarui input
                updatePreview();                 // Perbarui tampilan
            });

            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
}

// Perbarui input type="file" secara manual
function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    fileList.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}
