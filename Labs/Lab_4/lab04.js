"use strict";

const mainImage = document.querySelector("#main-img");
const thumbnailWrapper = document.querySelector("#thumbnail-wrapper");

thumbnailWrapper.addEventListener("click", (e) => {
    if (e.target.tagName === "IMG") {
        const imageSrc = e.target.getAttribute("src");
        const imageAlt = e.target.getAttribute("alt");

        Array.from(thumbnailWrapper.children).forEach((element) => {
            element.style.opacity = 0.6;
            element.style.borderColor = "#000000";
        });
        e.target.parentNode.style.opacity = 1;
        e.target.parentNode.style.borderColor = "#F00000";

        mainImage.setAttribute("src", imageSrc);
        mainImage.setAttribute("alt", imageAlt);
        mainImage.nextElementSibling.textContent = imageAlt;
    }
});
