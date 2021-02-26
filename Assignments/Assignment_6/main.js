"use strict";

const baseURL = "http://api.weatherbit.io/v2.0/current";
const key = "09b7908526da4d37845743665944abb5";

const defaultCity = {
    city: "Los Angeles",
    state: "California",
    country: "US",
};

$(document).ready(function () {
    if (localStorage.weatherCity) {
        const storedCity = JSON.parse(localStorage.weatherCity);
        $("#city").val(storedCity.city);
        getWeather(storedCity);
    } else {
        getWeather(defaultCity);
    }
});

const getWeather = function (cityInfo) {
    $.ajax({
        url: baseURL,
        data: {
            key: key,
            units: "I",
            city: cityInfo.city,
            state: cityInfo.state,
            country: cityInfo.country,
        },
        statusCode: {
            404: function () {
                alert("Weather not available");
            },
            400: function () {
                alert("Weather not available");
            },
        },
    }).done(function (results) {
        const [data] = results.data;
        $("#temperature").text(data.temp);
        $("#weather-description").text(data.weather.description);
        $("#apparent-tempareture").text(data.app_temp);
    });
    $("#weather-loading").hide();
    $("#weather").show();
};

$("#city").on("change", function () {
    $("#weather-loading").show();
    $("#weather").hide();
    const newCity = {
        city: $("#city").val(),
        state: $("option:selected").data("state"),
        country: $("option:selected").data("country"),
    };
    getWeather(newCity);
    localStorage.setItem("weatherCity", JSON.stringify(newCity));
});

$(".item").on("click", function () {
    $(this).toggleClass("item-text-crossed");
});
