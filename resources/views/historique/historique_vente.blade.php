@extends("sidebar.menu")
@section('title','Historique de vente')
@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Liste des ventes</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Historique</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Vente</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des ventes</h4>
                </div>
                <div class="card-body">
                    <table id="productsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Date</th>
                                <th>Nom de la produit</th>
                                <th>Quantite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_historique_vente as $liste)
                            <tr>
                                <td>{{ $liste->vente }}</td>
                                <td>{{ $liste->date }}</td>
                                <td>{{ $liste->nom }}</td>
                                <td>{{ $liste->quantite }}</td>
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
