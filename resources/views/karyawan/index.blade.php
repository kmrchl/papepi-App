@extends('layout.admin')
@section('title', 'Admin : Karyawan')

@section('content')

    <h1>Daftar Produk</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID karyawan</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Aksi</th>
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
        axios.get('http://127.0.0.1:8000/api/karyawan')
            .then(response => {
                const karyawan = response.data.data; // Data dari API

                // Loop data
                karyawan.forEach(staff => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${staff.id_karyawan}</td>
                        <td>${staff.nama}</td>
                        <td>${staff.email}</td>
                        <td>${staff.posisi}</td>
                        <td><a href="/karyawan/detail/${staff.id_karyawan}" class="btn btn-link">Detail</a></td>
                    `;

                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>


@endsection
