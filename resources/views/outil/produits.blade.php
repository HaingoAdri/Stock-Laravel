@extends("sidebar.menu")
@section('title','Insertion de produits')
@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Gestion des produits</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Outil</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajout de produits</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Insertion de produits</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('insert_produits') }}" method="post">
                            @csrf
                            <table id="produits-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Couleur</th>
                                        <th>Taille</th>
                                        <th>Categorie</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="produits[0][nom]" class="form-control" placeholder="Nom"></td>
                                        <td>
                                            <select name="produits[0][couleur]" class="form-control">
                                                @foreach($liste_Couleur as $liste)
                                                <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="produits[0][taille]" class="form-control">
                                                @foreach($liste_Taille as $liste)
                                                <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="produits[0][categorie]" class="form-control">
                                                @foreach($liste_Categorie as $liste)
                                                <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                                                @endforeach
                                            </select>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des produits</h4>
                </div>
                <div class="card-body">
                    <table id="productsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Nom de la produit</th>
                                <th>Couleur</th>
                                <th>Taille</th>
                                <th>Categorie</th>
                                @if(Session::get('admin')==true)
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_Produits as $liste)
                            <tr>
                                <td>{{ $liste->id }}</td>
                                <td>{{ $liste->nom }}</td>
                                <td>{{ $liste->couleur }}</td>
                                <td>{{ $liste->taille }}</td>
                                <td>{{ $liste->categorie }}</td>
                                @if(Session::get('admin')==true)
                                <td>
                                    <form action="{{ route('delete_produit', ['id' => $liste->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('add-row').addEventListener('click', function() {
        var table = document.getElementById('produits-table').getElementsByTagName('tbody')[0];
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        row.innerHTML = `
            <td><input type="text" name="produits[${rowCount}][nom]" class="form-control" placeholder="Nom"></td>
            <td>
                <select name="produits[${rowCount}][couleur]" class="form-control">
                    @foreach($liste_Couleur as $liste)
                    <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="produits[${rowCount}][taille]" class="form-control">
                    @foreach($liste_Taille as $liste)
                    <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="produits[${rowCount}][categorie]" class="form-control">
                    @foreach($liste_Categorie as $liste)
                    <option value="{{ $liste->id }}">{{ $liste->nom }}</option>
                    @endforeach
                </select>
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

    $(document).ready(function() {
        $('#productsTable').DataTable();
    });
</script>
@endsection
