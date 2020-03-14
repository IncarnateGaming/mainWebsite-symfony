class IncarnateColorTryer{
    /**
     * @param classs - the class of the html element(s) to edit
     * @param style - the css style to be changed such as "color" or "background-color"
     * @param label - a GUI label to let people know what that section is for
     * @param colors - an array of colors with names, see "defaultArray" for an example
     */
    static build(classs,style,label,colors){
        colors = colors || this.defaultArray();
        const newElement = document.createElement('div');
        newElement.innerHTML = `<h2>${label}</h2>`;
        colors.forEach(color=>{
            newElement.innerHTML += `<button class="btn m-2" data-style="${style}" data-color="${color.color}" data-class="${classs}" style="background-color:${color.color};">${color.name}</button>`;
        });
        const buttons = newElement.getElementsByTagName('button');
        [].forEach.call(buttons, button =>{
            button.addEventListener('click',IncarnateColorTryer.applyStyle);
        });
        document.getElementsByClassName('inc-body')[0].append(newElement);
    }
    static applyStyle(ev){
        console.log(ev,ev.target);
        const classs = ev.target.getAttribute('data-class');
        const color = ev.target.getAttribute('data-color');
        const style = ev.target.getAttribute('data-style');
        const classesArray = document.getElementsByClassName(classs);
        [].forEach.call(classesArray,element=>{
            element.style[style]=color;
        });
    }
    static defaultArray(){
        return [
            {name:"ldahners1",color:"#BDF2FE"},
            {name:"ldahners1-dark",color:"#526a6f"},
            {name:"ldahners2",color:"#00D0FF"},
            {name:"ldahners2-dark",color:"#00596d"},
            {name:"ldahners3",color:"#D4E5E5"},
            {name:"ldahners3-dark",color:"#616969"},
            {name:"ldahenrs4",color:"#ECFBFF"},
            {name:"ldahenrs4-dark",color:"#6e7577"},
            {name:"ldahners5",color:"#E1EDF0"},
            {name:"ldahners5-dark",color:"#6d7375"},
            {name:"ldahners6",color:"#A1ECFF"},
            {name:"ldahners6-dark",color:"#3e5c63"},
            {name:"ldahenrs7",color:"#FFE0A1"},
            {name:"ldahenrs7-dark",color:"#726549"},
            {name:"inc8",color:"#0092b3"},
            {name:"inc9",color:"#143C0E"},
            {name:"black",color:"black"},
            {name:"white",color:"white"}
        ]
    }
}