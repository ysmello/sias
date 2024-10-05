function carregarPagina(event, page) {
    event.preventDefault(); 
    fetch(page, { method: 'POST' })
    .then(response => response.text())
    .then(data => {
        document.getElementById('login').innerHTML = data;
    })
    .catch(error => console.error('Erro:', error));
}
