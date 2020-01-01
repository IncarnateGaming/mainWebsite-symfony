const calculates = document.getElementsByClassName('calculate');
[].forEach.call(calculates, calculate=>{
    calculate.addEventListener('click',IncarnateRoll.calcAlert);
});