<script>
    var data = @json($uv_lkpp);
    // Jumlah kolom dalam grid
    const numColumns = 10;
    let isDragging = false;

    // Array untuk menyimpan urutan kotak yang dipilih
    const selectedIndexes = []; 

    // Event untuk memulai drag
    $('.square-2').mousedown(function () {
        isDragging = true;
        const square = $(this);
        toggleSquare(square);
    });

    // Event untuk melakukan drag
    $('.square-2').mouseenter(function () {
        if (isDragging) {
            const square = $(this);
            toggleSquare(square);
        }
    });

    // Hentikan drag
    $(document).mouseup(function () {
        isDragging = false;
    });

    // Fungsi toggle untuk kotak
    function toggleSquare(square) {
        const index = square.data('index');
        if (square.hasClass('selected-2')) {
            square.removeClass('selected-2');
            const idx = selectedIndexes.indexOf(index);
            // Hapus jika sudah dipilih
            if (idx !== -1) selectedIndexes.splice(idx, 1);
        } else {
            square.addClass('selected-2');
            // Tambah jika dipilih
            selectedIndexes.push(index);
        }
    }

    $('#generateTable').click(function () {
        const table = $('#outputTable');
        table.empty(); // Bersihkan tabel lama

        const grid = new Array(100).fill(null);

        // Isi gridMap hanya dengan kotak yang dipilih
        let dataIndex = 0;
        // mulai nyoba
        selectedIndexes.forEach((index, i) => {
            grid[index - 1] = { ...data[dataIndex % data.length], order: i + 1 };
            dataIndex++;
        });

        // Bangun tabel berdasarkan gridMap
        for (let i = 0; i < grid.length; i += numColumns) {
            const row = $('<tr></tr>');
            for (let j = 0; j < numColumns; j++) {
                const cellData = grid[i + j];
                if (cellData) {
                    row.append(
                        `<td><strong>${cellData.order}</strong><br>${cellData.nama}<br>${cellData.no_ujian}</td>`
                        );
                } else {
                    row.append('<td></td>');
                }
            }
            table.append(row);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name=_token]').val()
            }
        });
        $.ajax({
            url: '{{url('import_member')}}' + '/824/import_denah_lkpp',
            method: 'POST',
            xhrFields: {
                responseType: 'blob' 
            },
            data: {
                tag_html: table[0].innerHTML
            },
            success: function (response) {
                const url = window.URL.createObjectURL(new Blob([response]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'data.xlsx');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });

</script>