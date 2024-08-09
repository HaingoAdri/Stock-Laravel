    @extends("sidebar.menu")
    @section('title','Insertion de achat')
    @section('section')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Gestion des achat</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Achat</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajout de achat</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Insertion de achat</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('insert_achats')}}" method="post">
                                @csrf
                                <table id="achat-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Produits</th>
                                            <th>Quantite</th>
                                            <th>Prix_Unitaire</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="date" name="achat[0][date]" class="form-control" placeholder="Date"></td>
                                            <td>
                                                <select name="achat[0][produit]" class="form-control">
                                                    @foreach($liste_Produits as $liste)
                                                    <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="achat[0][quantite]" class="form-control" placeholder="Quantite">
                                            </td>
                                            <td>
                                                <input type="number" name="achat[0][prix]" class="form-control" placeholder="prix">
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-remove-row">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group text-end">
                                    <button type="button" id="add-row" class="btn btn-success">Add Row</button>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Inserer">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-row').addEventListener('click', function() {
            var table = document.getElementById('achat-table').getElementsByTagName('tbody')[0];
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            row.innerHTML = `
                <td><input type="date" name="achat[${rowCount}][date]" class="form-control" placeholder="Date"></td>
                <td>
                    <select name="achat[${rowCount}][produit]" class="form-control">
                        @foreach($liste_Produits as $liste)
                        <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="achat[${rowCount}][quantite]" class="form-control" placeholder="Quantite">
                </td>
                <td>
                    <input type="number" name="achat[${rowCount}][prix]" class="form-control" placeholder="prix">
                </td>
                <td><button type="button" class="btn btn-danger btn-remove-row">Remove</button></td>
            `;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-row')) {
                var row = e.target.closest('tr');
                row.parentNode.removeChild(row);
            }
        });
    </script>
    @endsection
