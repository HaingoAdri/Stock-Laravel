@extends("sidebar.menu")

@section('title', 'Insertion de coût de vente')

@section('section')
<div class="container-fluid">
    <div class="row page-tiles mx-0">
        <div class="col-12 p-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="welcome-text">
                        <h4>Caisse</h4>
                    </div>
                    <form id="productForm">
                        <h6 class="mt-3">Donner le produit:</h6>
                        <div class="row p-3">
                            <table class="table table-striped" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Produits</th>
                                        <th>Code-barres</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="product_name[]" class="form-control product-select" onchange="updateBarcode(this)">
                                                <option value="">-- Sélectionner un produit --</option>
                                                @foreach($produits_cout_vente as $pro)
                                                <option value="{{$pro->id}}" data-price="{{$pro->prix_vente}}" data-barcode="{{$pro->code_barre}}">{{$pro->nom}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="product_barcode[]" class="form-control barcode-select" onchange="updateProductName(this)">
                                                <option value="">-- Sélectionner un code-barres --</option>
                                                @foreach($produits_cout_vente as $pro)
                                                <option value="{{$pro->id}}" data-price="{{$pro->prix_vente}}" data-barcode="{{$pro->code_barre}}">{{$pro->code_barre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantite[]" class="form-control" min="1" value="1">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger removeRowButton">Supprimer</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary" id="addRowButton">Ajouter ligne</button>
                                <button type="button" id="submitFormButton" class="btn btn-success">Insérer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des achats pour ce panier</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('creation-panier')}}" method="POST">
                        @csrf
                        <table id="productsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom du produit</th>
                                    <th>Prix de vente</th>
                                    <th>Quantité</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Les achats seront ajoutés ici -->
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div class="py-2">
                                <h5>Total : <span id="totalCost">0</span> AR</h5>
                            </div>
                            <div class="py-2">
                                <label for="" class="text-dark">Montant payer</label>
                                <input type="number" name="montant_payer" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('addRowButton').addEventListener('click', function() {
    var table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow();
    
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);

    var selectProductName = document.createElement('select');
    selectProductName.name = 'product_name[]';
    selectProductName.classList.add('form-control', 'product-select');
    selectProductName.onchange = function() { updateBarcode(this); };
    @foreach($produits_cout_vente as $pro)
    var option = document.createElement('option');
    option.value = "{{ $pro->id }}";
    option.setAttribute('data-price', "{{$pro->prix_vente}}");
    option.setAttribute('data-barcode', "{{$pro->code_barre}}");
    option.text = "{{ $pro->nom }}";
    selectProductName.appendChild(option);
    @endforeach
    cell1.appendChild(selectProductName);

    var selectBarcode = document.createElement('select');
    selectBarcode.name = 'product_barcode[]';
    selectBarcode.classList.add('form-control', 'barcode-select');
    selectBarcode.onchange = function() { updateProductName(this); };
    @foreach($produits_cout_vente as $pro)
    var option = document.createElement('option');
    option.value = "{{ $pro->id }}";
    option.setAttribute('data-price', "{{$pro->prix_vente}}");
    option.setAttribute('data-barcode', "{{$pro->code_barre}}");
    option.text = "{{ $pro->code_barre }}";
    selectBarcode.appendChild(option);
    @endforeach
    cell2.appendChild(selectBarcode);

    var input = document.createElement('input');
    input.type = 'number';
    input.name = 'quantite[]';
    input.classList.add('form-control');
    input.min = '1';
    input.value = '1';
    cell3.appendChild(input);

    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger', 'removeRowButton');
    removeButton.innerText = 'Supprimer';
    removeButton.addEventListener('click', function() {
        var row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateTotalCost();
    });
    cell4.appendChild(removeButton);
});

document.getElementById('submitFormButton').addEventListener('click', function() {
    var table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    var productsTable = document.getElementById('productsTable').getElementsByTagName('tbody')[0];

    for (var i = 0, row; row = table.rows[i]; i++) {
        var selectProductName = row.cells[0].getElementsByTagName('select')[0];
        var selectBarcode = row.cells[1].getElementsByTagName('select')[0];
        var productId = selectProductName.value || selectBarcode.value;
        var productName = selectProductName.options[selectProductName.selectedIndex]?.text || selectBarcode.options[selectBarcode.selectedIndex]?.text;
        var productPrice = parseFloat(selectProductName.options[selectProductName.selectedIndex]?.getAttribute('data-price') || selectBarcode.options[selectBarcode.selectedIndex]?.getAttribute('data-price'));
        var quantity = parseInt(row.cells[2].getElementsByTagName('input')[0].value);

        var existingRow = Array.from(productsTable.rows).find(r => r.cells[0].innerText.includes(productName));

        if (existingRow) {
            var existingQuantity = parseInt(existingRow.cells[2].getElementsByClassName('quantity')[0].innerText);
            existingRow.cells[2].getElementsByClassName('quantity')[0].innerText = existingQuantity + quantity;
            existingRow.cells[2].getElementsByTagName('input')[0].value = existingQuantity + quantity;
        } else {
            var newRow = productsTable.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = `${productName} <input type="hidden" value="${productId}" name="productId[]"/>`;
            cell2.innerText = productPrice.toFixed(2) + ' AR';
            cell3.innerHTML = `
                <button type="button" class="btn btn-secondary btn-sm" onclick="decrementQuantity(this)">-</button>
                <span class="quantity">${quantity}</span>
                <button type="button" class="btn btn-secondary btn-sm" onclick="incrementQuantity(this)">+</button>
                <input type="hidden" value="${quantity}" name="quantite[]"/>
            `;

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn', 'btn-danger', 'removeRowButton');
            removeButton.innerText = 'Supprimer';
            removeButton.addEventListener('click', function() {
                var row = this.parentNode.parentNode;
                row.parentNode.removeChild(row);
                updateTotalCost();
            });
            cell4.appendChild(removeButton);
        }
    }

    updateTotalCost();
    table.innerHTML = ''; // Clear the form table
});

function updateProductName(select) {
    var row = select.parentNode.parentNode;
    var productSelect = row.querySelector('.product-select');
    if (productSelect) {
        var selectedOption = select.options[select.selectedIndex];
        productSelect.value = select.value;
        productSelect.dispatchEvent(new Event('change'));
    }
}

function updateBarcode(select) {
    var row = select.parentNode.parentNode;
    var barcodeSelect = row.querySelector('.barcode-select');
    if (barcodeSelect) {
        var selectedOption = select.options[select.selectedIndex];
        barcodeSelect.value = select.value;
        barcodeSelect.dispatchEvent(new Event('change'));
    }
}

function updateTotalCost() {
    var total = 0;
    var productsTable = document.getElementById('productsTable').getElementsByTagName('tbody')[0];

    for (var i = 0, row; row = productsTable.rows[i]; i++) {
        var price = parseFloat(row.cells[1].innerText.replace(' AR', ''));
        var quantity = parseInt(row.querySelector('.quantity').innerText);
        total += price * quantity;
    }

    var totalFormatted = total.toLocaleString();
    var totalCostElement = document.getElementById('totalCost');
    
    totalCostElement.innerHTML = `${totalFormatted} <input type="hidden" value="${total}" name="montantTotal"/>`;
}


function incrementQuantity(button) {
    var quantitySpan = button.parentNode.querySelector('.quantity');
    var currentQuantity = parseInt(quantitySpan.innerText);
    quantitySpan.innerText = currentQuantity + 1;
    updateTotalCost();
}

function decrementQuantity(button) {
    var quantitySpan = button.parentNode.querySelector('.quantity');
    var currentQuantity = parseInt(quantitySpan.innerText);
    if (currentQuantity > 1) {
        quantitySpan.innerText = currentQuantity - 1;
        updateTotalCost();
    }
}

document.querySelectorAll('.removeRowButton').forEach(button => {
    button.addEventListener('click', function() {
        var row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateTotalCost();
    });
});
</script>
@endsection
