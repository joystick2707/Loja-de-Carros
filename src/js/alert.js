function sucesso() {

    Swal.fire({
        title: 'Sucesso!',
        text: 'Usuário cadastrado com sucesso!',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

function erro(){

    Swal.fire({
        title: 'Erro!',
        text: 'Senhas diferentes!',
        icon: 'error',
        confirmButtonText: 'Tentar novamente'
    });

}
