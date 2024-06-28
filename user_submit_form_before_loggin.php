<form action="#" class="form" id="forms" onsubmit="event.preventDefault()">
      
    
      <div class="progressbar">
        <div class="progress" id="progress"></div>
        
        <div
          class="progress-step progress-step-active"
          data-title="Account"
        ></div>
        
        <div class="progress-step" data-title="Social"></div>
        <div class="progress-step" data-title="Personal"></div>
      </div>
      <div class="step-forms step-forms-active">
        <div class="group-inputs">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" />
        </div>
        <div class="group-inputs">
          <label for="position">Email</label>
          <input type="text" name="position" id="position" />
        </div>
        <div class="group-inputs">
          <label for="email">Password</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="group-inputs">
          <label for="email">Confirm password</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="">
          <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
        </div>
      </div>
      <div class="step-forms">
        <div class="group-inputs">
          <label for="phone">Facebook</label>
          <input type="text" name="phone" id="phone" />
        </div>
        <div class="group-inputs">
          <label for="email">Twitter</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="group-inputs">
          <label for="email">Linkedin</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="group-inputs">
          <label for="email">Dribbble</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>
      <div class="step-forms">
        <div class="group-inputs">
          <label for="dob">Date of Birth</label>
          <input type="date" name="dob" id="dob" />
        </div>
        <div class="group-inputs">
          <label for="ID">National ID</label>
          <input type="number" name="ID" id="ID" />
        </div>

        <div class="group-inputs">
          <label for="ID">Account Number</label>
          <input type="number" name="ID" id="ID" />
        </div>

        <div class="group-inputs">
          <label for="ID">Swift Code</label>
          <input type="text" name="ID" id="ID" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <input type="submit" value="Submit" id="submit-form" class="btn"/>
        </div>
      </div>
    </form>


    <style>
        :root{--primary-color: rgb(11, 78, 179)}*, *::before, *::after{box-sizing: border-box}body{font-family: Montserrat, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;margin: 0;display: grid;place-items: center;min-height: 100vh;background-color: #0b4eb3}label{display: block;margin-bottom: 0.5rem}input{display: block;width: 100%;padding: 0.75rem;border: 1px solid #ccc;border-radius: 0.25rem;height: 50px}.width-50{width: 50%}.ml-auto{margin-left: auto}.text-center{text-align: center}.progressbar{position: relative;display: flex;justify-content: space-between;counter-reset: step;margin: 2rem 0 4rem}.progressbar::before, .progress{content: "";position: absolute;top: 50%;transform: translateY(-50%);height: 4px;width: 100%;background-color: #dcdcdc;z-index: 1}.progress{background-color: rgb(0 128 0);width: 0%;transition: 0.3s}.progress-step{width: 2.1875rem;height: 2.1875rem;background-color: #dcdcdc;border-radius: 50%;display: flex;justify-content: center;align-items: center;z-index: 1}.progress-step::before{counter-increment: step;content: counter(step)}.progress-step::after{content: attr(data-title);position: absolute;top: calc(100% + 0.5rem);font-size: 0.85rem;color: #666}.progress-step-active{background-color: var(--primary-color);color: #f3f3f3}.form{width: clamp(320px, 30%, 430px);margin: 0 auto;border: none;border-radius: 10px !important;overflow: hidden;padding: 1.5rem;background-color: #fff;padding: 20px 30px}.step-forms{display: none;transform-origin: top;animation: animate 1s}.step-forms-active{display: block}.group-inputs{margin: 1rem 0}@keyframes animate{from{transform: scale(1, 0);opacity: 0}to{transform: scale(1, 1);opacity: 1}}.btns-group{display: grid;grid-template-columns: repeat(2, 1fr);gap: 1.5rem}.btn{padding: 0.75rem;display: block;text-decoration: none;background-color: var(--primary-color);color: #f3f3f3;text-align: center;border-radius: 0.25rem;cursor: pointer;transition: 0.3s}.btn:hover{box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color)}.progress-step-check{position: relative;background-color: green !important;transition: all 0.8s}.progress-step-check::before{position: absolute;content: '\2713';width: 100%;height: 100%;top: 8px;left: 13px;font-size: 12px}.group-inputs{position: relative}.group-inputs label{font-size: 13px;position: absolute;height: 19px;padding: 4px 7px;top: -14px;left: 10px;color: #a2a2a2;background-color: white}.welcome{height: 450px;width: 350px;background-color: #fff;border-radius: 6px;display: flex;justify-content: center;align-items: center}.welcome .content{display: flex;align-items: center;flex-direction: column}.checkmark__circle{stroke-dasharray: 166;stroke-dashoffset: 166;stroke-width: 2;stroke-miterlimit: 10;stroke: #7ac142;fill: none;animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards}.checkmark{width: 56px;height: 56px;border-radius: 50%;display: block;stroke-width: 2;stroke: #fff;stroke-miterlimit: 10;margin: 10% auto;box-shadow: inset 0px 0px 0px #7ac142;animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both}.checkmark__check{transform-origin: 50% 50%;stroke-dasharray: 48;stroke-dashoffset: 48;animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards}@keyframes stroke{100%{stroke-dashoffset: 0}}@keyframes scale{0%, 100%{transform: none}50%{transform: scale3d(1.1, 1.1, 1)}}@keyframes fill{100%{box-shadow: inset 0px 0px 0px 30px #7ac142}}

    </style>



<script>
    const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".step-forms");
const progressSteps = document.querySelectorAll(".progress-step");


let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
   
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
    
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("step-forms-active") &&
      formStep.classList.remove("step-forms-active");
  });

  formSteps[formStepsNum].classList.add("step-forms-active");
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
      
    } else {
      progressStep.classList.remove("progress-step-active");
   
    }
  });

  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum) {
      
      progressStep.classList.add("progress-step-check");
    } else {
   
      progressStep.classList.remove("progress-step-check");
    }
  });
 
  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}


document.getElementById("submit-form").addEventListener("click", function () {

    progressSteps.forEach((progressStep, idx) => {
    if (idx <= formStepsNum) {
      
      progressStep.classList.add("progress-step-check");
    } else {
   
      progressStep.classList.remove("progress-step-check");
    }
  });
  
   var forms = document.getElementById("forms");
   forms.classList.remove("form");
   forms.innerHTML = '<div class="welcome"><div class="content"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg><h2>Thanks for signup!</h2><span>We will contact you soon!</span><div></div>';
});
</script>