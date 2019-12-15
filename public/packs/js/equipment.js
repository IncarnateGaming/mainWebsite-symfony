const tableName = 'equipmentTable';
const tableBody = 'inc-table-main-body'
const tableColumn = 'inc-main-table-column';
const tableRow = 'inc-table-main-row';
const dataValue = 'data-value';
class IncarnateEquipment {
    static setupListeners() {
        let checkboxes = document.getElementsByClassName('inc-column-toggle');
        [].forEach.call(checkboxes, check => {
            check.addEventListener('change', IncarnateEquipment.showHideColumn)
        });
        let table = document.getElementById(tableName);
        let headerRows = table.getElementsByTagName('thead')[0].getElementsByTagName('th');
        [].forEach.call(headerRows,th=>{
            th.addEventListener('click',IncarnateEquipment.sortColumn2);
        })
    }
    static sortColumn2(ev){
        if(IncarnateSortRunning === true){
            console.log('sort already running');
            return false;
        }
        const column = Number(ev.currentTarget.getAttribute('name'));
        const columnType = ev.currentTarget.getAttribute('data-type');
        var direction = ev.currentTarget.getAttribute('data-direction');
        if(direction === undefined){
            ev.currentTarget.setAttribute('data-direction','ascending');
            direction = 'ascending';
        }else if (direction === 'ascending'){
            ev.currentTarget.setAttribute('data-direction','descending');
            direction = 'descending';
        }else{
            ev.currentTarget.setAttribute('data-direction','ascending');
            direction = 'ascending';
        }
        IncarnateSortRunning = true;
        const table = document.getElementById(tableName);
        const body = document.getElementById(tableBody);
        var rows = Array.from(body.getElementsByClassName(tableRow));
        // var startArray = [];
        // [].forEach.call(rows,row=>{
        //     startArray.push(row.getElementsByClassName(tableColumn)[column].getAttribute(dataValue));
        // });
        if(direction === 'ascending') {
            if (columnType == 'float') {
                rows.sort(function (rowA, rowB) {
                    return rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) - rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue);
                });
            } else if (columnType == 'boolean') {
                rows.sort(function (rowA, rowB) {
                    return rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) < rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) ? 1 : -1;
                });
            } else {
                rows.sort(function (rowA, rowB) {
                    return rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) > rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) ? 1 : -1;
                });
            }
        }else{
            if (columnType == 'float') {
                rows.sort(function (rowA, rowB) {
                    return rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) - rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue);
                });
            } else if (columnType == 'boolean') {
                rows.sort(function (rowA, rowB) {
                    return rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) > rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) ? 1 : -1;
                });
            } else {
                rows.sort(function (rowA, rowB) {
                    return rowA.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) < rowB.getElementsByClassName(tableColumn)[column].getAttribute(dataValue) ? 1 : -1;
                });
            }
        }
        // var endArray = [];
        // [].forEach.call(rows,row=>{
        //     endArray.push(row.getElementsByClassName(tableColumn)[column].getAttribute(dataValue));
        // });
        // console.log(startArray,endArray);
        body.innerHTML = '';
        rows.forEach(row=>{
            body.append(row);
        });
        IncarnateSortRunning = false;
        return true;
    }
    static showHideColumn(ev){
        const checkbox = ev.target;
        const table = document.getElementById(tableName);
        if (checkbox.checked){
            if(table.classList.contains(checkbox.name)){
                table.classList.remove(checkbox.name);
            }
        }else{
            if(!table.classList.contains(checkbox.name)){
                table.classList.add(checkbox.name);
            }
        }
    }
}
IncarnateEquipment.setupListeners();
var IncarnateSortRunning = false;
var timerCount = 1;
