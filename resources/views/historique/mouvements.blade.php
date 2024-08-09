@extends("sidebar.menu")
@section('title','Mouvements')
@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Liste des mouvements</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Historique</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Mouvements</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des mouvements</h4>
                </div>
                <div class="card-body">
                    <table id="productsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nom de la produit</th>
                                <th>Achats référence</th>
                                <th>Vente référence</th>
                                <th>Quantité dans l'achat</th>
                                <th>Quantite retirer</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_mouvements as $liste)
                            <tr>
                                <td>{{ $liste->date }}</td>
                                <td>{{ $liste->nom_produit }}</td>
                                <td>{{ $liste->achats }}</td>
                                <td>{{ $liste->vente }}</td>
                                <td>{{ $liste->quantite_actuelle }}</td>
                                <td>{{ $liste->quantite_retirer }}</td>
                                <td>{{ $liste->quantite_actuelle - $liste->quantite_retirer }}</td>
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
