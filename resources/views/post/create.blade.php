<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Posts Com JavaScript</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <form id='formPost' class="form-control">
            @csrf
            <label for="title">Titulo</label><br>
            <input type="text" name="title" id="content" class="form-control"><br>

            <label for="content">Conteúdo</label><br>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea><br>
            
            <button type="button" onclick="inserirPost()" class="btn btn-success text-center">Postar</button>
        </form>
    </div>
    <script>
        function inserirPost()
        {
            // Limpar mensagens de erro anteriores
            $('#titleError').text('');
            $('#conteudoError').text('');

            var title = $('#title').val();
            var content = $('#content').val();
            if (!title || !content) {
                console.log('Por favor, preencha todos os campos.');
                return;
            }else{
            // Serializar dados do formulário
                var formData = $('#formPost').serialize();

                $.ajax({
                    url: '{{ route("store") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response.message);
                        //Limpar os campos após o sucesso, se necessário
                        $('#title').val('');
                        $('#content').val('');
                    },
                    error: function(error) {
                        if(error.status === 422) {
                            // Exibir mensagens de erro de validação do Laravel
                            var errors = error.response.JSON.errors;
                            if(errors.titulo){
                                $('#titluloError').text(errors.title[0]);
                            }
                            if(errors.titulo){
                                $('#conteudoError').text(errors.conteudo[0]);
                            }
                        }
                        else{
                            console.log(error);
                        }
                    }
                });
            }
        }
    </script>
    
</body>
</html>

