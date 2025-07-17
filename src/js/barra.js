const button = document.getElementById('button');
const bar = document.getElementById('progressBar');
const container = document.getElementById('progressContainer');
const status = document.getElementById('status');

button.addEventListener('submit', function(e) {
    e.preventDefault();
    const url = document.getElementById('url').value;
    container.style.display = 'block';
    bar.style.width = '0%'; 
    bar.textContent = '0%';
    status.textContent = 'Iniciando...';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'processa.php');

    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
        const pct = Math.round((e.loaded / e.total) * 100);
        bar.style.width = pct + '%';
        bar.textContent = pct + '%';
        }
    });

    xhr.onload = () => {
        if (xhr.status === 200) {
        bar.style.width = '100%'; bar.textContent = '100%';
        status.textContent = 'Concluído!';
        } else {
        status.textContent = 'Erro: ' + xhr.status;
        }
    };

    const formData = new FormData();
    formData.append('url', url);
    xhr.send(formData);
});