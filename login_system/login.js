document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("loginForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch("login.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                sessionStorage.setItem("userLoggedIn", "true");
                window.location.href = data.redirect;
            } else {
                alert(data.message || "Invalid email or password");
            }
        })
        .catch(error => {
            console.error("Error during login:", error);
            alert("Something went wrong!");
        });
    });
});
