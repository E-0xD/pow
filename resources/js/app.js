import Alpine from "alpinejs";

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
