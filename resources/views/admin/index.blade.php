@extends('layout.admin')
@section('title')




@section('content')

    <h1>Daftar Produk</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID karyawan</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Total (jam)</th>
            </tr>
        </thead>
        <tbody id="absenTable">
            <!-- Data muncul disini -->
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Ambil elemen tbody
        const tableBody = document.getElementById('absenTable');

        // Panggil API menggunakan Axios
        axios.get('http://127.0.0.1:8000/api/absen')
            .then(response => {
                const absensi = response.data.data; // Data dari API

                // Loop data
                absensi.forEach(absen => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${absen.id_karyawan}</td>
                        <td>${absen.jam_masuk}</td>
                        <td>${absen.jam_keluar}</td>
                        <td>${absen.jam_kerja}</td>
                    `;

                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>


@endsection
