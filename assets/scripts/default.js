modalWindowProducts = document.querySelector('#modalWindowProducts');
modalWindowRegister = document.querySelector('#modalWindowRegistry');
modalWindowAuth = document.querySelector('#modalWindowAuth');
btnRegisterOpen = document.querySelector('.register');
btnAuthOpen = document.querySelector('.auth');
btnProductsOpen = document.querySelector('.products');

btnRegisterOpen.addEventListener('click', ()=>{
    modalWindowAuth.style.display = 'none';
    modalWindowProducts.style.display = 'none';
    modalWindowRegister.style.display = 'block';
})

btnAuthOpen.addEventListener('click', ()=>{
    modalWindowRegister.style.display = 'none';
    modalWindowProducts.style.display = 'none';
    modalWindowAuth.style.display = 'block';
})

btnProductsOpen.addEventListener('click', ()=>{
    modalWindowAuth.style.display = 'none';
    modalWindowRegister.style.display = 'none';
    modalWindowProducts.style.display = 'block';
})
