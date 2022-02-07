function createNode(node, attributes){
    const el = document.createElement(node);
    for(let key in attributes){
        el.setAttribute(key, attributes[key]);
    }
    return el;
}

yes.addEventListener("click", () => {
    const input = createNode("input", {
        name: "dateHour",
        type: "datetime-local",
        id : "dateHour"
    });
    radioContainer.append(input);
    window.scrollTo(0,document.body.scrollHeight);
})

no.addEventListener("click", () => {
    if(document.getElementById("dateHour") != null){
        dateHour.remove()
    }
})