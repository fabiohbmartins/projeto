
$(function(){

    // Carregar dados do select principal
    // --------------

    function loadSelectMainCategories()
    {
        var $selectMain = $('#selectMain');

        // Animação de carregamento

        WaitMe.start();

        // URL_BASE é a url absoluta do projeto

        $.getJSON(URL_BASE + '/mercado_livre/categories', function(categories)
        {
            $.each(categories, function(index, category)
            {
                // Popular o select

                $selectMain.append('<option value=' + category.id + '>' + category.name + '</option>');
            });

            // Terminar a animação de carregamento

            WaitMe.stop();
        });

        $selectMain.on('change', function()
        {
            // Obter o id da categoria selecionada

           var categoryId = $(this).val();

           // Criar e preencher o novo select para a sub-categoria

           loadSelectChildCategories(categoryId, 1);
        });
    }

    // Construir as sub-categorias a partir de uma selação
    // --------------

    function loadSelectChildCategories(categoryId, selectIndex)
    {
        // Inicia animação

        WaitMe.start();

        $.getJSON(URL_BASE + '/mercado_livre/categories/' + categoryId, function(categories)
        {
            // Limpar selects à frente no elemento

            dropSelects(selectIndex);

            if ($.isEmptyObject(categories.children_categories))
            {
                // Exibir o modal se a sub-categoria não possuir filhas

                $('#modalEndOfSubcategories').modal('show');
            }
            else
            {
                // Criar o elemento <select>

                var selectBoxHtml =
                    '<div class="col-md-3 select-box">' +
                    '    <div class="form-group">' +
                    '        <label>Sub-Categoria ('+ selectIndex +'):</label>' +
                    '        <select class="form-control" data-index="'+ selectIndex +'">' +
                    '           <option value="">Selecione</option>' +
                    '        </select>' +
                    '    </div>' +
                    '</div>';

                var $selectBox = $(selectBoxHtml);

                $selectBox.find('select').on('change', function()
                {
                    // Definir o evento on change para o <select> criado

                    var categoryId = $(this).val();
                    loadSelectChildCategories(categoryId, selectIndex + 1);
                });

                // Inserir o elemento na página

                $('#row-selects').last().append($selectBox);

                // Preencher o select com os dados da sub-categoria

                $.each(categories.children_categories, function(index, category)
                {
                    $selectBox.find('select').append('<option value=' + category.id + '>' + category.name + '</option>');
                });
            }

            // Parar animação

            WaitMe.stop();
        });
    }

    // Destruir selects que não serão utilizados
    // --------------

    function dropSelects(indexSelect)
    {
        $('#row-selects select').each(function (index)
        {
            if (indexSelect <= ($(this).data('index')))
            {
                // remover o select junto com a div .select-box
                $(this).parent().parent().remove();
            }
        });
    }

    // Carregar o select principal ao iniciar
    // --------------

    loadSelectMainCategories();
});

// Plugin WaitMe
// --------------

var WaitMe = {
    /**
     * @param message
     * @param time [ EM MILISEGUNDOS ]
     * @param effect [ none, bounce, rotateplane, stretch, orbit, roundBounce, win8, win8_linear, ios ]
     */
    start: function(message, time, effect) {

        if (message === undefined) {
            message = 'Carregando...';
        }

        if (time === undefined) {
            time = -1; // -1 infinito
        }

        if (effect === undefined) {
            effect = 'win8_linear';
        }

        $('body').waitMe({
            effect : effect,
            text : message,
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            waitTime: time
        });
    },
    stop: function() {

        $('body').waitMe('hide');
    }
};