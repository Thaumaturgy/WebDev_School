$(document).ready(clearForm);

function clearForm(){
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });
}

function setSQLID(sqlID){
    document.getElementById("modalSQLID").value = sqlID;
    // alert("DONE");
}

function setCurriculumID(curriculumID){
    document.getElementById("modalSQLID_curriculum").value = curriculumID;

}

function setProgramID(programID){ //for program module and curriculum module
    document.getElementById("modalSQLID_program").value = programID;
    document.getElementById("modalSQLID_programCurriculum").value = programID;
}

function loadToModal (addBtn) {
	// body... 
    var row = addBtn.parentNode.parentNode.parentNode;
    var columns = row.getElementsByTagName('td');
    
    var triggerSource = document.getElementById('source').value;
    if(triggerSource == "student"){
        loadToStudent(columns);
    }else if(triggerSource == "subject")
        loadToSubject(columns);
    else if(triggerSource == "nationality")
        loadToNationality(columns);
    else if (triggerSource == "religion")
        loadToReligion(columns);
    else if(triggerSource == 'account')
        loadToAccount(columns);
    else if(triggerSource == "curriculum") //already perfect!
        loadToCurriculum(columns);
    else if(triggerSource == "program")
        loadToProgram(addBtn);
    else if(triggerSource == 'semestral_grade')
        loadToGrade(columns);
}

function loadToAccount(columns){

    document.getElementById('txt-user').value = columns[0].innerHTML;
    document.getElementById('txt-password').value = columns[1].innerHTML;
    document.getElementById('txt-description').value = columns[2].innerHTML;
    
    document.getElementById('checkbox-active').checked = columns[3].innerHTML == 'Active' ? true : false;

    var student = columns[4].innerHTML;

    // alert(student.charAt(1));
    document.getElementById('checkbox-student-view').checked = student.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-student-add').checked = student.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-student-edit').checked = student.charAt(2) == 1 ? true : false;
    document.getElementById('checkbox-student-viewGrades').checked = student.charAt(3) == 1 ? true : false;

    var program = columns[5].innerHTML;
    document.getElementById('checkbox-program-view').checked = program.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-program-add').checked = program.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-program-edit').checked = program.charAt(2) == 1 ? true : false;
    document.getElementById('checkbox-program-viewCurriculum').checked = program.charAt(3) == 1 ? true : false;
    document.getElementById('checkbox-program-addCurriculum').checked = program.charAt(4) == 1 ? true : false;
    document.getElementById('checkbox-program-editCurriculum').checked = program.charAt(5) == 1 ? true : false;

    var subject = columns[6].innerHTML;
    document.getElementById('checkbox-subject-view').checked = subject.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-subject-add').checked = subject.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-subject-edit').checked = subject.charAt(2) == 1 ? true : false;

    var nationality = columns[7].innerHTML;
    document.getElementById('checkbox-nationality-view').checked = nationality.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-nationality-add').checked = nationality.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-nationality-edit').checked = nationality.charAt(2) == 1 ? true : false;

    var religion = columns[8].innerHTML;
    document.getElementById('checkbox-religion-view').checked = religion.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-religion-add').checked = religion.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-religion-edit').checked = religion.charAt(2) == 1 ? true : false;

    var account = columns[9].innerHTML;
    document.getElementById('checkbox-account-view').checked = account.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-account-add').checked = account.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-account-edit').checked = account.charAt(2) == 1 ? true : false;

    var grade = columns[10].innerHTML;
    document.getElementById('checkbox-grade-view').checked = grade.charAt(0) == 1 ? true : false;
    document.getElementById('checkbox-grade-add').checked = grade.charAt(1) == 1 ? true : false;
    document.getElementById('checkbox-grade-edit').checked = grade.charAt(2) == 1 ? true : false;

}

function loadToModal_Accordion(triggerSource){
    if(triggerSource == "curriculum"){
        loadToCurriculum();
    }else if(triggerSource == "program"){
        loadToProgram();
    }
}

function setProgram_Curriculum(triggerSource){
    document.getElementById('source').value = triggerSource;
}

function loadToCurriculum(columns){
    // alert("Entered Load to Modal");

    document.getElementById('select-yearTaken').value = columns[0].innerHTML;
    document.getElementById('select-semester').value = columns[1].innerHTML;
    document.getElementById('select-subjectCode').value = columns[2].innerHTML;
    
    // alert(columns[2].innerHTML);

    //DIRECTLY SKIPPED TO 5 CUZ [3] and [4] cant be inferred and its not admissible to edit them
    document.getElementById('checkbox-major').checked = columns[5].innerHTML == 'Major' ? true : false;

    // alert("CHEKCBOX WOOOO " + document.getElementById('checkbox-major').value );
}

function loadToProgram(addBtn){

    var panelHeading = document.getElementsByClassName("program-panel-heading")[addBtn.value];
    var panelTitle = panelHeading.children;

    document.getElementById('txt-code').value = panelTitle[0].getAttribute('value');
    document.getElementById('txt-title').value = panelTitle[1].getAttribute('value');
    document.getElementById('num-year').value = panelTitle[2].getAttribute('value');

}

function loadToStudent(columns){

    document.getElementById("txt-lastName").value = columns[0].innerHTML;


    //Set firstName
    document.getElementById("txt-firstName").value = columns[1].innerHTML;
    document.getElementById("txt-middleName").value = columns[2].innerHTML;

    //Set radio-genderM or radio-genderF
    if (columns[3].innerHTML == "Male")
        document.getElementById("radio-genderM").checked = true;
    else
        document.getElementById("radio-genderF").checked = true;

    //Set date-birthDate
    console.log("DATE " + columns[4].innerHTML);

    //alert(new Date(columns[3].innerHTML));

    var date = new Date(columns[4].innerHTML);
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();

    // alert(month + " " + day + " " + year + "!");


    document.getElementById("date-birthDate").value = year+"-"+month+"-"+day;

    //Set txt-program
    document.getElementById("select-program").value = columns[5].innerHTML;

    //Set select-yearStatus
    // alert(columns[5].innerHTML);
    document.getElementById("select-religion").value = columns[6].innerHTML;
    document.getElementById("select-nationality").value = columns[7].innerHTML;

    //Set txt-nationality
    document.getElementById("select-yearStatus").selectedIndex = columns[8].innerHTML-1; //VERY Important format. DO NOT CHANGE!
    //The year status in the columns is in integer. Changing the value to 1st Year for example, will create error
    //in the code. As the innerHTML can no longer be indexed.

    // alert(columns[9].innerHTML);
    document.getElementById("checkbox-regular").checked = columns[9].innerHTML == 'Regular' ? true : false;
}

function loadToSubject(columns){
    document.getElementById("txt-code").value = columns[0].innerHTML;
    document.getElementById("txt-title").value = columns[1].innerHTML;
    document.getElementById("txt-unit").value = columns[2].innerHTML;
}

function loadToReligion(columns){
    document.getElementById("txt-name").value = columns[0].innerHTML;
}

function loadToNationality(columns){
    document.getElementById("txt-name").value = columns[0].innerHTML;
}

function setAddModalType(){

    if(document.getElementById("modalTypeCurriculum") != null)
        document.getElementById("modalTypeCurriculum").value = "Add";
    document.getElementById("modalType").value = "Add";

    document.getElementById("hrefSave").value = "Add";
    if(document.getElementById('hrefSaveCurriculum') != null)
        document.getElementById("hrefSaveCurriculum").value = "Add";
}

function loadToGrade(columns){

   
     var newVal  = document.getElementById("SQLstudentID").value;
     // + " - " 
     // + columns[0].innerHTML + ", "
     // + columns[1].innerHTML + " "
     // + columns[2].innerHTML;
     // alert(newVal);

     document.getElementById("num-grade").value = columns[4].innerHTML;
     document.getElementById("select-student").value = newVal;
     enableSelectStudent(false);

     
}

function enableSelectStudent(enable){
    document.getElementById("select-student").disabled = !enable;
}

function setEditModalType(){
    // alert('yi');
    // document.getElementById("programID").value = 
    if(document.getElementById("modalTypeCurriculum") != null)
        document.getElementById("modalTypeCurriculum").value = "Edit";
    document.getElementById("modalType").value = "Edit";

    document.getElementById("hrefSave").value = "Edit"; 
    if(document.getElementById("hrefSaveCurriculum") != null)
        document.getElementById("hrefSaveCurriculum").value = "Edit";
}


function setGradesAdd(subjectID, schoolyear, semester){
    document.getElementById("SQLsubjectID").value = subjectID;
    document.getElementById("SQLschoolYear").value = schoolyear;
    document.getElementById("SQLsemester").value = semester;
}

function setGradeEdit(studentID){
    document.getElementById("SQLstudentID").value = studentID;
}
