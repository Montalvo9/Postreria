function setPeriod(periodo, element) {
    /**Quitamos la clase active, la clase activa es la que resaltar el elemento en el que estamos */
    document.querySelectorAll(".date-btn").forEach(btn => {
        btn.classList.remove('active');
    });
    if (element.tagName === "BUTTON") {
        element.classList.add("active");
    }

    let fecha = null;

    if (periodo === "custom") {
        fecha = element.value;
        console.log("La fecha que seleciono es", fecha)


    }




}