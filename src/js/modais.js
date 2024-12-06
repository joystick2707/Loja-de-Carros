document.addEventListener('DOMContentLoaded', function() {
    // Modal de Edição
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const email = this.getAttribute('data-email');

            document.getElementById('idEditar').value = id;
            document.getElementById('nomeEditar').value = nome;
            document.getElementById('emailEditar').value = email;

            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    });

    // Modal de Exclusão
    document.querySelectorAll('.btn-excluir').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById('idExcluir').value = id;
            new bootstrap.Modal(document.getElementById('modalExcluir')).show();
        });
    });
});
