// 1
function showDiv1() {
    document.getElementById('container2').style.display = "block";
    document.getElementById('hr2').style.display = "block";
}
// 2
function showDiv2() {
    document.getElementById('container3').style.display = "block";
    document.getElementById('hr3').style.display = "block";
    document.getElementById('fa-minus_2').style.display = "none";
}
// 3
function showDiv3() {
    document.getElementById('container4').style.display = "block";
    document.getElementById('hr4').style.display = "block";
    //document.getElementById('fa-minus_2').style.display = "none";
    document.getElementById('fa-minus_3').style.display = "none";
}
// 4
function showDiv4() {
    document.getElementById('container5').style.display = "block";
    document.getElementById('hr5').style.display = "block";
    document.getElementById('fa-minus_4').style.display = "none";
}
// 5
function showDiv5() {
    document.getElementById('container6').style.display = "block";
    document.getElementById('hr6').style.display = "block";
    document.getElementById('fa-minus_5').style.display = "none";
}
// 6
function showDiv6() {
    document.getElementById('container7').style.display = "block";
    document.getElementById('hr7').style.display = "block";
    document.getElementById('fa-minus_6').style.display = "none";
}
// 7
function showDiv7() {
    document.getElementById('container8').style.display = "block";
    document.getElementById('hr8').style.display = "block";
    document.getElementById('fa-minus_7').style.display = "none";
}
// 8
function showDiv8() {
    document.getElementById('container9').style.display = "block";
    document.getElementById('hr9').style.display = "block";
    document.getElementById('fa-minus_8').style.display = "none";
}
// 9
function showDiv9() {
    document.getElementById('container10').style.display = "block";
    document.getElementById('hr10').style.display = "block";
    document.getElementById('fa-minus_9').style.display = "none";
}
// 10
function showDiv10() {
    document.getElementById('container11').style.display = "block";
    document.getElementById('hr11').style.display = "block";
    document.getElementById('fa-minus_10').style.display = "none";
}
// 11
function showDiv11() {
    document.getElementById('container12').style.display = "block";
    document.getElementById('hr12').style.display = "block";
    document.getElementById('fa-minus_11').style.display = "none";
}
// 12
function showDiv12() {
    document.getElementById('container13').style.display = "block";
    document.getElementById('hr13').style.display = "block";
    document.getElementById('fa-minus_12').style.display = "none";
}
// 13
function showDiv13() {
    document.getElementById('container14').style.display = "block";
    document.getElementById('hr14').style.display = "block";
    document.getElementById('fa-minus_13').style.display = "none";
}
// 14
function showDiv14() {
    document.getElementById('container15').style.display = "block";
    document.getElementById('hr15').style.display = "block";
    document.getElementById('fa-minus_14').style.display = "none";
}


function test(v) {
    //var test = document.getElementsByClassName('add_btn').addEventListener('click', function () {});
    //
    $('#hidden_value').val(v);
    console.log(test)
}


//
//document.getElementsByClassName('.add_btn').addEventListener("click", function() {
//    alert("You clicked me");
//}​)



var j = 0;

//function add_country() {
//    j++;
//    var select = document.getElementById("SELECT_country");
//    var clone = select.cloneNode(true);
//    clone.setAttribute("id", "SELECT_country" + j);
//    clone.textContent = "SELECT_country" + j;
//    clone.setAttribute("name", "country" + j);
//    document.getElementById("DIV_country").appendChild(clone);
//}

function remove_country() {
    var select = document.getElementById('container' + j);
    //select.removeChild(select.lastChild);
    console.log(select);
}

//document.getElementById('add').addEventListener('click', add_country, false);
//document.getElementById('remove').addEventListener('click', remove_country, false);