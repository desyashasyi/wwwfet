<div>
    <x-card title="Program | Time :: Teachers" shadow separator>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Favorite Color</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>1</th>
                    <td>Cy Ganderton</td>
                    <td>Quality Control Specialist</td>
                    <td>Blue</td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Hart Hagerty</td>
                    <td>Desktop Support Technician</td>
                    <td>Purple</td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Brice Swyre</td>
                    <td>Tax Accountant</td>
                    <td>Red</td>
                </tr>
                </tbody>
            </table>
        </div>




    </x-card>

    <style>
        /* Border vertikal halus dengan warna abu-abu muda (lebih halus dari default DaisUI) */
        .table.table-bordered th,
        .table.table-bordered td {
            border-right: 1px solid #e5e7eb; /* Warna abu-abu lembut, seperti Tailwind gray-200 */
        }

        /* Hapus border kanan di kolom terakhir untuk kesan konsisten */
        .table.table-bordered th:last-child,
        .table.table-bordered td:last-child {
            border-right: none;
        }

        /* Optional: Tambahkan sedikit jarak internal untuk tampilan lebih luas */
        .table.table-bordered th,
        .table.table-bordered td {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    </style>

    {{-- The whole world belongs to you. --}}
</div>
