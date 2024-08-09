@extends("sidebar.menu")
@section('title','Insertion de cout de vente')
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Cout de vente achats</a></li>
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
                                    <th>Cout de vente</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($liste_Produits as $liste)
                                <tr>
                                    <td>{{ $liste->id }}</td>
                                    <td>{{ $liste->nom }}</td>
                                    <td><input type="date" name="produits[{{ $loop->index }}][date]" class="form-control" value="{{ now()->format('Y-m-d') }}"></td>
                                    <td><input type="number" name="produits[{{ $loop->index }}][cout]" class="form-control"></td>
                                    <input type="hidden" name="produits[{{ $loop->index }}][id]" value="{{ $liste->id }}">
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
