document.addEventListener('DOMContentLoaded', function () {
    // Reference to stepper count div
    const stepper = document.getElementById('stepper-count');

    function updateStep(step) {
        // Hide all steps
        document.querySelectorAll('.step').forEach(function (element) {
            element.classList.add('hidden');
        });

        // Show the next step
        const nextStepDiv = document.querySelector(`[data-idstep="${step}"]`);
        if (nextStepDiv) {
            nextStepDiv.classList.remove('hidden');
        }

        // Update header div background color
        document.querySelectorAll('.div-header-step').forEach(function (element) {
            let step_header = parseInt(element.dataset.step);
            if (step_header <= step) {
                element.classList.add('bg-blue-500');
                element.classList.remove('bg-gray-700');
            } else {
                element.classList.remove('bg-blue-500');
                element.classList.add('bg-gray-700');
            }
        });

        // Update header text color
        document.querySelectorAll('.p-header-step').forEach(function (element) {
            let step_header = parseInt(element.dataset.step);
            if (step_header <= step) {
                element.classList.add('text-gray-300');
                element.classList.remove('text-gray-500');
            } else {
                element.classList.remove('text-gray-300');
                element.classList.add('text-gray-500');
            }
        });

        // Update stepper count and data-step attribute
        stepper.setAttribute('data-step', step);
    }

    // Attach event listeners to all buttons with the class 'back-step'
    document.querySelectorAll('.back-step').forEach(function (button) {
        button.addEventListener('click', function () {
            const currentStep = parseInt(stepper.getAttribute('data-step'), 10);
            if (currentStep > 1) {
                updateStep(currentStep - 1);
            }
        });
    });

    // Attach event listeners to all buttons with the class 'next-step'
    document.querySelectorAll('.next-step').forEach(function (button) {
        button.addEventListener('click', function () {
            const currentStep = parseInt(stepper.getAttribute('data-step'), 10);
            const maxStep = 3; // You can set this to the maximum step number
            if (currentStep < maxStep) {
                updateStep(currentStep + 1);
            }
        });
    });

    // Initialize by showing the first step based on the initial data-step value
    updateStep(stepper.getAttribute('data-step'));
});
