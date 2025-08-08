document.addEventListener("DOMContentLoaded", function() {
    let offset = 0;
    const limit = 1;
    let currentFilter = 'all';
    const container = document.querySelector(".dd");
    const loadMoreBtn = document.getElementById("loadMoreBtn");

    function initGrid(grid) {
        imagesLoaded(grid, function() {
            new Masonry(grid, {
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });

        lightGallery(grid, {
            selector: '.grid-item a',
            thumbnail: true,
            zoom: true,
            actualSize: true,
            download: true,
            plugins: [lgThumbnail]
        });
    }

    function loadGaleri(append = true) {
        loadMoreBtn.disabled = true;
        loadMoreBtn.innerText = "Loading...";

        fetch(`/galeri/ajax?filter=${currentFilter}&offset=${offset}`)
            .then(res => res.json())
            .then(data => {
                if (append) {
                    container.insertAdjacentHTML('beforeend', data.html);
                } else {
                    container.innerHTML = data.html;
                }

                document.querySelectorAll('.grid').forEach(initGrid);

                offset += limit;

                if (data.count < limit) {
                    loadMoreBtn.style.display = "none";
                } else {
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.innerText = "Lihat Lebih Banyak";
                }
            });
    }

    // Inisialisasi awal
    loadGaleri();

    loadMoreBtn.addEventListener("click", () => loadGaleri());

    // Filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener("click", function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove(
                "active"));
            this.classList.add("active");

            currentFilter = this.dataset.filter;
            offset = 0;
            loadMoreBtn.style.display = "inline-block";
            loadGaleri(false);
        });
    });
});