const modalBtns = document.querySelectorAll(".openModalBtn");
const modal = document.getElementById("formModal");
const modalExitBtn = document.getElementById("modal-exit-btn");

openModal = (evt) => {
    let btn = evt.currentTarget;

    document.getElementById("reportform-task_id").value = btn.getAttribute('data-task-id');
    modal.classList.add("show");
}

init = () => {
    modalBtns.forEach(btn => {
        btn.addEventListener("click", openModal, false);
    });
    
    modalExitBtn.addEventListener("click", function(){
        modal.classList.remove("show");
    });

}

window.onload = () => {
    init();
}
