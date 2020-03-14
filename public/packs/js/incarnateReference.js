class IncarnateReference{
    static incarnateDelay(ms){
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    static getClosestClass (elem,targetClass){
        while (elem.classList.contains(targetClass) === false && elem.classList.contains("inc-top-html") === false){
            elem = elem.parentElement;
        }
        var result = false;
        if (elem.classList.contains(targetClass)) result = elem;
        return result;
    }
    static crossReference(event){
        if (IncarnateCrossReferenceOveride !== undefined){
            window.location.href = IncarnateCrossReferenceOveride;
            return false;
        }
        console.log(event);
        const parent = event.target.getAttribute('data-fidparent');
        const reference = event.target.getAttribute('data-fid');
        console.log(reference);
        const crossReference = (parent !== null && parent !== "") ? parent+'#' + reference : reference;
        window.location.href = '/content/fid/'+crossReference;
        return true;
    }
}
