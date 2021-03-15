// document.querySelector("#save-btn").addEventListener("click", function () {
//     localStorage.setItem("dog", "Fluffy");
// });

// document.querySelector("#get-btn").addEventListener("click", function () {
//     if (localStorage.dog) {
//         console.log(localStorage.dog);
//     }
// });

// document.querySelector("#link").setAttribute("href", "https://www.usc.edu");

// $("#link").attr("href", "https://www.usc.edu");

// // document.querySelector("#link").setAttribute("data-school", "USC");

// $("#link").attr("data-school", "USC");

function displayResults(response) {
    const result = JSON.parse(response);
    const container = document.querySelector("#pokemon-container");

    result.data.forEach((element) => {
        let types = "";
        element.types.forEach((e) => {
            types += ` ${e}`;
        });

        let newPokemon = document.createElement("div");
        newPokemon.innerHTML = `<strong>${element.id} ${element.name}${types}</strong>
            <img src=${element.image_url}>`;

        container.appendChild(newPokemon);
    });
}
