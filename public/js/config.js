function showLoader() {
    document.getElementById('loader').classList.remove('d-none')
}
function hideLoader() {
    document.getElementById('loader').classList.add('d-none')
}

// function hideLoader() {
//     const loader = document.getElementById('loader');
//     if (loader) {
//         console.log("Before:", loader.className);
//         loader.classList.add('d-none');
//         console.log("After:", loader.className);
//     } else {
//         console.error("Loader element not found.");
//     }
// }



function successToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "green",
        }
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "red",
        }
    }).showToast();
}
