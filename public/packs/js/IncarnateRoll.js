var rollCount = 0;
class IncarnateRoll{
    static incarnateRoll(dice) {
        var numDice = 0, sizeDice= 0, modType="", modifier= 0, calculation= 0;
        var fullPattern= /^[0-9]+d[0-9]+[\+\-]{1}[0-9]+$/;
        var fullPatternFind = dice.split(/[\-\+d]/);
        if (dice.search(fullPattern)==0) {
            numDice = fullPatternFind[0];
            sizeDice = fullPatternFind[1];
            modifier = fullPatternFind[2];
            if (dice.search(/\-/)!=-1){
                modType="-";
            } else{
                modType="+";
            }
        } else if (dice.search(/^[0-9]+d[0-9]+$/)==0){
            numDice = fullPatternFind[0];
            sizeDice = fullPatternFind[1];
        } else if (dice.search(/^[0-9]+[\+\-]{1}[0-9]+$/)==0){
            calculation = fullPatternFind[0]*1;
            modifier = fullPatternFind[1];
            if (dice.search(/\-/)!=-1){
                modType="-";
            } else{
                modType="+";
            }
        } else if (dice.search(/^[0-9]+$/)==0){
            calculation = fullPatternFind[0]*1;
        }
        for (var d=0;d<numDice;d++){
            calculation = calculation + Math.floor(Math.random()*sizeDice) + 1;
            rollCount++;
        }
        if (modType =="-"){
            modifier = modifier*-1;
        } else {
            modifier = modifier * 1;
        }
        calculation = calculation + modifier;
        return calculation;
    }
    static calcAlert(event){
        const roll = event.target.innerHTML;
        alert(IncarnateRoll.incarnateRoll(roll));
    }
}