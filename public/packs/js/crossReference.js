const crossReferences = document.getElementsByClassName('crossReference');
[].forEach.call(crossReferences,reference=>{
    reference.addEventListener('click',IncarnateReference.crossReference);
});
