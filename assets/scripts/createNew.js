const formForAddingVariants = document.querySelector('.newVariants');
const addVariant = document.querySelector('.addVariant');
const counterDiv = document.querySelector('.variantCounter');

var variantIndex = 2;
addVariant.addEventListener('click', ()=>{
    if(variantIndex >= 11) return;
    formForAddingVariants.innerHTML += "<div class = \"newVariant\"><label for=\"newTitle" + variantIndex + "\" class = \"inputLabels\">Название варианта</label><input type=\"text\" class = \"newVariantTitle\" name = \"newTitle" + variantIndex + "\" style =\"display:block\"><label for=\"newDescription" + variantIndex + "\" class = \"inputLabels\">Описание</label><input type=\"text\" class = \"newVariantDescription\" name = \"newDescription" + variantIndex + "\" style = \"display:block\"><br></div>";
    counterDiv.innerHTML = variantIndex + "/10";
    variantIndex += 1;
});