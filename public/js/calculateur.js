function tarifs() {
    document.getElementById("field11").value = parseInt(document.getElementById("field1").value) * 50;

    document.getElementById("field22").value = parseInt(document.getElementById("field2").value) * 50 * 7 / 10;

    document.getElementById("field33").value = parseInt(document.getElementById("field3").value) * 50 * 2 / 10;

    document.getElementById("field44").value = parseInt(document.getElementById("field4").value) * 50 * 3 / 10;

    document.getElementById("fieldsomme").value = parseInt(document.getElementById("field11").value) + parseInt(document.getElementById("field22").value) + parseInt(document.getElementById("field33").value) + parseInt(document.getElementById("field44").value);
}