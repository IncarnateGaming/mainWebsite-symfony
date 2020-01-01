const generates = document.getElementsByClassName('generate');
[].forEach.call(generates, generate=>{
    generate.addEventListener('click',IncarnateReference.crossReference);
    if (generate.getAttribute('data-quantity')){
        const textContent = '[' + generate.getAttribute('data-quantity') + 'x] ';
        const quantity = document.createTextNode(textContent);
        generate.parentElement.insertBefore(quantity,generate);
    }
});
