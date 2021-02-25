"use strict";

const searchForm = document.querySelector("#search-form");
const searchTerm = document.querySelector("#search-term");
const movieList = document.querySelector("#movie-list");
const normalMessage = document.querySelector("#normal-message");
const notfoundMessage = document.querySelector("#notfound-message");
const currentNum = document.querySelector("#current-num");
const totalNum = document.querySelector("#total-num");
const movieCardClass = ["col-6", "col-md-4", "col-lg-3", "my-3"];

const baseURL = "https://api.themoviedb.org/3";
const api_key = "api_key=b105220b235a43810d9e1ba326c3b2e6";

const clearList = function () {
    movieList.innerHTML = "";
    notfoundMessage.style.display = "none";
    normalMessage.style.display = "block";
};

// const showError = function () {
//     const errorMessage = document.querySelector("#error-message");
//     normalMessage.style.visibility = "hidden";
//     errorMessage.style.visibility = "visible";
// };

const ajax = function (endpoint, callback) {
    const request = new XMLHttpRequest();
    const url = `${baseURL}${endpoint}`;
    request.open("GET", url);
    request.send();
    request.addEventListener("load", callback);
    // request.addEventListener("error", showError); //TODO: fix callback bug
    // request.addEventListener("abort", showError); //TODO: fix callback bug
};

const updateCards = function () {
    clearList();
    if (this.status === 200) {
        const data = JSON.parse(this.response);

        if (data.total_results === 0) {
            notfoundMessage.style.display = "block";
            normalMessage.style.display = "none";
            return;
        }

        currentNum.textContent = data.results.length;
        totalNum.textContent = data.total_results;

        data.results.forEach((element) => {
            const movieCard = document.createElement("div");
            movieCard.classList.add(...movieCardClass);

            let newOverview = element.overview;
            if (newOverview.length > 200) {
                newOverview = newOverview.slice(0, 200) + "...";
            }

            const cardContent = `
                <div class="card border-light text-center shadow-lg">
                    <div class="info-wrapper">
                        <img
                            src="${
                                element.poster_path
                                    ? "https://image.tmdb.org/t/p/w500" +
                                      element.poster_path
                                    : "./images/Image-Not-Available.png"
                            }"
                            class="card-img-top"
                            alt="${element.title} Not Available"
                        />
                        <div class="info">
                            <h5 class="card-title rating">
                                Rating: ${element.vote_average}
                            </h5>
                            <p class="card-text vote">
                                Voter Numbers: ${element.vote_count}
                            </p>
                            <p class="card-text overview">
                                ${newOverview}
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title movie-title">
                            ${element.original_title}
                        </h5>
                        <p class="card-text movie-date">
                            Release Date: ${element.release_date}
                        </p>
                    </div>
                </div>
            `;
            movieCard.innerHTML = cardContent;
            movieList.appendChild(movieCard);
        });
    }
};

ajax(`/movie/now_playing?${api_key}`, updateCards);

searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const term = searchTerm.value.trim();
    const toSearch = `/search/movie?${api_key}&query=${term}`;
    ajax(toSearch, updateCards);
});
