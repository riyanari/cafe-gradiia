// Navbar scroll effect
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

(function () {
    const norm = (p) => (p || "/").replace(/\/+$/, "") || "/";
    const current = norm(location.pathname);

    // Hanya link internal (mulai dengan "/")
    document
        .querySelectorAll('.navbar .nav-link[href^="/"]')
        .forEach((link) => {
            const linkPath = norm(
                new URL(link.getAttribute("href"), location.origin).pathname
            );
            const isHome = linkPath === "/";

            // match: sama persis ATAU current diawali linkPath + "/" (batas path)
            const match =
                (isHome && current === "/") ||
                (!isHome &&
                    (current === linkPath ||
                        current.startsWith(linkPath + "/")));

            link.classList.toggle("active", match);
            if (match) link.setAttribute("aria-current", "page");
        });
})();

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href");
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 70,
                behavior: "smooth",
            });

            // Update active nav link
            document.querySelectorAll(".nav-link").forEach((link) => {
                link.classList.remove("active");
            });
            this.classList.add("active");
        }
    });
});

// Animation on scroll
function animateOnScroll() {
    const elements = document.querySelectorAll(".animate__animated");

    elements.forEach((element) => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;

        if (elementPosition < screenPosition) {
            const animationClass = element.classList[1];
            element.classList.add(animationClass);
        }
    });
}

window.addEventListener("scroll", animateOnScroll);
window.addEventListener("load", animateOnScroll);
