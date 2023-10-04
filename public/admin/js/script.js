const toggler = document.querySelector(".toggle_title > .fa-bars");
const sidebar = document.querySelector(".sidebar");
const dashboard = document.querySelector(".dashboard");
const logoutBtn = document.querySelector(".logout-btn");
const logoutForm = document.querySelector(".logout-form");
const alerts = document.querySelectorAll(".cross");

toggler.addEventListener("click", () => {
    dashboard.classList.toggle("no-sidebar");
});

// logout functionality
logoutBtn.addEventListener("click", (e) => {
    e.preventDefault();
    logoutForm.submit();
});

alerts.forEach((e) => {
    e.addEventListener("click", () => {
        e.parentElement.style.display = "none";
    });
});
