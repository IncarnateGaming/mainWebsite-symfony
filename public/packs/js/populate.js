const populates = document.getElementsByClassName('populate');
[].forEach.call(populates, populate=>{
    populate.addEventListener('click',IncarnateReference.crossReference);
    if (populate.getAttribute('data-quantity')){
        const textContent = '[' + populate.getAttribute('data-quantity') + 'x] ';
        const quantity = document.createTextNode(textContent);
        populate.parentElement.insertBefore(quantity,populate);
    }
});
