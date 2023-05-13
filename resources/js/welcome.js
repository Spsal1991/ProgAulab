import { Splide } from "@splidejs/splide";
import { AutoScroll } from "@splidejs/splide-extension-auto-scroll";

document.addEventListener("DOMContentLoaded", function () {
    let settings = {
        type: "loop",
        perPage: 6,
        perMove: 1,
        pagination: false,
        arrows: false,
        rewind: true,
        pauseOnHover: true,
        gap: 10,
        autoScroll: {
            speed: 0.7,
        },
        breakpoints: {
            767: {
                perPage: 2,
                speed: 800,
            },
        },
    };

    let settingsThumbnails = {
        rewind: true,
        type: "loop",
        gap: 24,
        arrows: false,
        fixedWidth: 250,
        pagination: false,
        autoScroll: {
            speed: 0.4,
        },
    };
    let detailsSettings = {
        type: "fade",
        heightRatio: 0.6,
        pagination: true,
        // perPage: 1,
        // gap: 24,
        // arrows: true,
        // fixedHeight: 400,
        cover: true,
        // fixedWidth: 250,
        // pagination: false,
    };
    let detailsSettingsThumb = {
        // type: "fade",
        // heightRatio: 0.6,
        // pagination: true,
        rewind: true,
        fixedWidth: 104,
        fixedHeight: 58,
        isNavigation: true,
        gap: 10,
        focus: "center",
        pagination: false,
        cover: true,
        // perPage: 1,
        // gap: 24,
        // arrows: true,
        // fixedHeight: 400,
        // cover: true,
        // fixedWidth: 250,
        // pagination: false,
    };

    var elms = document.getElementsByClassName("splide-slide");
    var thumbnails = document.getElementsByClassName("splide-thumbnails");

    var detailsImg = document.getElementsByClassName("detailsImg");
    var detailsImgThumb = document.getElementsByClassName("detailsImgThumb");
    for (var i = 0; i < elms.length; i++) {
        new Splide(elms[i], settings).mount({ AutoScroll });
    }
    for (var i = 0; i < thumbnails.length; i++) {
        new Splide(thumbnails[i], settingsThumbnails).mount({ AutoScroll });
    }

    for (var i = 0; i < detailsImg.length; i++) {
        const main = new Splide(detailsImg[i], detailsSettings);
        const thumb = new Splide(detailsImgThumb[i], detailsSettingsThumb);
        main.sync(thumb);
        main.mount();
        thumb.mount();
    }
});

const searchElement = document.querySelector("#ricerca");
const hideElement = document.querySelector("#sparisce");
if (searchElement) {
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.target.id === "ricerca" && entry.isIntersecting) {
                hideElement.classList.add("d-none");
            } else {
                hideElement.classList.remove("d-none");
            }
        });
    });

    observer.observe(searchElement);
}
