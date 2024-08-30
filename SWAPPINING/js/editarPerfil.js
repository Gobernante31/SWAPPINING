document.addEventListener("DOMContentLoaded", function() {
    const profileButton = document.getElementById("profile-button");
    const profileMenu = document.getElementById("profile-menu");
    const logoutButton = document.getElementById("logout-button");
    const editProfileButton = document.getElementById("edit-profile-button");

    profileButton.addEventListener("click", function(event) {
        event.stopPropagation(); // Evita que el clic llegue al documento
        profileMenu.style.display = profileMenu.style.display === "block" ? "none" : "block";
    });

  
});
