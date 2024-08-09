@extends("sidebar.menu")

@section('title', 'Insertion de coût de vente')

@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Gestion des achats</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Achat</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Coût de vente achats</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des achats</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('produitCoutVente.store') }}" method="POST">
                        @csrf
                        <table id="productsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Nom du produit</th>
                                    <th>Date</th>
                                    <th>Coût de vente</th>
                                    <th>Code-barres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits_cout_vente as $produit)
                                <tr>
                                    <td>{{ $produit->id }}</td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->date }}</td>
                                    <td>{{ $produit->prix_vente }} Ar</td>
                                    <td>
                                        @if($produit->code_barre)
                                            <img src="data:image/png;base64,{{ $produit->code_barre }}" alt="Code-barres" style="width: 150px; height: auto;">
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
