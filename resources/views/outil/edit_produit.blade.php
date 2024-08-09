@extends('sidebar.menu')
@section('title','Édition de produit')
@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Édition de produit</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Outil</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Édition de produit</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Édition de produit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('update_produit', ['id' => $produit->id]) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" name="nom" class="form-control" value="{{ $produit->nom }}" placeholder="Nom">
                            </div>
                            <div class="form-group">
                                <label for="">Couleur</label>
                                <select name="couleur" class="form-control">
                                    @foreach($liste_Couleur as $liste)
                                    <option value="{{ $liste->id }}" {{ $produit->couleur == $liste->id ? 'selected' : '' }}>
                                        {{ $liste->nom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Taille</label>
                                <select name="taille" class="form-control">
                                    @foreach($liste_Taille as $liste)
                                    <option value="{{ $liste->id }}" {{ $produit->taille == $liste->id ? 'selected' : '' }}>
                                        {{ $liste->nom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Categorie</label>
                                <select name="categorie" class="form-control">
                                    @foreach($liste_Categorie as $liste)
                                    <option value="{{ $liste->id }}" {{ $produit->categorie == $liste->id ? 'selected' : '' }}>
                                        {{ $liste->nom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Mettre à jour">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
