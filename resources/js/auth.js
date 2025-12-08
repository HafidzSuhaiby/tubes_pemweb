const wrapper = document.getElementById('authWrapper');
const btnGoToSignUp = document.getElementById('goToSignUp');
const btnGoToSignIn = document.getElementById('goToSignIn');
const toggleButtons = document.querySelectorAll('.toggle-password');

btnGoToSignUp.addEventListener('click', () => {
    wrapper.classList.add('sign-up-mode');
});

btnGoToSignIn.addEventListener('click', () => {
    wrapper.classList.remove('sign-up-mode');
});

toggleButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
        const targetId = btn.dataset.target;
        const input = document.getElementById(targetId);
        if (!input) return;

        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';

        // Tambah / hapus class untuk ganti icon
        if (isPassword) {
            btn.classList.add('is-showing');
        } else {
            btn.classList.remove('is-showing');
        }
    });
});

