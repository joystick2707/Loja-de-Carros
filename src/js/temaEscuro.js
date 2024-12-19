const themeToggle = document.getElementById('themeToggle');
const themeLink = document.getElementById('themeLink');

const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    themeLink.href = savedTheme;
}

themeToggle.addEventListener('click', () => {const currentTheme = themeLink.href.includes('united') ?
    'https://bootswatch.com/5/darkly/bootstrap.min.css' :
    'https://bootswatch.com/5/united/bootstrap.min.css';

    themeLink.href = currentTheme;

    localStorage.setItem('theme', currentTheme);
});
