@extends("sidebar.menu")
@section('title','Insertion de achats')
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Voir achat</a></li>
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
                    <table id="productsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Date</th>
                                <th>Nom de la produit</th>
                                <th>Quantite actuelle</th>
                                @if(Session::get('admin')==true)
                                <th>Prix_unitaire</th>
                                <th>Montant total</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_Achats as $liste)
                            <tr>
                                <td>{{ $liste->id }}</td>
                                <td>{{ $liste->date }}</td>
                                <td>{{ $liste->produits_nom }}</td>
                                <td>{{ $liste->quantite }}</td>
                                @if(Session::get('admin')==true)
                                    <td>{{ $liste->prix_unitaire }} Ar</td>
                                    <td>{{ $liste->montant_total }} Ar</td>
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
@endsection
