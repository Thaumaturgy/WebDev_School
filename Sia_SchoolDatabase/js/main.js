// document.getElementById('btn-save').addEventListener("click", function(this){addFormData(this));
document.getElementById('hrefSave').addEventListener("click", addOrSave);
var counter = 0;
var globalEntryID = "";


function addOrSave(){
	if(globalEntryID == ""){ //if no global entryID, then its a new form
		addFormData();
	}else{
		editFormData(document.getElementById(globalEntryID));
	}
}

function addFormData(){
	console.log(document.getElementById("tbl-list").childElementCount + "children");
	console.log(document.getElementById("recordForm").firstElementChild);
	var classRosterBody = document.getElementById("tbl-list").firstElementChild;
	var recordFormChildren = document.getElementById("recordForm").firstElementChild;
	
	var entry = createEntry(); //One entry is one row
	console.log(entry.children);
	console.log(typeof(document.getElementById("recordForm").firstElementChild));
	classRosterBody.appendChild(entry);
}

function editFormData(entry){
	console.log(entry);
	var parent = document.getElementById("recordForm").firstElementChild;
	var recordForm = document.getElementById("recordForm").firstElementChild;
	var columns = entry.children;
	console.log("THE COLUMN CHILDREN ARE " + columns[0]);
	columns[0].innerHTML = document.getElementById("txt-lastName").value;
	columns[1].innerHTML = document.getElementById("txt-firstName").value;
	columns[2].innerHTML = document.getElementById("radio-genderM").checked ? "Male" : "Female";
	columns[3].innerHTML = document.getElementById("date-birthDate").value;
	columns[4].innerHTML = document.getElementById("txt-program").value;
	columns[5].innerHTML = document.getElementById("select-yearLevel").value;
	columns[6].innerHTML = document.getElementById("txt-nationality").value;
	clearFields();

}

function createEntry(){
	var entry = document.createElement("tr");
	entry.setAttribute("id", "entry" + counter);
	
		
	for(var i = 0; i < 7; i++){
		var temp = document.createElement("td");
		//temp.innerHTML += "TEST";
		entry.appendChild(temp);
	}
	
	populateEntry(entry);
	
	counter++; //Should the counter really be here? And not at the end?
	
	return entry;
}

function populateEntry(entry){
	var recordForm = document.getElementById("recordForm").firstElementChild;
	
	var columns = entry.children;
	
	columns[0].innerHTML += document.getElementById("txt-lastName").value;
	columns[1].innerHTML += document.getElementById("txt-firstName").value;
	columns[2].innerHTML += document.getElementById("radio-genderM").checked ? "Male" : "Female";
	columns[3].innerHTML += document.getElementById("date-birthDate").value;
	columns[4].innerHTML += document.getElementById("txt-program").value;
	columns[5].innerHTML += document.getElementById("select-yearLevel").value;
	columns[6].innerHTML += document.getElementById("txt-nationality").value;
	
	//entry.appendChild(createEditDelete());
	entry.appendChild(createEditDelete());
	clearFields();
}

function clearFields(){
	//document.getElementById("recordForm").reset();
	alert("CLEARING FIELDS");
	document.getElementById("txt-lastName").value = "";
	document.getElementById("txt-firstName").value = "";
	document.getElementById("radio-genderM").checked = true;
	document.getElementById("date-birthDate").value = "";
	document.getElementById("txt-program").value = "";
	document.getElementById("select-yearLevel").value = "First Year";
	document.getElementById("txt-nationality").value = "";
}

function createEditDelete(){
	var tempTD = document.createElement("td");
	//<a id = "btn-add" data-toggle="modal" data-target="#myModal" href="#"><img src="add.png" alt="save" width="50px" height="50px"></a>

	//EDIT BUTTON
	var edit = document.createElement("a");
	var imgEdit = document.createElement("img");
	imgEdit.setAttribute("src", "edit.png");
	imgEdit.setAttribute("alt", "edit");
	imgEdit.setAttribute("data-toggle", "modal");
	imgEdit.setAttribute("data-target", "#myModal");
	imgEdit.setAttribute("href", "#");
	imgEdit.setAttribute("name", "'entry" + counter + "'");
	edit.appendChild(imgEdit);
	edit.setAttribute("class", "save-cancel-buttonSet");
	edit.setAttribute("onclick", "loadEntry('entry" + counter + "')");
	//console.log("gonna edit " + "loadEntry('entry" + counter + "')");
	
	//DELETE BUTTON
	// var del = document.createElement("a");
	// del.innerHTML += "<img src='delete.png' alt='delete'>";
	// del.setAttribute("class", "save-cancel-buttonSet");
	// del.setAttribute("onclick", "deleteEntry('entry" + counter + "')");
	
	var del = document.createElement("a");
	var imgDel = document.createElement("img");
	imgDel.setAttribute("src", "delete.png");
	imgDel.setAttribute("alt", "del");
	imgDel.setAttribute("href", "#");
	imgDel.setAttribute("name", "'entry" + counter + "'");
	del.appendChild(imgDel);
	del.setAttribute("class", "save-cancel-buttonSet");
	del.setAttribute("onclick", "deleteEntry('entry" + counter + "')");

	tempTD.appendChild(edit);
	tempTD.appendChild(del);
	
	return tempTD;
}


function deleteEntry(entryID){ //Delete current row
	document.getElementById(entryID).innerHTML = "";
	globalEntryID = "";
}

function loadEntry(entryID){ //Edit current row
	
	clearFields();
	
	//alert(entryID);
	
	globalEntryID = entryID;
	
	console.log(document.getElementById(entryID).children);
	console.log(document.getElementById("entry0"));
	var columns = document.getElementById(entryID).children;
	
	console.log(columns);
	console.log("radiooooo "+ columns[2].innerHTML);
	
	//Set lastName
	document.getElementById("txt-lastName").value += columns[0].innerHTML;
	
	//Set firstName
	document.getElementById("txt-firstName").value += columns[1].innerHTML;

	//Set radio-genderM or radio-genderF
	var tempMRadio = document.getElementById("radio-genderM");
	
	if(columns[2].innerHTML == "Male")
		document.getElementById("radio-genderM").checked = true;
	else
		document.getElementById("radio-genderF").checked = true;
	
	//Set date-birthDate
	console.log("DATE "+ columns[3].innerHTML);
	document.getElementById("date-birthDate").value = columns[3].innerHTML;
	
	//Set txt-program
	document.getElementById("txt-program").value = columns[4].innerHTML;
	
	//Set select-yearLevel
	document.getElementById("select-yearLevel").selected = columns[5].innerHTML;
	var selection = document.getElementById("select-yearLevel");
	var opts = selection.options;
	//console.log("EDIT SELECTION" + opts[1].value +" valueee" + columns[5].innerHTML);
	for(var i = 0; i < opts.length; i++){
		if(opts[i].value == columns[5].innerHTML){
			opts.selectedIndex = i;
			break;
		}
			
	}
	
	//Set txt-nationality
	document.getElementById("txt-nationality").value = columns[6].innerHTML;
	
}



