const themeToggle = document.getElementById('themeToggle');
const themeLink = document.getElementById('themeLink');

// Carregar o tema salvo no Local Storage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    themeLink.href = savedTheme;
}

// Alternar tema ao clicar no botão
themeToggle.addEventListener('click', () => {const currentTheme = themeLink.href.includes('united') ?
    'https://bootswatch.com/5/darkly/bootstrap.min.css' :
    'https://bootswatch.com/5/united/bootstrap.min.css';

    themeLink.href = currentTheme;

    // Salvar o tema no Local Storage
    localStorage.setItem('theme', currentTheme);
});
