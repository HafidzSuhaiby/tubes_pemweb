// Multi-step form Daftar Jasa

document.addEventListener('DOMContentLoaded', () => {
    const stepButtons = document.querySelectorAll('.dj-step-btn');
    const panels      = document.querySelectorAll('.dj-step-panel');
    const nextButtons = document.querySelectorAll('.dj-next');
    const prevButtons = document.querySelectorAll('.dj-prev');

    if (!panels.length) return;

    let currentStep = 0;

    function setStep(index) {
        if (index < 0 || index >= panels.length) return;

        currentStep = index;

        // tampilkan hanya panel aktif
        panels.forEach((panel, i) => {
            panel.classList.toggle('active', i === currentStep);
        });

        // update tombol sidebar aktif
        stepButtons.forEach((btn, i) => {
            btn.classList.toggle('active', i === currentStep);
        });

        // handle tombol BACK di step 0
        const backBtn = panels[currentStep].querySelector('.dj-prev');
        if (backBtn) {
            backBtn.disabled = currentStep === 0;
        }
    }

    // klik sidebar
    stepButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = parseInt(btn.dataset.stepBtn, 10);
            setStep(target);
        });
    });

    // NEXT
    nextButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (currentStep < panels.length - 1) {
                setStep(currentStep + 1);
            }
        });
    });

    // BACK
    prevButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (currentStep > 0) {
                setStep(currentStep - 1);
            }
        });
    });

    // set awal
    setStep(0);
});
