@extends("sidebar.menu")
@section('title','Insertion de categorie')
@section('section')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Gestion des categories</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Outil</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Categorie</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Insertion de categorie</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('insert_categorie')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control input-default " placeholder="categorie">
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
                    <h4 class="card-title">Liste des categorie</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Nom de la catégorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_Categorie as $liste)
                            <tr>
                                <td>{{$liste->id}}</td>
                                <td>{{$liste->nom}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection