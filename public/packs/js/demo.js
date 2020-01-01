var tempID = randomNumber(1000000,9999999);
var tables = {};
var templates = {};
fetch('/packs/json/incarnateTables.json')
    .then(tableRes=>{
        tableRes.json().then(result=>{
           tables = result;
        });
    });
fetch('/packs/json/incarnateTemplates.json')
    .then(tempRes=>{
        tempRes.json().then(result=>{
            templates = result;
            addDropDown();
        });
    });
var rollCount = 0;
function randomNumber(min,max){
    difference = max-min;
    return Math.floor(difference*Math.random()+min);
}
function rollTable(tableID){
    var random = Math.random(); //random number from 0-1
    rollCount++;
    const table = tables.find(i=>i._id===tableID);
    if(!table)console.warn('Table: "'+tableID+'" not found.');
    var highNumber = 0;
    var lowNumber = 100000000000;
    table.data.row.forEach(row=>{
        if(row.from<lowNumber)lowNumber=row.from;
        if(row.to>highNumber)highNumber=row.to;
    });
    const range = highNumber-lowNumber;
    const goal = range*random + lowNumber;
    const rowLen = table.data.row.length;
    for(var a=0;a<rowLen;a++){
        if(table.data.row[a].to>=goal){
            result = table.data.row[a].column[0].content;
            result = result.replace(/^<p>/,'');
            result = result.replace(/<\/p>\n$/,'');
            return result;
        }
    }
//
};
function generate(){
    var data = document.getElementsByClassName("template");
    var found;
    if(data.length === 0){
        templateInsert();
        data = document.getElementsByClassName('template');
    }
    var dataLength=data.length;
    var regex = /<p>/g;
    var regexStart = /^<p>/;
    var regexEnd = /<\/p>/;
    for (a=0;a<dataLength;a++){
        do {
            found = false;
            var generateNodes = data[a].getElementsByClassName("generate");//var pattern = /[a-zA-Z]{6}/gmi;
            //var recal = pattern.exec(data[a]);
            var genNodeLen = generateNodes.length;
//						console.log(generateNodes);
            for (b=0;b<genNodeLen;b++){
//						console.log(generateNodes[b]);
                if (generateNodes[b].hasAttribute("date")){
                }
                else{
                    var nodeQuantity;
                    if (generateNodes[b].getAttribute("data-quantity")!=null){
                        nodeQuantity = generateNodes[b].getAttribute("data-quantity");
//									console.log(nodeQuantity);
                        nodeQuantity = incarnateRoll(nodeQuantity);
//									console.log(nodeQuantity);
                    }else{
                        nodeQuantity = 1;
                    }
                    found = true;
                    var fid=generateNodes[b].getAttribute("data-fid")
//								console.log(fid);
                    var result ="";
                    for (e=0;e<nodeQuantity;e++){
                        var preresult = rollTable(fid);
                        //								console.log(preresult);
                        //								console.log(preresult.match(regex).length);
                        // if (preresult.match(regex).length==1){
                        //     preresult = preresult.replace(regexStart,"");
                        //     preresult = preresult.replace(regexEnd,"");
                        //     //									console.log("After Cropping: "+preresult);
                        // }
                        result = result + preresult;
                    }
                    generateNodes[b].innerHTML = result;
                    generateNodes[b].setAttribute("date",new Date());
                }
            }
//						console.log(generateNodes);
        }
        while (found === true);
        do {
            found = false;
            var calcNodes = data[a].getElementsByTagName("calculate");
            var calcNodeLen = calcNodes.length;
            for (f=0;f<calcNodeLen;f++){
                if (calcNodes[f].hasAttribute("date")){
                }
                else {
                    calcNodes[f].innerHTML=incarnateRoll(calcNodes[f].innerHTML);
                    calcNodes[f].setAttribute("date",new Date());
                }
            }
        }
        while (found ===true);
        do {
            found = false;
            var genLinkNodes = data[a].getElementsByClassName("genLink");
            var genLinkNodesLen = genLinkNodes.length;
            for (c=0;c<genLinkNodesLen;c++){
                if (genLinkNodes[c].hasAttribute("date")){
                }
                else {
                    found = true;
                    var linkFid = genLinkNodes[c].getAttribute("data-fid");
                    result = "";
                    for (b=0;b<genNodeLen;b++){
                        if (linkFid == generateNodes[b].getAttribute("data-fid")){
                            result = result + generateNodes[b].innerHTML + " ";
                        }
                    }
                    genLinkNodes[c].innerHTML = result;
                    genLinkNodes[c].setAttribute("date",new Date());
                }
            }
        }
        while (found===true);
    }
    const crossReferences = document.getElementsByClassName('crossReference');
    [].forEach.call(crossReferences,reference=>{
        reference.addEventListener('click',IncarnateReference.crossReference);
    });
};
function incarnateRoll(dice) {
    var numDice = 0, sizeDice= 0, modType="", modifier= 0, calculation= 0;
    var fullPattern= /^[0-9]+d[0-9]+[\+\-]{1}[0-9]+$/;
    var fullPatternFind = dice.split(/[\-\+d]/);
    if (dice.search(fullPattern)==0) {
//				console.log("section 1");
        numDice = fullPatternFind[0];
        sizeDice = fullPatternFind[1];
        modifier = fullPatternFind[2];
        if (dice.search(/\-/)!=-1){
            modType="-";
        } else{
            modType="+";
        }
    } else if (dice.search(/^[0-9]+d[0-9]+$/)==0){
//				console.log("section 2");
        numDice = fullPatternFind[0];
        sizeDice = fullPatternFind[1];
    } else if (dice.search(/^[0-9]+[\+\-]{1}[0-9]+$/)==0){
//				console.log("section 3");
        calculation = fullPatternFind[0]*1;
        modifier = fullPatternFind[1];
        if (dice.search(/\-/)!=-1){
            modType="-";
        } else{
            modType="+";
        }
    } else if (dice.search(/^[0-9]+$/)==0){
//				console.log("section 4");
        calculation = fullPatternFind[0]*1;
    }
    for (d=0;d<numDice;d++){
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
function addDropDown (){
    var preSelect = document.getElementById("mySelect");
    var mySelect = preSelect.options[preSelect.selectedIndex].text;
    var select = document.getElementById("selectChoices");
    var selectLength = select.length;
    for (g=selectLength;g>-1;g--){
        select.remove(g);
    }
    for (var tempVar in templates){
        if (templates[tempVar].flags.templateType == mySelect){
            var option = document.createElement("option");
            var tempName= templates[tempVar].name;
            if (tempName.search(/<span/)!=-1){
                tempName = tempName.replace(/<span.*<\/span> ?\-? ?/,"")
            }
            option.text=tempName;
            option.value=tempVar;
            select.appendChild(option);
        }
    }
    return 0;
}
function getTemplate(fid){
    tempLen = templates.length;
    for (var a=0;a<tempLen;a++){
        if(templates[a]._id==fid){
            return templates[a];
        }
    }
}
function populate (){
//				console.log("running");
    var popData = document.getElementsByClassName("populate");
    var popLength = popData.length;
//				console.log(popLength);
    for (h=0; h<popLength; h++){
        if (popData[h].hasAttribute("date")){
        }
        else {
            // console.log(popData[h].getAttribute("data-fid"));
            template = getTemplate(popData[h].getAttribute("data-fid"))
            var popCycle;
            if (popData[h].getAttribute("data-quantity") != null) {
                popCycle = incarnateRoll(popCycle);
            }else{
                popCycle = 1;
            }
            popData[h].innerHTML = '';
            for (i=0; i<popCycle; i++){
                document.getElementById("Main").innerHTML += '<div class="template">\n<h2 id="id'+tempID +'">'+template.name+'</h2>' + template.data.description + "</div>\n";
                popData[h].innerHTML += '<a href="#id' + (tempID) + '">' + template.name + "</a> ";
                tempID=randomNumber(1000000,9999999);
            }
//						console.log(popCycle);
            popData[h].setAttribute("date",new Date());
            popData[h].setAttribute("id",tempID-1);
        }
    }
}
function templateInsert () {
    template = templates[document.getElementById("selectChoices").value];
    document.getElementById("Main").innerHTML += '<div class="template">\n<h2>' + template.name + '</h2>\n' + template.data.description + "</div>\n";
}
function clearContent(){
    document.getElementById("Main").innerHTML = '';
}
document.getElementById('insertTemplate').addEventListener('click',templateInsert);
document.getElementById('generate').addEventListener('click',generate);
document.getElementById('populate').addEventListener('click',populate);
document.getElementById('clearContent').addEventListener('click',clearContent);
