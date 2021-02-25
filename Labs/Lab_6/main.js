"use strict";

const baseURL = "http://api.weatherbit.io/v2.0/current";
const key = "48f85b3bf9d04d9db7d7dc36a27dd534";

$.ajax({
    url: baseURL,
    data: {
        key: key,
        units: "I",
        city: "Los Angeles",
        state: "California",
        country: "US",
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
