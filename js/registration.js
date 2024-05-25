const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");
const submitBtn = document.querySelector(".btn-submit");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("form-step-active") &&
      formStep.classList.remove("form-step-active");
  });

  formSteps[formStepsNum].classList.add("form-step-active");

  if (formStepsNum === 0) {
    prevBtns.forEach((btn) => btn.style.display = "none");
    submitBtn.style.display = "none";
  } else {
    prevBtns.forEach((btn) => btn.style.display = "inline-block");
    submitBtn.style.display = "none";
  }

  if (formStepsNum === formSteps.length - 1) {
    nextBtns.forEach((btn) => btn.style.display = "none");
    submitBtn.style.display = "inline-block";
  } else {
    nextBtns.forEach((btn) => btn.style.display = "inline-block");
  }
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

updateFormSteps(); // Initialize form steps visibility