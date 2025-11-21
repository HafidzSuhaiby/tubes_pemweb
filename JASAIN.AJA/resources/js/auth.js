const wrapper = document.getElementById('authWrapper');
const btnGoToSignUp = document.getElementById('goToSignUp');
const btnGoToSignIn = document.getElementById('goToSignIn');

btnGoToSignUp.addEventListener('click', () => {
    wrapper.classList.add('sign-up-mode');
});

btnGoToSignIn.addEventListener('click', () => {
    wrapper.classList.remove('sign-up-mode');
});
