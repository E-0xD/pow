import Alpine from "alpinejs";
import "flowbite";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("alpine:init", () => {
    Alpine.data("tags", () => ({
        tags: [],
        newTag: "",
        addTag() {
            if (this.newTag.trim() !== "" && !this.tags.includes(this.newTag)) {
                this.tags.push(this.newTag.trim());
                this.newTag = "";
            }
        },
        removeTag(tag) {
            this.tags = this.tags.filter((t) => t !== tag);
        },
    }));
});

window.maskDate = function (input, mode) {
    let v = input.value.replace(/\D/g, "");

    if (mode === "single") {
        if (v.length > 8) v = v.slice(0, 8);
        if (v.length >= 5)
            input.value = v.replace(/(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
        else if (v.length >= 3)
            input.value = v.replace(/(\d{2})(\d{0,2})/, "$1/$2");
        else input.value = v;
    }

    if (mode === "month") {
        if (v.length > 6) v = v.slice(0, 6);
        if (v.length >= 3) input.value = v.replace(/(\d{2})(\d{0,4})/, "$1/$2");
        else input.value = v;
    }

    if (mode === "range") {
        if (v.length > 16) v = v.slice(0, 16);

        if (v.length >= 13) {
            // Second date has day, month, and year
            input.value = v.replace(
                /(\d{2})(\d{2})(\d{4})(\d{2})(\d{2})(\d{0,4})/,
                "$1/$2/$3 - $4/$5/$6"
            );
        } else if (v.length >= 11) {
            // Second date has day and month
            input.value = v.replace(
                /(\d{2})(\d{2})(\d{4})(\d{2})(\d{0,2})/,
                "$1/$2/$3 - $4/$5"
            );
        } else if (v.length >= 9) {
            // Second date has at least day
            input.value = v.replace(
                /(\d{2})(\d{2})(\d{4})(\d{0,2})/,
                "$1/$2/$3 - $4"
            );
        } else if (v.length >= 5) {
            // First date formatting
            input.value = v.replace(/(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
        } else if (v.length >= 3) {
            input.value = v.replace(/(\d{2})(\d{0,2})/, "$1/$2");
        } else {
            input.value = v;
        }
    }

    if (mode === "month-range") {
        if (v.length > 12) v = v.slice(0, 12);

        if (v.length >= 9) {
            // Second month has month and year
            input.value = v.replace(
                /(\d{2})(\d{4})(\d{2})(\d{0,4})/,
                "$1/$2 - $3/$4"
            );
        } else if (v.length >= 7) {
            // Second month has at least month
            input.value = v.replace(/(\d{2})(\d{4})(\d{0,2})/, "$1/$2 - $3");
        } else if (v.length >= 3) {
            // First month formatting
            input.value = v.replace(/(\d{2})(\d{0,4})/, "$1/$2");
        } else {
            input.value = v;
        }
    }
};
