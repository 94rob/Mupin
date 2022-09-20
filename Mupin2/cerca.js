let computers = document.getElementsByClassName("computer");
console.log(computers);
for (let computer in computers) {
    console.log(computer);
}

let periferiche = document.getElementsByClassName("periferica");
let riviste = document.getElementsByClassName("rivista");
let softwares = document.getElementsByClassName("software");
let libri = document.getElementsByClassName("libro");

let i = document.getElementById("modello-titolo-checkbox");

if (document.getElementById("ovunque-checkbox").checked = true) {

}
if (document.getElementById("computer-checkbox").checked) {
    i.classList.add("show");
    for (let computer in computers) {
        computer.classList.add("show");
    }
} else {
    for (let computer in computers) {
        computer.classList.remove("show");
    }
}
if (document.getElementById("periferica-checkbox").checked = true) {
    periferiche.forEach(classList.add("show"));
} else {
    periferiche.forEach(classList.remove("show"));
}
if (document.getElementById("rivista-checkbox").checked = true) {
    document.getElementsByClassName("rivista").classList.add("show");
} else {
    document.getElementsByClassName("rivista").classList.remove("show");
}
if (document.getElementById("software-checkbox").checked = true) {
    document.getElementsByClassName("software").classList.add("show");
} else {
    document.getElementsByClassName("software").classList.remove("show");
}
if (document.getElementById("libro-checkbox").checked = true) {
    document.getElementsByClassName("libro").classList.add("show");
} else {
    document.getElementsByClassName("libro").classList.remove("show");
}