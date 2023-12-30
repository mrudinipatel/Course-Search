$(document).ready(function() {
    let theme = localStorage.getItem('theme');
    if(theme === null) {
        const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        localStorage.setItem('theme', (isDark ? 'dark' : 'light'));
        theme = localStorage.getItem('theme');
    }
    let isDarkMode = (theme === 'dark' ? true : false);

    // Initialize toggle button text and body class
    $("#themeToggle")[0].innerHTML = (isDarkMode ? '☀️' : '🌚');
    if(isDarkMode) {
        $("body").addClass("dark");
        $("head").append('<meta name="color-scheme" content="dark">');
    } else {
        $("body").addClass("light");
    }

    // Toggle dark mode event listener
    $("#themeToggle").on("click", function() {
        if(isDarkMode) {
            localStorage.setItem('theme', 'light');
            isDarkMode = false;
            $("body").removeClass("dark").addClass("light");
            // remove dark mode meta tag
            $("meta[name='color-scheme']").remove();
        } else {
            localStorage.setItem('theme', 'dark');
            isDarkMode = true;
            $("body").removeClass("light").addClass("dark");
            $("head").append('<meta name="color-scheme" content="dark">');
        }

        $("#themeToggle")[0].innerHTML = (isDarkMode ? '☀️' : '🌚');
    });
});
