function myFunction() {
    let navBar = document.querySelector("#myLinks");
    let formDisplayDiv = document.querySelector("#formDisplayDiv");
    if (navBar.style.display === "block") {
        navBar.style.display = "none";
        formDisplayDiv.style.display = "none";
    } else {
        navBar.style.display = "block";
        
    }
}