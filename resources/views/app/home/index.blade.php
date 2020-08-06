<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Projeto: Teste</title>

    <meta name="description" content="">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/plugins/waitMe/waitMe.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
<main role="main">

    <div class="jumbotron">
        <div class="container">
            <h5>Arquitetura Hexagonal</h5>
        </div>
    </div>

    <div class="container">
        <div class="row" id="row-selects">
            <div class="col-md-3 select-box">
                <div class="form-group">
                    <label for="selectMain">Categorias Principais:</label>
                    <select class="form-control" id="selectMain" data-index="0">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</main>

<div class="modal fade" tabindex="-1" role="dialog" id="modalEndOfSubcategories">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>A sub-categoria selecionada é a última.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/plugins/waitMe/waitMe.js"></script>

<script>
    var URL_BASE = '{{{ url("") }}}';
</script>

<script src="assets/js/main.js"></script>

</body>
</html>