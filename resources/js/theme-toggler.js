window.updateTheme = function () {
    if (
        localStorage.getItem('theme') === 'dark'
        || (!('theme' in localStorage) && window.matchMedia('(prefers-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
};

window.updateTheme();
