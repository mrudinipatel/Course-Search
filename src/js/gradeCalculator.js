document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('gradeCalculatorForm').addEventListener('submit', function(event) {
        event.preventDefault();
        calculateGrades();
    });
});

function calculateGrades() {
    var rows = document.querySelectorAll('#gradeInputs .gradeInputRow');
    var totalWeight = 0;
    var weightedGradeSum = 0;

    rows.forEach(function(row) {
        var grade = parseFloat(row.cells[1].querySelector('input').value); //grade
        var weight = parseFloat(row.cells[2].querySelector('input').value); //weight

        if (!isNaN(grade) && !isNaN(weight)) { //if they both contain numbers
            weightedGradeSum += grade * weight;
            totalWeight += weight;
        }
    });

    var averageGrade = totalWeight > 0 ? weightedGradeSum / totalWeight : 0;
    var averageGradeDisplay = document.querySelectorAll('.grade-display')[0];
    averageGradeDisplay.textContent = averageGrade.toFixed(2); //display the average grade rounded to 2 decimal places

    var targetGrade = parseFloat(document.getElementById('targetGradeInput').value); //take in the inputted target grade
    var additionalGradeNeeded = 0;
    if (!isNaN(targetGrade) && totalWeight < 100) { //if they inputted a target grade and they still have weight left
        additionalGradeNeeded = ((targetGrade * 100) - weightedGradeSum) / (100 - totalWeight); //calculate the additional grade required
    }

    var additionalGradeDisplay = document.querySelectorAll('.grade-display')[1];
    additionalGradeDisplay.textContent = additionalGradeNeeded > 0 ? additionalGradeNeeded.toFixed(2) : 'N/A';
}

function addRow() {
    var table = document.getElementById('gradeInputs');
    var newRow = table.insertRow(-1);
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);
    newRow.className = "gradeInputRow";

    cell1.innerHTML = '<input type="text" name="name" class="form-input input-field" autocomplete="on" placeholder="Assignment name">';
    cell2.innerHTML = '<input type="number" name="grade" class="form-input input-field" placeholder="Enter grade" min="0" step="0.01">';
    cell3.innerHTML = '<input type="number" name="weight" class="form-input input-field" placeholder="Enter weight" min="0" step="0.01">';
    cell4.innerHTML = '<td><button type="button" onclick="deleteRow(this)">🗑️</button></td>';

    calculateGrades();
}

function deleteRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);

    calculateGrades();
}
