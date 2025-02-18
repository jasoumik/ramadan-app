document.addEventListener("DOMContentLoaded", function () {
    const toggleTheme = document.getElementById("toggle-theme");
    if (!toggleTheme) {
        console.error("Toggle switch not found!");
        return;
    }

    // Check local storage for theme preference
    let theme = localStorage.getItem("theme") || "light";
    if (theme === "dark") {
        document.documentElement.classList.add("dark");
        toggleTheme.checked = true;
    }

    // Toggle dark mode on switch change
    toggleTheme.addEventListener("change", function () {
        if (this.checked) {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        }
    });
});
